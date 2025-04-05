<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - MAJĀA</title>
    
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
        
            <!-- Message de succès -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg border border-green-200">
                    {{ session('success') }}
                </div>
            @endif
        
            <div class="space-y-6">
                <!-- Champ Nom -->
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Nom du produit</label>
                    <input type="text" name="name" value="{{ old('name') }}" required 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#C9B194]">
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
        
                <!-- Champ Catégorie -->
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Catégorie</label>
                    <select name="category" required 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#C9B194]">
                        <option value="">Sélectionner une catégorie</option>
                        <option value="ABAYA" @selected(old('category') == 'ABAYA')>ABAYA</option>
                        <option value="HIJAB" @selected(old('category') == 'HIJAB')>HIJAB</option>
                        <option value="ACCESSORY" @selected(old('category') == 'ACCESSORY')>ACCESSORY</option>
                        <option value="KIMONO" @selected(old('category') == 'KIMONO')>KIMONO</option>
                    </select>
                    @error('category')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
        
                <!-- Image principale -->
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Image principale</label>
                    <input type="file" name="image" required 
                        class="w-full file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold
                        file:bg-[#C9B194]/20 file:text-[#C9B194] hover:file:bg-[#C9B194]/30">
                    @error('image')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
        
                <!-- Galerie d'images -->
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Galerie d'images</label>
                    <input type="file" name="images[]" multiple 
                        class="w-full file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold
                        file:bg-[#C9B194]/20 file:text-[#C9B194] hover:file:bg-[#C9B194]/30">
                    @error('images.*')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
        
                <!-- Description -->
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Description</label>
                    <textarea name="description" rows="4" required 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#C9B194]">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
        
                <!-- Prix -->
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Prix avant remise (€)</label>
                    <input type="number" step="0.01" name="price_before_discount" value="{{ old('price_before_discount') }}" required 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#C9B194]">
                    @error('price_before_discount')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Prix -->
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Prix apres remise (€)</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}" required 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#C9B194]">
                    @error('price')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
        
                <!-- Taille -->
                {{-- <div>
                    <label class="block text-gray-700 mb-2 font-medium">Size</label>
                    <select name="size" required 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#C9B194]">
                        <option value="">Sélectionner une taille</option>
                        <option value="S/M" @selected(old('size') == 'S/M')>S/M</option>
                        <option value="M/L" @selected(old('size') == 'M/L')>M/L</option>
                    </select>
                    @error('size')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div> --}}
        
                <!-- Couleur -->
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Colour</label>
                    <select name="color" required 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#C9B194]">
                        <option value="">Sélectionner une couleur</option>
                        <option value="Biege" @selected(old('color') == 'Biege')>Biege</option>
                        <option value="Taupe" @selected(old('color') == 'Taupe')>Taupe</option>
                        <option value="Marron" @selected(old('color') == 'Marron')>Marron</option>
                    </select>
                    @error('color')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
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