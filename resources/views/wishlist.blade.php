<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <title>Liste de Souhaits - Maja Store</title>
  </head>
  
  <body class="bg-gray-50">
    <x-nav />

    <!-- Liste de Souhaits -->
    <main class="container mx-auto px-4 py-12 md:py-16">
      <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8 mt-4">Votre Liste de <span class="text-[#C9B194] border-b-4 border-[#C9B194]">Souhaits</span></h1>

        <div class="bg-white rounded-xl shadow-sm divide-y divide-gray-200">
          @forelse ($prods as $product)
          <div class="p-6 hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between gap-6">
              <!-- Produit -->
              <div class="flex items-center gap-6 flex-1">
                <img src="{{ asset('images/'.$product->image) }}" 
                     alt="{{ $product->name }}"
                     class="w-40 h-64 md:w-56 md:h-96 object-cover rounded-lg">
                <div class="space-y-1">
                  <h3 class="text-lg font-medium text-gray-900">{{ $product->name }}</h3>
                  <p class="text-[#C9B194] font-bold text-xl">
                    {{ number_format($product->price, 2, ',', ' ') }} MAD
                  </p>
                </div>
              </div>

              <!-- Actions -->
              <div class="flex items-center gap-4">
                <a href="{{ route('product.show', $product->id) }}" 
                   class="px-6 py-2 bg-[#C9B194] hover:bg-[#B89E80] text-white rounded-full transition-colors">
                  Voir le produit
                </a>
                <form action="{{ route('wishlist.remove', $product->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                    <i class="bx bx-x text-3xl"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
          @empty
          <div class="p-12 text-center">
            <p class="text-gray-600 text-lg">Votre liste de souhaits est vide</p>
          </div>
          @endforelse
        </div>

       
      </div>
    </main>
    <!-- Latest Products -->
    <section class="section featured">
      <div class="top container flex flex-col md:flex-row justify-between items-center mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
          <span class="border-b-4 border-[#C9B194] pb-2">Dernières Créations</span>
        </h2>
        <a href="{{ route('collections.abayas') }}" 
           class="mt-4 md:mt-0 text-[#C9B194] hover:text-[#B89E80] font-medium transition-colors">
          Voir plus →
        </a>
      </div>
      <div class="product-center container">
        @foreach ($products as $product)
            <x-product :product="$product"></x-product>
        @endforeach
      </div>
    </section>

    <x-footer />

    <script src="{{ asset('js/index.js') }}"></script>
  </body>
</html>