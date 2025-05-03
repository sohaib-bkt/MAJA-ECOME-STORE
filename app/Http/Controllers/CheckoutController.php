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
                $subtotal += $product->price * $item['quantity'];
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
        $subtotal = 0;

        // Calculate subtotal and validate prices
        foreach ($productData['product_ids'] as $index => $productId) {
            $product = Product::findOrFail($productId);
            $quantity = $productData['quantities'][$index];
            $subtotal += $product->price * $quantity;
        }

        // Calculate and validate total price
        $shippingCost = $this->getShippingCost($request->shipping_method);
        $calculatedTotal = $subtotal + $shippingCost;

        // Store shipping cost in session for later use
        session(['shipping_cost' => $shippingCost]);

        // Use a more tolerant comparison for floating point numbers
        if (abs($calculatedTotal - $request->total_price) > 0.01) {
            return redirect()->back()->withErrors(['total_price' => 'Invalid total price calculation']);
        }

        // Create Stripe line items and orders
        foreach ($productData['product_ids'] as $index => $productId) {
            $product = Product::findOrFail($productId);
            $quantity = $productData['quantities'][$index];
            $size = $productData['sizes'][$index] ?? 'S/M';
            $customText = $productData['custom_texts'][$index] ?? '';

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
                'shipping_cost' => $shippingCost, 
            ]);
        }

        // Add shipping as separate line item
        $lineItems[] = [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => ['name' => 'Frais de livraison'],
                'unit_amount' => $shippingCost * 100,
            ],
            'quantity' => 1,
        ];

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
            
            // Récupérer les commandes avant toute opération
            $orders = Order::with('product')->where('stripe_session_id', $sessionId)->get();
            
            if ($orders->isEmpty()) {
                throw new \Exception('Aucune commande trouvée pour cette session');
            }
    
            $firstOrder = $orders->first();
            $shippingCost = $firstOrder->shipping_cost ?? $this->getShippingCost($firstOrder->shipping_method);
    
            // Mettre à jour le statut de paiement
            $orders->each->update(['paid' => true]);
    
            $productsTotal = $orders->sum('total_amount');
            $totalAmount = $productsTotal + $shippingCost;
    
            // Envoyer les emails avec le total complet
            Mail::to($firstOrder->email)->send(new OrderConfirmation($orders, $totalAmount));
            Mail::to('majaacouture7@gmail.com')->send(new OrderBusinessNotification($orders, $totalAmount));
    
            session()->forget('cart');
            session()->forget('shipping_cost');
    
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