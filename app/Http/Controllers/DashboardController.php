<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
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
            'color' => 'required|string',
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
            'color' => $request->color,
            'price' => $request->price,
        ]);

        return redirect()->route('dashboard')->with('success', 'Produit ajouté avec succès.');
    }
}
