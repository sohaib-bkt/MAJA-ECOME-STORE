<footer class="bg-gray-50 border-t border-gray-100 mt-24 scroll-section">
  <div class="max-w-7xl mx-auto px-4 py-12 md:py-16">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 lg:gap-16">
      
      <!-- Colonne Informations -->
      <div class="space-y-4">
        <h4 class="text-lg font-semibold text-gray-900 pb-2 border-b border-[#C9B194]">
          INFORMATIONS
        </h4>
        <nav class="flex flex-col space-y-3">
          <a href="{{ route('about')}}" class="text-gray-600 hover:text-[#C9B194] transition-colors">
            À propos de nous
          </a>
          @php
          $message = "Bonjour ! Veuillez envoyer une capture d'écran du produit";
          $encodedMessage = urlencode($message);
          @endphp
          <a href="https://wa.me/+21239565569?text={{ $encodedMessage }}" 
             class="text-gray-600 hover:text-[#C9B194] transition-colors">
            Nous contacter
          </a>
          <a href="#" class="text-gray-600 hover:text-[#C9B194] transition-colors">
            Conditions générales
          </a>
        </nav>
      </div>

      <!-- Colonne Liens utiles -->
      <div class="space-y-4">
        <h4 class="text-lg font-semibold text-gray-900 pb-2 border-b border-[#C9B194]">
          LIENS UTILES
        </h4>
        <nav class="flex flex-col space-y-3">
          <a href="{{ route('collections.abayas')}}" 
             class="text-gray-600 hover:text-[#C9B194] transition-colors">
            Boutique en ligne
          </a>
          <a href="#" class="text-gray-600 hover:text-[#C9B194] transition-colors">
            Service client
          </a>
          <a href="#" class="text-gray-600 hover:text-[#C9B194] transition-colors">
            Promotions
          </a>
          <a href="#" class="text-gray-600 hover:text-[#C9B194] transition-colors">
            Marques phares
          </a>
        </nav>
      </div>

      <!-- Colonne Réseaux sociaux -->
      <div class="space-y-4">
        <h4 class="text-lg font-semibold text-gray-900 pb-2 border-b border-[#C9B194]">
          SUIVEZ-NOUS
        </h4>
        <div class="flex space-x-4">
          <a href="#" class="text-gray-600 hover:text-[#C9B194] transition-colors">
            <i class="bx bxl-facebook-square text-3xl"></i>
          </a>
          <a href="#" class="text-gray-600 hover:text-[#C9B194] transition-colors">
            <i class="bx bxl-instagram-alt text-3xl"></i>
          </a>
        </div>
        
        <!-- Section Newsletter -->
        <div class="mt-6">
          <p class="text-gray-600 mb-3">Abonnez-vous à notre newsletter</p>
          <form class="flex gap-2">
            <input 
              type="email" 
              placeholder="Votre email" 
              class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C9B194]"
            >
            <button 
              type="submit" 
              class="px-4 py-2 bg-[#C9B194] hover:bg-[#B89E80] text-white rounded-lg transition-colors"
            >
              S'abonner
            </button>
          </form>
        </div>
      </div>

    </div>

    <!-- Copyright -->
    <div class="border-t border-gray-200 mt-12 pt-8 text-center text-gray-600">
      <p>&copy; {{ date('Y') }} Maja Store. Tous droits réservés.</p>
    </div>
  </div>
</footer>