<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - MAJA</title>
    
    {{-- <link rel="stylesheet" href="{{ asset('css/index.css') }}"> --}}
    @vite('resources/css/app.css')
</head>
<body class="bg-[#F5F5F5] mx-auto flex  justify-center flex-col items-center min-h-screen">
    
    <h1 class="text-3xl font-bold mb-8 text-[#C9B194]">hello admin</h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-[#C9B194] hover:bg-[#B89E80] text-white font-bold py-2 px-4 rounded-lg transition-all duration-300">
            Déconnexion
        </button>
    </form>

    <div class="container mx-auto px-4 py-8 justify-center flex flex-col items-center">
        <h1 class="text-3xl font-bold mb-8 text-[#C9B194]">Ajouter un nouveau produit</h1>
        
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl bg-white rounded-lg shadow-md p-6">
            @csrf
    
            <div class="space-y-6">
                <!-- Champ Nom -->
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Nom du produit</label>
                    <input type="text" name="name" required 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#C9B194]">
                </div>
    
                <!-- Champ Catégorie -->
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Catégorie</label>
                    <select name="category" required 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#C9B194]">
                        <option value="">Sélectionner une catégorie</option>
                        <option value="ABAYA">ABAYA</option>
                        <option value="HIJAB">HIJAB</option>
                        <option value="ACCESSORY">ACCESSORY</option>
                        <option value="KIMONO">KIMONO</option>
                    </select>
                </div>
    
                <!-- Image principale -->
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Image principale</label>
                    <input type="file" name="image" required 
                        class="w-full file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold
                        file:bg-[#C9B194]/20 file:text-[#C9B194] hover:file:bg-[#C9B194]/30">
                </div>
    
                <!-- Galerie d'images -->
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Galerie d'images</label>
                    <input type="file" name="images[]" multiple 
                        class="w-full file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold
                        file:bg-[#C9B194]/20 file:text-[#C9B194] hover:file:bg-[#C9B194]/30">
                </div>
    
                <!-- Description -->
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Description</label>
                    <textarea name="description" rows="4" required 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#C9B194]"></textarea>
                </div>
    
                <!-- Prix -->
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Prix (€)</label>
                    <input type="number" step="0.01" name="price" required 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#C9B194]">
                </div>
    
                <!-- Options supplémentaires -->
               
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Size</label>
                    <select name="size" required 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#C9B194]">
                        <option value="">Sélectionner une taille</option>
                        <option value="S/M">S/M</option>
                        <option value="M/L">M/L</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Colour</label>
                    <select name="size" required 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#C9B194]">
                        <option value="color">Sélectionner une couleur</option>
                        <option value="Biege">Biege</option>
                        <option value="Taupe">Taupe</option>
                        <option value="Marron">Marron</option>
                    </select>
                </div>
                
    
                <button type="submit" 
                    class="w-full bg-[#C9B194] hover:bg-[#B89E80] text-white font-bold py-3 px-4 rounded-lg transition-all duration-300">
                    Ajouter le produit
                </button>
            </div>
        </form>
    </div>
    
</body>
</html>