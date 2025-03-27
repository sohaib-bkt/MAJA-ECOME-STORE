<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->take(4)->get();
        return view('index' , compact('products'));
    }


    public function add()
    {
        return view('add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'required|image',
            'images.*' => 'required|image',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');
        $images = [];
        foreach ($request->file('images') as $image) {
            $images[] = $image->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'image' => $imagePath,
            'images' => $images,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('add');
    }
    
    public function abayas(Request $request)
{
    $query = Product::where('category', 'ABAYA');

    // Apply filters
    if ($request->has('size') && $request->size !== '') {
        $query->where('size', $request->size);
    }

    if ($request->has('color') && $request->color !== '') {
        $query->where('color', $request->color);
    }

    // Apply sorting
    switch ($request->get('sort', 'newest')) {
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
        case 'newest':
        default:
            $query->orderBy('created_at', 'desc');
            break;
    }

    $products = $query->paginate(4);

    if ($request->ajax()) {
        return response()->json([
            'html' => view('partials.products', ['products' => $products])->render(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage()
        ]);
    }

    return view('shop/abaya', compact('products'));
}

public function hijabs(Request $request)
{
    $query = Product::where('category', 'HIJAB');

    // Apply filters
    if ($request->has('size') && $request->size !== '') {
        $query->where('size', $request->size);
    }

    if ($request->has('color') && $request->color !== '') {
        $query->where('color', $request->color);
    }

    // Apply sorting
    switch ($request->get('sort', 'newest')) {
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
        case 'newest':
        default:
            $query->orderBy('created_at', 'desc');
            break;
    }

    $products = $query->paginate(4);

    if ($request->ajax()) {
        return response()->json([
            'html' => view('partials.products', ['products' => $products])->render(),
            'next_page_url' => $products->nextPageUrl(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage()
        ]);
    }

    return view('shop/abaya', compact('products'));
}

public function accessoires(Request $request)
{
    $query = Product::where('category', 'ACCESSORY');

    // Apply filters
    if ($request->has('size') && $request->size !== '') {
        $query->where('size', $request->size);
    }

    if ($request->has('color') && $request->color !== '') {
        $query->where('color', $request->color);
    }

    // Apply sorting
    switch ($request->get('sort', 'newest')) {
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
        case 'newest':
        default:
            $query->orderBy('created_at', 'desc');
            break;
    }

    $products = $query->paginate(4);

    if ($request->ajax()) {
        return response()->json([
            'html' => view('partials.products', ['products' => $products])->render(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage()
        ]);
    }

    return view('shop/abaya', compact('products'));
}

public function kimonos(Request $request)
{
    $query = Product::where('category', 'KIMONO');

    // Apply filters
    if ($request->has('size') && $request->size !== '') {
        $query->where('size', $request->size);
    }

    if ($request->has('color') && $request->color !== '') {
        $query->where('color', $request->color);
    }

    // Apply sorting
    switch ($request->get('sort', 'newest')) {
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
        case 'newest':
        default:
            $query->orderBy('created_at', 'desc');
            break;
    }

    $products = $query->paginate(4);

    if ($request->ajax()) {
        return response()->json([
            'html' => view('partials.products', ['products' => $products])->render(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage()
        ]);
    }

    return view('shop/abaya', compact('products'));
}
    

    public function wishlist(){
        $products = Product::orderBy('created_at', 'desc')->take(4)->get();
        $wishlist = session()->get('wishlist', []);
        $prods = Product::whereIn('id', $wishlist)->get();
        return view('wishlist' , compact('products', 'prods'));
    }
     

    public function addWishlist(Request $request)
    {
        $wishlist = session()->get('wishlist', []);

        $productId = $request->input('product_id');
        if (!in_array($productId, $wishlist)) {
            $wishlist[] = $productId;
            session()->put('wishlist', $wishlist);
            $message = 'Product added to wishlist!';
        } else {
            $message = 'Product is already in the wishlist!';
        }

        return response()->json([
            'status' => 'success',
            'message' => $message      
        ]);
    }
    public function removeWishlist($productId)
    {
        $wishlist = session()->get('wishlist', []);
        if (($key = array_search($productId, $wishlist)) !== false) {
            unset($wishlist[$key]);
            session()->put('wishlist', $wishlist);
        }

        return redirect()->route('wishlist')->with('success', 'Product removed from wishlist!');
    }

    public function showProduct($id)
    {
        $product = Product::find($id);
        $products = Product::where('category', $product->category)->take(4)->get();
        return view('showProduct', compact('product', 'products'));        
    }
    public function about()
    {
        return view('about');
    }
    public function successs()  
    {   
        return view('checkoutSuccess');  
    }
    
    
}
