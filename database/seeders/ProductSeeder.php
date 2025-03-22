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
            'name' => 'ABAYA MINIMAL BIEGE',
            'category' => 'ABAYA',
            'image' => 'pro1.jpeg',
            'images' => json_encode(['pro2.jpeg', 'pro3.jpeg']),
            'description' => "Découvrez notre abaya biege en nylon et jersey, une pièce qui marie élégance moderne et confort absolu. Confectionnée dans un tissu de qualité supérieure, elle offre légèreté et durabilité tout en assurant un confort optimal. Sa coupe minimaliste s'adapte avec raffinement aussi bien aux looks habillés qu'aux styles décontractés, pour une élégance discrète en toutes occasions. De plus, sa manche personnalisable brodée apporte une touche unique, vous permettant d’exprimer votre style avec originalité."  ,
            'price' => 45,
            'slug' => 'abayaminimalbiege',
            'size' => 'S/M',
            
        ]);
        Product::create([
            'name' => 'ABAYA MINIMAL TAUPE',
            'category' => 'ABAYA',
            'image' => 'pro2.jpeg',
            'images' => ['pro2.jpeg', 'pro3.jpeg'],  
            'description' => "Découvrez notre abaya taupe en nylon et jersey, une pièce qui marie élégance moderne et confort absolu. Confectionnée dans un tissu de qualité supérieure, elle offre légèreté et durabilité tout en assurant un confort optimal. Sa coupe minimaliste s'adapte avec raffinement aussi bien aux looks habillés qu'aux styles décontractés, pour une élégance discrète en toutes occasions. De plus, sa manche personnalisable brodée apporte une touche unique, vous permettant d’exprimer votre style avec originalité."  ,
            'price' => 45,
            'slug' => 'abayaminimaltaupe',
            'size' => 'M/L',
        ]);
        Product::create([
            'name' => 'ABAYA MINIMAL MARRON',
            'category' => 'ABAYA',
            'image' => 'pro3.jpeg',
            'images' => ['pro2.jpeg', 'pro3.jpeg'],  
            'description' => "Découvrez notre abaya marron en nylon et jersey, une pièce qui marie élégance moderne et confort absolu. Confectionnée dans un tissu de qualité supérieure, elle offre légèreté et durabilité tout en assurant un confort optimal. Sa coupe minimaliste s'adapte avec raffinement aussi bien aux looks habillés qu'aux styles décontractés, pour une élégance discrète en toutes occasions. De plus, sa manche personnalisable brodée apporte une touche unique, vous permettant d’exprimer votre style avec originalité."  ,
            'price' => 45,
            'slug' => 'abayaminimalmarron',
            'size' => 'S/M',
        ]);


    }
}
