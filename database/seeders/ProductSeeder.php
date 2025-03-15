<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'bracelet',
            'category' => 'jewelry',
            'image' => 'pro1.jpg',
            'images' => json_encode(['pro2.jpg', 'pro3.jpg']),
            'description' => 'This is a sample product description.',
            'price' => 10.99,
        ]);
        Product::create([
            'name' => 'clutch',
            'category' => 'jewelry',
            'image' => 'pro2.jpg',
            'images' => json_encode(['pro2.jpg', 'pro3.jpg']),
            'description' => 'This is a sample product description.',
            'price' => 12,
        ]);
        Product::create([
            'name' => 'bracelet',
            'category' => 'jewelry',
            'image' => 'pro3.jpg',
            'images' => json_encode(['pro2.jpg', 'pro3.jpg']),
            'description' => 'This is a sample product description.',
            'price' => 10.99,
        ]);


    }
}
