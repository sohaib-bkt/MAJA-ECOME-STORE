<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      
        <!-- Boxicons -->
        <link
          href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
          rel="stylesheet"
        />
        <style>
          @media screen and (min-width: 600px) {
            #home-image {
              background-position-y: 20%;
              
            }
          }

        </style>
        <title>Gift 4U</title>
        @vite('resources/css/app.css')
        
        <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
        
      </head>
      <body>

      <!-- Header -->
      <header class="relative" id="header">  
        <div id="home-image" class="bg-cover bg-center h-screen" style="background-image: url('/images/home1.jpeg'); ">  
            <x-nav></x-nav>  
        
            {{-- <div class="flex flex-col max-w-full gap-y-0 px-8 py-6 mx-auto md:max-w-screen-md md:px-12 md:py-8">  
                <h2 class="text-white text-4xl md:text-5xl font-bold text-center mb-4">Eid Collection</h2>  
                <div class="flex items-center justify-center gap-4">  
                    <a href="/collections/eid25" class=" text-white py-2 px-4 rounded  transition">Shop Now</a>  
                    <a href="/pages/eid-25" class=" text-white py-2 px-4 rounded  transition">EXPLORE</a>  
                </div>  
            </div>   --}}
        </div>  
    </header>   

    
        <!-- Categories Section -->
        <section class="section category">
          <div class="cat-center">
            <div class="cat">
              <img src="{{ asset('images/logo1.png')}}" alt="" />
              <div>
                <p>WOMEN'S WEAR</p>
              </div>
            </div>
            <div class="cat">
              <img src="{{ asset('images/logo1.png')}}" alt="" />
              <div>
                <p>ACCESSORIES</p>
              </div>
            </div>
          </div>
        </section>
    
        <!-- New Arrivals -->
        <section class="section new-arrival">
          <div class="title">
            <h1>NEW ARRIVALS</h1>
            <p>All the latest picked from designer of our store</p>
          </div>
    
          <div class="product-center">
            
            {{-- <div class="product-item">
              <div class="overlay">
                <a href="" class="product-thumb">
                  <img src="./images/pro1.jpeg" alt="" />
                </a>
                <span class="discount">50%</span>
              </div>
    
              <div class="product-info">
                <span>MEN'S CLOTHES</span>
                <a href="">Sonata White Men’s Shirt</a>
                <h4>$800</h4>
              </div>
              <ul class="icons">
                <li><i class="bx bx-heart"></i></li>
                <li><i class="bx bx-search"></i></li>
                <li><i class="bx bx-cart"></i></li>
              </ul>
            </div> --}}
            @foreach ($products as $product)
                <x-product :product="$product"></x-product>
            @endforeach
  
            
          </div>
        </section>
    
    
        <!-- Promo -->
    
        <section class="section banner flex flex-col md:flex-row items-center justify-between px-6 md:px-12 md:gap-11 py-2 bg-gray-50">
          <div class="left ">
            <span class="trend">Trend Design</span>
            <h1>New Collection 2025</h1>
            <p >
              New Arrival <span class="color">Sale 50% OFF</span> Limited Time Offer
            </p>
            <a href="{{ route('collections.abayas') }}" 
               class="btn btn-1 mt-6 inline-block bg-beige-500 text-white font-medium py-3 px-6 rounded-md hover:bg-beige-600 transition">
              Discover Now
            </a>
          </div>
          <div class="md:w-1/2 mt-6 md:mt-0 w-full">
            <img src="{{ asset('images/img1.jpeg') }}" alt="New Collection" class="w-full h-auto object-cover rounded-lg">
          </div>
        </section>

        <!-- Contact -->
        <section class="section contact">
          <div class="row">
            <div class="col">
              <h2>EXCELLENT SUPPORT</h2>
              <p>We love our customers and they can reach us any time
              of day we will be at your service 24/7</p>
              <a href="" class="btn btn-1">Contact</a>
            </div>
            <div class="col">
              <form action="">
                <div>
                  <input type="email" placeholder="Email Address" style="color: rgb(48, 48, 48)">
                <a href="">Send</a>
                </div>
              </form>
            </div>
          </div>
        </section>
    
        <!-- Footer -->
        <x-footer></x-footer>
    

    
      </body>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/glide.min.js"></script>
      <script src="{{ asset('js/slider.js') }}"></script>
      <script src="{{ asset('js/index.js') }}"></script>
    </html>
    