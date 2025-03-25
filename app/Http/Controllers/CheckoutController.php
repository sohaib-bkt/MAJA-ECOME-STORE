<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;

class CheckoutController extends Controller
{
    public function index($id)
    {
        $product = Product::findOrFail($id);
        return view('checkout', ['product' => $product]);
    }

    public function process(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'product_id' => 'required|exists:products,id',
            'payment_method' => 'required|in:card,paypal,apple_pay'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Create order record
        $order = Order::create([
            'product_id' => $product->id,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'stripe_session_id' => '',
            'paid' => false
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $product->name,
                        'description' => $product->category.'/'.$product->size,
                    ],
                    'unit_amount' => $product->price * 100,
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
        dd($request);
        try {
            $sessionId = $request->get('session_id');
            
            if (!$sessionId) {
                throw new \Exception('Missing session ID');
            }

            // Verify Stripe payment
            Stripe::setApiKey(config('services.stripe.secret'));
            $session = Session::retrieve($sessionId);

            // Get and update order
            $order = Order::where('stripe_session_id', $sessionId)->firstOrFail();
            
            if (!$order->paid) {
                $order->update(['paid' => true]);
                Mail::to($order->email)->send(new OrderConfirmation($order));
            }

            return view('checkoutSuccess', [
                'order' => $order,
                'product' => $order->product
            ]);

        } catch (\Exception $e) {
            return redirect()->route('checkout', ['id' => $order->product_id ?? 1])
                             ->with('error', 'We encountered an issue confirming your payment: ' . $e->getMessage());
        }
    }
}