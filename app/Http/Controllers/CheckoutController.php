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
    public function index($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $selectedSize = $request->query('size'); 
        $selectedText = $request->query('custom_text');
        return view('checkout', [
            'product' => $product,
            'selectedSize' => $selectedSize,
            'selectedText' => $selectedText
        ]);
    }
    public function process(Request $request)
    {
        
              
        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'text' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:card,paypal,apple_pay',
            'selected_size' => 'string',
            'shipping_method' => 'required|string',
            'total_price' => 'required|numeric'
        ]);

        
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        $totalAmount = $request->total_price;
        $selectedSize = $request->selected_size ? $request->selected_size : 'S/M'; 

        // Create order record with the selected size
        $order = Order::create([
            'product_id' => $product->id,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'text' => $request->text,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'phone' => '+33'.$request->phone,
            'payment_method' => $request->payment_method,
            'stripe_session_id' => '',
            'quantity' => $quantity,
            'total_amount' => $totalAmount,
            'size' => $selectedSize, // Store the selected size
            'paid' => false,
            'shipping_method' => $request->shipping_method,
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => [$request->payment_method], 
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $product->name,
                        'description' => $product->category.'/'.$selectedSize, 
                    ],
                    'unit_amount' => $totalAmount * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout', $product->id),
            'customer_email' => $request->email,
        ]);

        $order->update(['stripe_session_id' => $session->id]);

        return redirect()->away($session->url);
    }
    public function success(Request $request)
    {
        try {
            $sessionId = $request->get('session_id');
            
            if (!$sessionId) {
                throw new \Exception('Missing session ID');
            }
    
            Stripe::setApiKey(config('services.stripe.secret'));
            $session = Session::retrieve($sessionId);
    
            $order = Order::where('stripe_session_id', $sessionId)->firstOrFail();
            
            if (!$order->paid) {
                $order->update(['paid' => true]);
                Mail::to($order->email)->send(new OrderConfirmation($order));
                Mail::to('majaacouture7@gmail.com')->send(new OrderBusinessNotification($order));
            }
    
            // Prepare flash card data
            $flashData = [
                'order_id' => $order->id,
                'amount' => number_format($order->total_amount , 2),
                'product_name' => $order->product->name,
                'customer_name' => $order->name,
                'email' => $order->email
            ];
    
            return redirect()->route('home')
                ->with('success', 'Paiement réussi!')
                ->with('flash_data', $flashData);
    
        } catch (\Exception $e) {
            return redirect()->route('checkout', ['id' => $order->product_id ?? 1])
                ->with('error', 'Nous avons rencontré un problème lors de la confirmation de votre paiement: ' . $e->getMessage());
        }
    }
}