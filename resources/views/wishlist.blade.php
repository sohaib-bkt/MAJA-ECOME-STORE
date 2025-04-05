<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <title>Liste de Souhaits - MAJĀA</title>
    <style>
      @keyframes border-grow {
        from { width: 0; }
        to { width: 100%; }
      }

      @keyframes card-entrance {
        from { opacity: 0; transform: translateY(40px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
      }

      @keyframes slide-in {
        from { opacity: 0; transform: translateX(-40px); }
        to { opacity: 1; transform: translateX(0); }
      }

      .animate-border-grow {
        animation: border-grow 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
      }

      .animate-card-entrance {
        animation: card-entrance 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
      }

      .animate-slide-in {
        animation: slide-in 0.6s ease-out forwards;
      }
      @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
      }

      .animate-fade-in {
        animation: fade-in 0.6s ease-out forwards;
      }

      .hover\:scale-125:hover {
        transform: scale(1.25);
      }

      .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
      }
    </style>
  </head>
  
  <body class="bg-gray-50">
    <x-nav />

    <!-- Liste de Souhaits -->
    <main class="container mx-auto px-4 py-12 md:py-16">
      <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8 mt-4 opacity-0 animate-slide-in [animation-delay:0.3s]">
          Votre Liste de <span class="text-[#C9B194] relative pb-2 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-1 after:bg-[#C9B194] after:animate-border-grow">Souhaits</span>
        </h1>

        <div class="bg-white rounded-xl shadow-sm divide-y divide-gray-200">
          @forelse ($prods as $index => $product)
          <div class="p-6 hover:bg-gray-50 transition-colors opacity-0 animate-card-entrance" style="animation-delay: {{ 0.5 + ($index * 0.1) }}s">
            <div class="flex items-center justify-between gap-6">
              <!-- Produit -->
              <div class="flex items-center gap-6 flex-1">
                <img src="{{ asset('storage/'.$product->image) }}" 
                     alt="{{ $product->name }}"
                     class="w-40 h-64 md:w-56 md:h-96 object-cover rounded-lg transition-transform duration-500 hover:scale-105">
                <div class="space-y-1">
                  <h3 class="text-lg font-medium text-gray-900">{{ $product->name }}</h3>
                  <p class="text-[#C9B194] font-bold text-xl">
                    €{{ number_format($product->price, 2, ',', ' ') }} 
                  </p>
                </div>
              </div>

              <!-- Actions -->
              <div class="flex items-center gap-4">
                <a href="{{ route('product.show', $product->id) }}" 
                   class="px-6 py-2 bg-[#C9B194] hover:bg-[#B89E80] text-white rounded-full transition-all duration-300 hover:scale-105">
                  Voir le produit
                </a>
                <form action="{{ route('wishlist.remove', $product->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors hover:scale-125">
                    <i class="bx bx-x text-3xl"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
          @empty
          <div class="p-12 text-center opacity-0 animate-fade-in [animation-delay:0.5s]">
            <p class="text-gray-600 text-lg">Votre liste de souhaits est vide</p>
          </div>
          @endforelse
        </div>
      </div>
    </main>

    <!-- Dernières Créations -->
    <section class="section featured px-4">
      <div class="top container flex flex-col md:flex-row justify-between items-center mb-8 opacity-0 animate-slide-in [animation-delay:0.7s]">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
          <span class="border-b-4 border-[#C9B194] pb-2">Dernières Créations</span>
        </h2>
        <a href="{{ route('collections.abayas') }}" 
           class="mt-4 md:mt-0 text-[#C9B194] hover:text-[#B89E80] font-medium transition-colors group">
          Voir plus <i class="bx bx-chevron-right inline-block group-hover:translate-x-1 transition-transform"></i>
        </a>
      </div>
      <div class="product-center container grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
          <x-product :product="$product" class="opacity-0 animate-card-entrance" style="animation-delay: {{ 0.8 + ($loop->index * 0.1) }}s"></x-product>
        @endforeach
      </div>
    </section>

    <x-footer />

    <script src="{{ asset('js/index.js') }}"></script>
  </body>
</html>