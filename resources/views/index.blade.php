<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <style>
      @media screen and (min-width: 600px) {
        #home-image {
          background-position-y: 20%;
        }
      }

      /* Custom Animations */
      @keyframes fadeInUp {
        from {
          opacity: 0;
          transform: translateY(50px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      @keyframes scaleIn {
        from {
          opacity: 0;
          transform: scale(0.8);
        }
        to {
          opacity: 1;
          transform: scale(1);
        }
      }

      .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
      }

      .animate-scale-in {
        animation: scaleIn 0.6s ease-out forwards;
      }

      .scroll-section {
        opacity: 0;
        transition: opacity 0.6s, transform 0.6s;
      }
      .loaded {   
        animation: fadeInUp 0.6s ease-out forwards;  
      }  
    </style>
    <title>MAJĀA</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
  </head>
  <body class="scroll-smooth selection:bg-[#e6cba9]" >

    <!-- Flash Message -->
    @if(session('success') && session('flash_data'))
      <div class="absolute top-28 left-1/2  md:left-[70%] transform -translate-x-1/2 z-50 animate-fade-in-up px-4 sm:w-auto sm:px-0">
        <x-flash-card :flashData="session('flash_data')" />
      </div>
    @endif

    <!-- Header -->
    <header class="relative" id="header">
      <div
        id="home-image"
        class="bg-cover bg-center h-screen relative"
        style="background-image: url('/images/home1.jpeg')"
      >
        <x-nav></x-nav>

       

        
        
        <!-- Centered Shop Button -->
        <div class="absolute bottom-20 left-1/2 transform -translate-x-1/2 text-center">  
          <a  
            href="{{ route('collections.abayas') }}"  
            class="bg-white text-gray-800 px-8 py-4 rounded-full font-medium text-[20px] inline-flex items-center shadow-lg transition-transform transition-opacity duration-300 hover:bg-gray-100 hover:scale-110 hover:opacity-80 loaded"  
          >  
            <i class="bx bx-shopping-bag mr-2 text-2xl"> Achetez maintenant</i>   
          </a>  
        </div>   
      </div>
    </header>


    <!-- New Arrivals -->
    <section class="section new-arrival scroll-section">
      <div class="title">
        <h1 class="opacity-0">NOUVEAUTÉS</h1>
        <p class="opacity-0">Toutes les dernières nouveautés sélectionnées par les créateurs de notre boutique</p>
      </div>
      <div class="product-center">
        @foreach ($products as $product)
        <x-product :product="$product" class="scroll-section"></x-product>
        @endforeach
      </div>
    </section>

    <!-- Promo -->
    <section
      class="section banner flex flex-col md:flex-row items-center justify-between px-6 md:px-12 md:gap-11 py-2 bg-gray-50 scroll-section"
    >
      <div class="left opacity-0">
        <span class="trend">Tendance</span>
        <h1>Nouvelle Collection 2025</h1>
        <p>Nouvelle Arrivage , Offre Limitée</p>
        <a
          href="{{ route('collections.abayas') }}"
          class="btn btn-1 mt-6 inline-block bg-beige-500 text-white font-medium py-3 px-6 rounded-md hover:bg-beige-600 transition transform hover:scale-105"
        >
        Découvrez maintenant
        </a>
      </div>
      <div class="md:w-1/2 mt-6 md:mt-0 w-full opacity-0">
        <img
          src="{{ asset('images/img1.jpeg') }}"
          alt="New Collection"
          class="w-full h-auto object-cover rounded-lg transition-transform duration-500 hover:scale-103"
        />
      </div>
    </section>

    <!-- Contact -->
    <section class="section contact scroll-section">
      <div class="row">
        <div class="col opacity-0">
          <h2>EXCELLENT SUPPORT</h2>
          <p>Nous sommes à votre écoute 7j/7 pour tout renseignements</p>
          <a href="" class="btn btn-1 transform hover:scale-105 transition">Contact</a>
        </div>
        <div class="col opacity-0">
          <form action="">
            <div>
              <input type="email" placeholder="Email Address" style="color: rgb(48, 48, 48)" />
              <a href="" class="transform hover:scale-105 transition">Envoyer</a>
            </div>
          </form>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <x-footer class="scroll-section"></x-footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/glide.min.js"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>

    <!-- Scroll Animation Script -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const observerOptions = {
          threshold: 0.1,
          rootMargin: '0px'
        };

        const animateElements = (entries, observer) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              const element = entry.target;
              
              // Add base animation class
              element.classList.add('animate-fade-in-up');
              
              // Handle delayed animations
              const delay = element.dataset.delay || 0;
              setTimeout(() => {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
                
                // Animate child elements
                const children = element.querySelectorAll('.opacity-0');
                children.forEach((child, index) => {
                  setTimeout(() => {
                    child.classList.add('animate-fade-in-up');
                    child.style.opacity = '1';
                    child.style.transform = 'translateY(0)';
                  }, index * 200);
                });
              }, delay);
              
              observer.unobserve(element);
            }
          });
        };

        const observer = new IntersectionObserver(animateElements, observerOptions);

        // Observe all scroll sections
        document.querySelectorAll('.scroll-section').forEach(section => {
          section.style.opacity = '0';
          section.style.transform = 'translateY(50px)';
          observer.observe(section);
        });

        // Animate header button separately
        const headerButton = document.querySelector('#home-image .scroll-section');
        if (headerButton) {
          headerButton.style.opacity = '0';
          headerButton.style.transform = 'translateY(50px)';
          observer.observe(headerButton);
        }
      });
    </script>
  </body>
</html>