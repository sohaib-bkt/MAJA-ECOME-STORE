<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Box icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <!-- Custom StyleSheet -->
  @vite('resources/css/app.css')
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css"  rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  <link rel="stylesheet" href="{{ asset('css/nav.css') }}">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>{{ $product->name }} | MAJĀA</title>
  <style>
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes heartbeat {
      0% { transform: scale(1); }
      25% { transform: scale(1.2); }
      50% { transform: scale(1); }
      75% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }

    .animate-slide-in {
      animation: slideIn 0.5s ease-out forwards;
    }

    .heartbeat {
      animation: heartbeat 0.8s ease-in-out;
    }
    select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1.5em 1.5em;
}
/* Add these after your existing animations */
@keyframes pop-in {
    0% { transform: translateY(10px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}

.price-discounted {
    position: relative;
    display: inline-block;
    padding: 0 4px;
}

.price-discounted::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    height: 65%;
    background: linear-gradient(120deg, rgba(201,177,148,0.15) 0%, rgba(201,177,148,0.05) 100%);
    transform: translateY(-50%) scaleX(0);
    transform-origin: right;
    transition: transform 0.4s ease;
    z-index: -1;
}

.price-discounted:hover::after {
    transform: translateY(-50%) scaleX(1);
    transform-origin: left;
}

.animate-pop-in {
    animation: pop-in 0.6s cubic-bezier(0.22, 0.61, 0.36, 1) forwards;
}
      
  </style>
</head>
<body>
  <!-- Navigation -->
  <x-nav></x-nav>

  <section class="section product-detail h-auto ">
    <div class="details container">
        <div class="left image-container h-[800px]">
            <div class="main">
              <div id="default-carousel" class="relative w-full h-[800px]  flex flex-col " data-carousel="slide">
                <!-- Carousel wrapper -->              
                <div class="relative flex-grow overflow-hidden rounded-lg h-[800px]">
                  <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-full object-contain" alt="Product Image">
                  </div>
                  @foreach ($product->images as $productImage)
                  <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('storage/'.$productImage) }}" class="w-full h-full object-contain" alt="Product Image">
                  </div>
                  @endforeach
                </div>
          
                <!-- Slider indicators -->
                <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex space-x-3 rtl:space-x-reverse z-30">
                  <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                  @foreach ($product->images as $index => $image)
                  <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
                  @endforeach
                </div>
          
                <!-- Slider controls -->
                <button type="button" class="absolute top-1/2 left-0 transform -translate-y-1/2 z-30 px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                  <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" viewBox="0 0 6 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                  </span>
                </button>
                <button type="button" class="absolute top-1/2 right-0 transform -translate-y-1/2 z-30 px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                  <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" viewBox="0 0 6 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                  </span>
                </button>
              </div>
            </div>
          </div>
          
      <div class="right pt-[375px] md:pt-[50px]">
        <span class="inline-block opacity-0 animate-slide-in [animation-delay:0.2s]">Shop/{{ $product->category }}</span>
        <h1 class="opacity-0 animate-slide-in [animation-delay:0.3s]">{{ $product->name }}</h1>
        <span class="block opacity-0 animate-slide-in [animation-delay:0.4s]" style="display: block">
          <label for="size-select" class="block mb-2   cursor-pointer subtitle font-bold opacity-0 animate-slide-in [animation-delay:0.5s]" >
            Choisir la taille :
        </label>
        <select 
        style="font-size: 13px;"
            id="size-select" 
            name="size" 
            class="w-full px-4 py-10 text-gray-700 bg-white border-2 border-gray-200 rounded-lg shadow-sm appearance-none cursor-pointer focus:outline-none focus:border-[#C9B194] focus:ring-2 focus:ring-[#C9B194] focus:ring-opacity-50 transition-all duration-200 hover:border-gray-400 h-[42px]"
        >
            <option value="S/M" class="hover:bg-[#F5EEE6]">S/M</option>
            <option value="M/L" class="hover:bg-[#F5EEE6]">M/L</option>
        </select>
        </span>
      

        <div class="price-container opacity-0 animate-slide-in [animation-delay:0.5s]">
          @if($product->price_before_discount)
              <div class="flex flex-col md:flex-row md:items-center gap-3 group relative">
                  <!-- Original Price -->
                  <div class="flex items-center gap-2">
                    <span class="text-4xl font-bold text-[#C9B194] relative inline-block transform transition-all duration-300 hover:scale-105">
                      <span class="price-discounted animate-pop-in">€{{ $product->price }}</span>
                      <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#C9B194]/30 origin-left transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                  </span>
                      <span class="text-lg text-gray-500 relative">
                          <span class="line-through opacity-90 group-hover:opacity-60 transition-opacity duration-300">€{{ $product->price_before_discount }}</span>
                          <span class="absolute top-1/2 left-0 w-full h-px bg-[#C9B194]/40 transform -translate-y-1/2"></span>
                      </span>

                  </div>
              </div>
          @else
              <div class="text-4xl font-bold text-gray-900 relative group">
                  <span class="relative z-10">€{{ $product->price_before_discount }}</span>
                  <span class="absolute bottom-0 left-0 h-1.5 bg-[#C9B194]/20 w-full transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
              </div>
          @endif
      </div>
      
     
      
     
      <div class="form space-x-4" style="z-index: 0; display: flex; align-items: center;">
        <i class="bx bx-heart transition-all duration-300 hover:text-red-500 hover:scale-110 transform cursor-pointer heartbeat"   
           onclick="addToWishlist({{ $product->id }})"></i>
        <button 
          type="button"
          onclick="addToCart({{ $product->id }})"
          class="px-8 py-4 bg-gradient-to-r from-[#C9B194] to-[#D4C0A1] hover:from-[#B89E80] hover:to-[#C9B194] text-white rounded-full font-bold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
          Ajouter au panier →
        </button>
      </div>
      
      <!-- Champ de personnalisation -->
      <span class="mt-6 opacity-0 animate-slide-in [animation-delay:0.6s]" style="display: inline;">
        <span class="relative group">
            <input 
                type="text" 
                name="custom_text" 
                id="custom-text" 
                maxlength="5"
                placeholder=" "
                class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl peer focus:border-[#C9B194] focus:ring-2 focus:ring-[#C9B194]/30 transition-all duration-300 placeholder-transparent"
                oninput="updateCharCounter(this)">
            
            <label 
                for="custom-text" 
                class="absolute left-4 -top-2.5 bg-white px-2 text-gray-500 text-sm transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-[#C9B194]">
                Texte personnalisé (5 caractères max)
            </label>
            
            <div class="flex justify-between items-center mt-2">
                <div id="char-counter" class="text-sm text-gray-400 ml-2">0/5</div>
                <div id="custom-text-error" class="text-red-400 text-sm hidden">Maximum 5 caractères</div>
            </div>
          </span>
      </span>
        <h3 class="subtitle font-bold opacity-0 animate-slide-in [animation-delay:0.5s]">Description</h3>
        <p class="text-gray-500 opacity-0 animate-slide-in [animation-delay:0.6s]">{{ $product->description }}</p>
        <h3 class="subtitle font-bold mt-6">Composition</h3>
        <div class="composition-grid grid grid-cols-1 gap-4 mt-4">
          <!-- Item 1 -->
          <div class="composition-item group hover:bg-gray-50 p-4 rounded-lg transition-all duration-300">
            <div class="flex items-center gap-3 mb-2">
              <i class='bx bx-basket text-2xl text-[#ad8d55]'></i>
              <div>
                <span class="font-medium text-gray-700">Nylon</span>
                <span class="text-sm ml-2 text-gray-500">87%</span>
              </div>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div class="bg-[#ad8d55] h-2.5 rounded-full transition-all duration-500" 
                   style="width: 87%"></div>
            </div>
          </div>
  
          <!-- Item 2 -->
          <div class="composition-item group hover:bg-gray-50 p-4 rounded-lg transition-all duration-300">
            <div class="flex items-center gap-3 mb-2">
              <i class='bx bx-basket text-2xl text-[#ad8d55]'></i>
              <div>
                <span class="font-medium text-gray-700">Élasthanne</span>
                <span class="text-sm ml-2 text-gray-500">13%</span>
              </div>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div class="bg-[#ad8d55] h-2.5 rounded-full transition-all duration-500" 
                   style="width: 13%"></div>
            </div>
          </div>
        </div>
  
        <!-- Caractéristiques -->
      
        <h3 class="text-2xl font-bold text-gray-900">Caractéristiques</h3>
        <div class="flex flex-wrap gap-2">
          <span class="px-4 py-2 bg-[#C9B194]/10 text-[#C9B194] rounded-full text-sm font-medium">Moderne</span>
          <span class="px-4 py-2 bg-[#C9B194]/10 text-[#C9B194] rounded-full text-sm font-medium">Élégant</span>
          <span class="px-4 py-2 bg-[#C9B194]/10 text-[#C9B194] rounded-full text-sm font-medium">Confortable</span>
        </div>
      
      </div>
    </div>
  </section>
  
  <!-- Related -->
  <section class="section featured">
    <div class="top container">
      <h1 class="text-3xl font-bold">Produits Similaires</h1>
      @php  
          $category = '';  

          if ($product->category == 'ABAYA') {  
              $category = 'abayas';  
          } elseif ($product->category == 'KIMONO') {  
              $category = 'kimonos';  
          } elseif ($product->category == 'HIJAB') {  
              $category = 'hijabs';  
          } elseif ($product->category == 'ACCESSORY') {  
              $category = 'accessoires';  
          }  
      @endphp  

      <a href="{{ route('collections.' . $category) }}"   
        class="view-more text-3xl font-bold transition-all duration-300 hover:text-[#ad8d55] hover:translate-x-2">  
        Voir plus →  
      </a>  
    </div>
    <div class="product-center container">
      @foreach ($products as $product)
        <x-product :product="$product"></x-product>
      @endforeach
    </div>
  </section>

  <!-- Footer -->
  <x-footer></x-footer>

  <!-- Custom Script -->
  <script src="{{ asset('js/index.js') }}"></script>
  <script>
     function updateCharCounter(input) {
    const counter = document.getElementById('char-counter');
    const error = document.getElementById('custom-text-error');
    const length = input.value.length;
    
    counter.textContent = `${length}/5`;
    
    if(length > 5) {
        error.classList.remove('hidden');
        input.classList.add('border-red-500', 'focus:border-red-500');
    } else {
        error.classList.add('hidden');
        input.classList.remove('border-red-500', 'focus:border-red-500');
    }
}
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sizeSelect = document.getElementById('size-select');
        const customTextInput = document.getElementById('custom-text');
        const selectedSize = document.getElementById('selected-size');
        const selectedCustomText = document.getElementById('selected-custom-text');
    
        sizeSelect.addEventListener('change', function() {
            selectedSize.value = this.value;
        });
    
        customTextInput.addEventListener('input', function() {
            selectedCustomText.value = this.value.substring(0, 5);
        });
    });
    </script>
    <script>
      function addToCart(productId) {
        // grab the current size & custom text
        const size  = document.getElementById('size-select').value;
        const text  = document.getElementById('custom-text').value.substring(0, 5);
    
        fetch('{{ route("cart.add") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            product_id:  productId,
            size:        size,
            custom_text: text
          })
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            Swal.fire({
              icon: 'success',
              title: 'Produit ajouté !',
              text: data.message,
              showConfirmButton: false,
              timer: 1500
            }).then(() => {
              // reload to trigger your view‐composer and update cart badge
              location.reload();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Erreur',
              text: data.message || 'Impossible d’ajouter au panier.'
            });
          }
        })
        .catch(err => {
          console.error(err);
          Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Une erreur est survenue.'
          });
        });
      }
    </script>
    
  <script>
    document.addEventListener('DOMContentLoaded', function() {
  const sizeSelect = document.getElementById('size-select');
  const customTextInput = document.getElementById('custom-text');
  const checkoutButton = document.querySelector('a[href*="checkout"]');
  
  // Get the original base URL
  const baseUrl = checkoutButton.getAttribute('href');

  function updateCheckoutUrl() {
    // Create URL object to properly handle parameters
    const url = new URL(baseUrl, window.location.origin);
    
    url.searchParams.set('size', sizeSelect.value);
    url.searchParams.set('custom_text', customTextInput.value);

    checkoutButton.href = url.toString();

    console.log("Updated URL:", url.toString());
  }

  sizeSelect.addEventListener('change', updateCheckoutUrl);
  customTextInput.addEventListener('input', updateCheckoutUrl);

  updateCheckoutUrl();
});
    </script>
<script>
    function addToWishlist(productId) {
        fetch('{{ route('wishlist.add') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    title: 'Success!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    // Reload the page after closing the SweetAlert
                    location.reload();
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: data.message,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong.',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        });
    }
   
</script>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>
</html>
