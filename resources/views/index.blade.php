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
        <!-- Glide js -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.theme.css">

        <title>Gift 4U</title>
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
      </head>
      <body>

        <!-- Header -->
        <header class="header" id="header">
          <x-nav></x-nav>
    
          <div class="hero">
          <div class="glide" id="glide_1">
            <div class="glide__track" data-glide-el="track">
              <ul class="glide__slides">
                <li class="glide__slide">
                  <div class="center">
                    <div class="left">
                      <span class="">New Inspiration 2024</span>
                      <h1 class="">Discover Our Collection!</h1>
                      <p>Explore the hottest trends in gifts for both men and women.</p>
                      <a href="{{ route('shop') }}" class="hero-btn">SHOP NOW</a>                      
                    </div>
                    <div class="right">
                        <img class="img1" src="{{ asset('images/gift5.png')}}" alt="">
                    </div>
                  </div>
                </li>
                <li class="glide__slide">
                  <div class="center">
                    <div class="left">
                      <span>New Inspiration 2024</span>
                      <h1>Unveil the Latest Trends!</h1>
                      <p> Find the perfect present to make any occasion special.</p>
                      <a href="{{ route('shop')}}" class="hero-btn">SHOP NOW</a>
                    </div>
                    <div class="right">
                      <img class="img2" src="{{ asset('images/gift6.png')}}" alt="">
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        </header>
    
        <!-- Categories Section -->
        <section class="section category">
          <div class="cat-center">
            <div class="cat">
              <img src="{{ asset('images/logo.png')}}" alt="" />
              <div>
                <p>WOMEN'S WEAR</p>
              </div>
            </div>
            <div class="cat">
              <img src="{{ asset('images/logo.png')}}" alt="" />
              <div>
                <p>ACCESSORIES</p>
              </div>
            </div>
            <div class="cat">
              <img src="{{ asset('images/logo.png')}}" alt="" />
              <div>
                <p>MEN'S WEAR</p>
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
                  <img src="./images/product-3.jpg" alt="" />
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
    
        <section class="section banner">
    <div class="left">
      <span class="trend">Trend Design</span>
      <h1>New Collection 2024</h1>
      <p>New Arrival <span class="color">Sale 50% OFF</span> Limited Time Offer</p>
      <a href="{{ route('shop')}}" class="btn btn-1">Discover Now</a>
    </div>
    <div class="right">
      <img src="" alt="">
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
    