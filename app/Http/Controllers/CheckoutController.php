<?php
namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderBusinessNotification;


class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = session('cart', []);
        $cartItems = [];
        $subtotal = 0;

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'] ?? 1,
                    'size' => $item['size'] ?? 'S/M',
                    'custom_text' => $item['custom_text'] ?? '',
                ];
                $item['quantity'] = $item['quantity'] ?? 1;
                $subtotal += $product->price * $item['quantity']; ;
            }
        }

        return view('checkout', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
        ]);
    }

    public function process(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'payment_method' => 'required|in:card,paypal,apple_pay',
            'shipping_method' => 'required|string',
            'total_price' => 'required|numeric',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
            'sizes' => 'array',
            'custom_texts' => 'array',
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];
        $orders = [];
        $productData = $request->only(['product_ids', 'quantities', 'sizes', 'custom_texts']);

        foreach ($productData['product_ids'] as $index => $productId) {
            $product = Product::findOrFail($productId);
            $quantity = $productData['quantities'][$index];
            $size = $productData['sizes'][$index] ?? 'S/M';
            $customText = $productData['custom_texts'][$index] ?? '';

            // Création des line items Stripe - uniquement en euros
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $product->name,
                        'description' => $product->category.'/'.$size,
                    ],
                    'unit_amount' => $product->price * 100,
                ],
                'quantity' => $quantity,
            ];

            // Création des commandes
            $orders[] = Order::create([
                'product_id' => $product->id,
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'text' => $customText,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'phone' => '+33'.$request->phone,
                'payment_method' => $request->payment_method,
                'stripe_session_id' => '',
                'quantity' => $quantity,
                'total_amount' => $product->price * $quantity,
                'size' => $size,
                'paid' => false,
                'shipping_method' => $request->shipping_method,
            ]);
        }

        // Ajout des frais de livraison - uniquement en euros
        $shippingCost = $this->getShippingCost($request->shipping_method);
        $lineItems[] = [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => ['name' => 'Frais de livraison'],
                'unit_amount' => $shippingCost * 100,
            ],
            'quantity' => 1,
        ];

        // Création de la session Stripe
        $session = Session::create([
            'payment_method_types' => [$request->payment_method],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout'),
            'customer_email' => $request->email,
            'currency' => 'eur', 
            'locale' => 'fr',
        ]);

        // Mise à jour des commandes avec l'ID de session
        foreach ($orders as $order) {
            $order->update(['stripe_session_id' => $session->id]);
        }

        return redirect()->away($session->url);
    }

    private function getShippingCost($method)
    {
        return match($method) {
            'Mondial Relay' => 5.50,
            'Colissimo' => 8.50,
            default => 0.00,
        };
    }

    public function success(Request $request)
    {
        try {
            $sessionId = $request->get('session_id');
            $orders = Order::with('product')->where('stripe_session_id', $sessionId)->get();
    
            if ($orders->isEmpty()) {
                throw new \Exception('Aucune commande trouvée pour cette session');
            }
    
            // Mettre à jour toutes les commandes
            $orders->each->update(['paid' => true]);
    
            $firstOrder = $orders->first();
            $totalAmount = $orders->sum('total_amount');
    
            // Envoyer l'email avec toutes les commandes
            Mail::to($firstOrder->email)->send(new OrderConfirmation($orders));
    
            // Envoyer la notification business
            Mail::to('majaacouture7@gmail.com')->send(new OrderBusinessNotification($orders));
    
            session()->forget('cart');
    
            $flashData = [
                'order_ids' => $orders->pluck('id'),
                'total_amount' => number_format($totalAmount, 2),
                'customer_name' => $firstOrder->full_name,
                'email' => $firstOrder->email,
                'product_count' => $orders->count()
            ];
    
            return redirect()->route('home')
                ->with('success', 'Commande validée !')
                ->with('flash_data', $flashData);
    
        } catch (\Exception $e) {
            return redirect()->route('collections.abayas')
                ->with('error', 'Erreur lors du traitement: ' . $e->getMessage());
        }
    }
}