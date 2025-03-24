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
        <span>Shop/{{ $product->category }}</span>
        <h1>{{ $product->name }}</h1>
        <div class="price">${{ $product->price }}</div>
        <div class="form" style="z-index: 0;display:flex">
            <i class="bx bx-heart" onclick="addToWishlist({{ $product->id }})" style="margin: 12px 10px;font-size: 20px;cursor:pointer"></i>  
            <a class="addCart" href="{{ route('checkout', $product->id) }}">Check Out</a>  
        </div>
        <h3 class="subtitle font-bold">Description</h3>
        <p class="text-gray-500">{{ $product->description }}</p>
      </div>
    </div>
  </section>
  
  <!-- Related -->
  <section class="section featured">
    <div class="top container">
      <h1 class="text-3xl font-bold">Related Products</h1>
      <a href="{{ route('shop') }}" class="view-more text-3xl hover:text-green-500 font-bold">View more</a>
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
