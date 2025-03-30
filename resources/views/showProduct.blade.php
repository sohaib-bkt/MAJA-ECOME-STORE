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
  <title>Product Details</title>
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
                    <img src="{{ asset('images/'.$product->image) }}" class="w-full h-full object-contain" alt="Product Image">
                  </div>
                  @foreach ($product->images as $productImage)
                  <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/'.$productImage) }}" class="w-full h-full object-contain" alt="Product Image">
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
        <div>
          
        </div>
        <div class="price opacity-0 animate-slide-in [animation-delay:0.4s]" style="display: inline-block;">  
          ${{ $product->price }}  
      </div>  
      <div class="form space-x-4" style="z-index: 0; display: flex; align-items: center;">  
          <i class="bx bx-heart transition-all duration-300 hover:text-red-500 hover:scale-110 transform cursor-pointer heartbeat"   
             onclick="addToWishlist({{ $product->id }})"></i>    
             <a href="{{ route('checkout', $product->id) }}" 
              class="px-8 py-4 bg-[#C9B194] hover:bg-[#B89E80] text-white rounded-full font-medium transition-colors shadow-md hover:shadow-lg">
             Commander
           </a> 
      </div>  
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
      <h1 class="text-3xl font-bold">Related Products</h1>
      <a href="{{ route('collections.abayas') }}" 
      class="view-more text-3xl font-bold transition-all duration-300 hover:text-[#ad8d55] hover:translate-x-2">
     View more →
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
