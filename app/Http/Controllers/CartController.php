<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function panier()
    {
        return view('panier');
    }
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|in:S/M,M/L',
            'custom_text' => 'nullable|string|max:5'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        $cartItem = [
            'id' => uniqid(),
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'size' => $request->size,
            'custom_text' => $request->custom_text,
            'image' => $product->image,
            'category' => $product->category,
        ];

        $cart = session()->get('cart', []);
        $cart[] = $cartItem;
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté au panier!',
            'cart_count' => count($cart)
        ]);
    }
    public function update(Request $request, $index)
{
    $cart = session()->get('cart', []);

    if(isset($cart[$index])) {
        $cart[$index]['quantity'] = $request->quantity;
        session()->put('cart', $cart);
    }

    $subtotal = 0;
    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }

    return response()->json([
        'success' => true,
        'quantity' => $cart[$index]['quantity'], 
        'subtotal' => number_format($subtotal, 2)
    ]);
}

    public function remove($index)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$index])) {
            unset($cart[$index]);
            session()->put('cart', array_values($cart));
        }

        return redirect()->back();
    }
}
