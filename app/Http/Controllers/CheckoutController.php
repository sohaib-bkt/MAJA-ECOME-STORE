<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);
        return view('checkout' , ['product' => $product]);
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

        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentMethods = [$request->payment_method];
        
        // Add card as fallback for Apple Pay
        if($request->payment_method === 'apple_pay') {
            $paymentMethods[] = 'card';
        }

        $session = Session::create([
            'payment_method_types' => $paymentMethods,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $product->name,
                        'description' => $product->category.' / '.$product->size,
                    ],
                    'unit_amount' => $product->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout', $product->id),
            'customer_email' => $request->email,
            'metadata' => [
                'customer_name' => $request->first_name.' '.$request->last_name,
                'address' => $request->address,
                'city' => $request->city,
                'phone' => $request->phone,
                'payment_method' => $request->payment_method
            ]
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        return view('checkout-success');
    }
}