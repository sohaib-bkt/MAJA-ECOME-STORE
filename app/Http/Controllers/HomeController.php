<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductNotification;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->take(4)->get();
        return view('index' , compact('products'));
    }
    
    private function handleCategory(Request $request, string $category, string $view)
    {
        $query = Product::where('category', $category);

        $this->applyFilters($request, $query);
        $this->applySorting($request, $query);

        $products = $query->paginate(4);

        $headers = [
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];

        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.products', compact('products'))->render(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage()
            ], 200, $headers);
        }

        return response()->view("shop.{$view}", compact('products'))->withHeaders($headers);
    }

    // Application des filtres
    private function applyFilters(Request $request, $query)
    {
        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }

        if ($request->filled('color')) {
            $query->where('color', $request->color);
        }
    }

    // Application du tri
    private function applySorting(Request $request, $query)
    {
        $sort = $request->get('sort', 'newest');
        
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price');
                break;
            case 'price_desc':
                $query->orderByDesc('price');
                break;
            default:
                $query->latest();
                break;
        }
    }

    // Méthodes publiques pour chaque catégorie
    public function abayas(Request $request)
    {
        return $this->handleCategory($request, 'ABAYA', 'abaya');
    }

    public function hijabs(Request $request)
    {
        return $this->handleCategory($request, 'HIJAB', 'abaya');
    }

    public function accessoires(Request $request)
    {
        return $this->handleCategory($request, 'ACCESSORY', 'abaya');
    }

    public function kimonos(Request $request)
    {
        return $this->handleCategory($request, 'KIMONO', 'abaya');
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
            $message = 'Produit ajouté à la liste de souhaits !';
        } else {
            $message = 'Le produit est déjà dans la liste de souhaits !';
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

        return redirect()->route('wishlist')->with('success', 'Produit retiré de la liste de souhaits !');
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
    
    public function backstage()
    {
        return view('backstage');
    }
    public function prevent(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'email' => 'required|email|max:255'
        ]);

        // Création de la notification
        ProductNotification::firstOrCreate([
            'product_id' => $validated['product_id'],
            'email' => $validated['email']
        ]);

        return back()->with('success', 'Vous serez notifié lorsque ce produit sera disponible !');
    }
    
}
