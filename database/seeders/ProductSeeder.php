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
            'image' => 'biege1.jpg',
            'images' => ['biege2.jpg', 'biege3.jpg'],
            'description' => "Découvrez notre abaya biege en nylon et jersey, une pièce qui marie élégance moderne et confort absolu. Confectionnée dans un tissu de qualité supérieure, elle offre légèreté et durabilité tout en assurant un confort optimal. Sa coupe minimaliste s'adapte avec raffinement aussi bien aux looks habillés qu'aux styles décontractés, pour une élégance discrète en toutes occasions. De plus, sa manche personnalisable brodée apporte une touche unique, vous permettant d’exprimer votre style avec originalité."  ,
            'price' => 45,
            'slug' => 'abaya-minimal-biege',
            'color' => 'Biege',
            'size' => 'S/M',
            
        ]);
        Product::create([
            'name' => 'ABAYA MINIMAL TAUPE',
            'category' => 'ABAYA',
            'image' => 'taupe1.jpg',
            'images' => ['taupe2.jpg', 'taupe3.jpg'],  
            'description' => "Découvrez notre abaya taupe en nylon et jersey, une pièce qui marie élégance moderne et confort absolu. Confectionnée dans un tissu de qualité supérieure, elle offre légèreté et durabilité tout en assurant un confort optimal. Sa coupe minimaliste s'adapte avec raffinement aussi bien aux looks habillés qu'aux styles décontractés, pour une élégance discrète en toutes occasions. De plus, sa manche personnalisable brodée apporte une touche unique, vous permettant d’exprimer votre style avec originalité."  ,
            'price' => 45,
            'color' => 'Taupe',
            'slug' => 'abaya-minimal-taupe',
            
            'size' => 'M/L',
        ]);
        Product::create([
            'name' => 'ABAYA MINIMAL MARRON',
            'category' => 'ABAYA',
            'image' => 'marron1.jpg',
            'images' => ['marron2.jpg', 'marron3.jpg'],  
            'description' => "Découvrez notre abaya marron en nylon et jersey, une pièce qui marie élégance moderne et confort absolu. Confectionnée dans un tissu de qualité supérieure, elle offre légèreté et durabilité tout en assurant un confort optimal. Sa coupe minimaliste s'adapte avec raffinement aussi bien aux looks habillés qu'aux styles décontractés, pour une élégance discrète en toutes occasions. De plus, sa manche personnalisable brodée apporte une touche unique, vous permettant d’exprimer votre style avec originalité."  ,
            'price' => 45,
            'slug' => 'abaya-minimal-marron',
            'color' => 'Marron',
            'size' => 'S/M',
        ]);



    }
}
