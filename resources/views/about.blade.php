<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Notre histoire - MAJA</title>
    
    <!-- Polices modernes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    
    <!-- Animation library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    
    <style>
      html {
        font-size: 62.5%;
        scroll-behavior: smooth;
      }
      
      /* Ajustements typographiques */
      h1 { font-size: 4.8rem; }
      h2 { font-size: 3.6rem; }
      p { font-size: 1.8rem; }
      
      @media (min-width: 768px) {
        h1 { font-size: 5.6rem; }
        h2 { font-size: 4.2rem; }
      }
      
      /* Animations custom */
      .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.8s ease, transform 0.8s ease;
      }
      
      .fade-in.active {
        opacity: 1;
        transform: translateY(0);
      }
      
      .slide-in-left {
        opacity: 0;
        transform: translateX(-50px);
        transition: opacity 0.8s ease, transform 0.8s ease;
      }
      
      .slide-in-right {
        opacity: 0;
        transform: translateX(50px);
        transition: opacity 0.8s ease, transform 0.8s ease;
      }
      
      .slide-in-left.active, .slide-in-right.active {
        opacity: 1;
        transform: translateX(0);
      }
      
      /* Stats counter animation */
      .counter-value {
        display: inline-block;
        position: relative;
      }
      
      /* Image hover effect enhancement */
      .image-container {
        position: relative;
        overflow: hidden;
      }
      
      .image-container::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: 0.5s;
      }
      
      .image-container:hover::after {
        left: 100%;
      }
      
      /* Button pulse effect */
      @keyframes pulse {
        0% {
          box-shadow: 0 0 0 0 rgba(201, 177, 148, 0.7);
        }
        70% {
          box-shadow: 0 0 0 10px rgba(201, 177, 148, 0);
        }
        100% {
          box-shadow: 0 0 0 0 rgba(201, 177, 148, 0);
        }
      }
      
      .pulse-btn {
        animation: pulse 2s infinite;
      }
      
      /* Parallax effect */
      .parallax {
        transition: transform 0.5s cubic-bezier(0.2, 0.8, 0.2, 1);
      }
    </style>
    
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}" />
  </head>
  
  <body class="font-inter bg-gray-50">
    <x-nav />
    
    <main class="overflow-hidden">
      <!-- Section À Propos -->
      <section class="relative py-20 md:py-28 px-4">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 md:gap-16 items-center">
          <!-- Image avec effet parallax -->
          <div class="relative group h-[550px] md:h-[550px] rounded-2xl overflow-hidden shadow-2xl hover:shadow-3xl transition-shadow duration-500 image-container slide-in-left">
            <div class="absolute inset-0 bg-gradient-to-r from-[#C9B194]/20 to-transparent z-10"></div>
            <img 
              src="{{ asset('images/hist.jpg') }}" 
              alt="Boutique Maja Store"
              class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out parallax"
              loading="lazy"
              style="filter: brightness(0.8); object-position: 50% 22%;"
              data-speed="0.15"
            />
          </div>

          <!-- Contenu texte avec animations -->
          <div class="space-y-6 md:space-y-8 slide-in-right">
            <div class="inline-flex items-center gap-3 mb-4 fade-in">
              <div class="h-px w-8 bg-[#C9B194]"></div>
              <span class="text-base font-semibold tracking-wide text-[#C9B194] uppercase">Notre Histoire</span>
            </div>
          
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 leading-snug fade-in" style="transition-delay: 0.1s">
              Redéfinir l'<span class="text-[#C9B194] animate__animated animate__fadeIn animate__slow">expérience</span> du luxe
            </h1>
          
            <div class="text-lg md:text-3xl text-gray-600 leading-relaxed space-y-4 fade-in" style="transition-delay: 0.2s">
              <p>
                Majāa est née d’une passion pour la mode et du désir d’offrir des pièces élégantes, uniques et qualitatives. Chaque création est imaginée avec soin, confectionnée avec amour et pensée pour sublimer chaque femme à travers une esthétique alliant simplicité et raffinement.
              </p>
          
              <p>
                Forte d'une formation dans l’univers de la mode et du luxe, notre fondatrice a conçu une marque incarnant sa vision : des collections raffinées où la qualité des tissus et la précision des broderies font toute la différence. Une approche minutieuse qui transforme chaque pièce en un accessoire d'exception, apportant une touche d’originalité à celles qui la portent.
              </p>
          
              <p>
                Chez Majāa, l'histoire se tisse dans chaque détail. Du savoir-faire artisanal à la passion pour l’élégance intemporelle, nous nous engageons à répondre à vos attentes.
              </p>
            </div>
          
            <ul class="grid grid-cols-2 gap-4">
              <li class="flex items-center gap-3 p-4 bg-white rounded-lg border border-gray-100 fade-in" style="transition-delay: 0.3s">
                <div class="flex-shrink-0 w-8 h-8 bg-[#C9B194]/10 rounded-full flex items-center justify-center animate__animated animate__bounceIn">
                  <i class='bx bx-check text-[#C9B194] text-2xl'></i>
                </div>
                <span class="text-lg font-medium text-gray-700">Collections exclusives</span>
              </li>
              <li class="flex items-center gap-3 p-4 bg-white rounded-lg border border-gray-100 fade-in" style="transition-delay: 0.4s">
                <div class="flex-shrink-0 w-8 h-8 bg-[#C9B194]/10 rounded-full flex items-center justify-center animate__animated animate__bounceIn" style="animation-delay: 0.2s">
                  <i class='bx bx-check text-[#C9B194] text-2xl'></i>
                </div>
                <span class="text-lg font-medium text-gray-700">Matériaux premium</span>
              </li>
            </ul>
          
            <a href="{{ route('collections.abayas') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-[#C9B194] hover:bg-[#B89E80] text-white rounded-full transition-all duration-300 group text-lg pulse-btn fade-in" style="transition-delay: 0.5s">
              <span>Découvrir la collection</span>
              <i class='bx bx-arrow-right text-2xl group-hover:translate-x-1 transition-transform'></i>
            </a>
          </div>
        </div>
      </section>

    </main>
    <x-footer class="scroll-section"></x-footer>
    
    <script src="{{ asset('js/index.js') }}"></script>
    
    <!-- Animation Scripts -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Fade in elements animation on scroll
        const fadeElements = document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right');
        
        const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              entry.target.classList.add('active');
            }
          });
        }, { threshold: 0.1 });
        
        fadeElements.forEach(element => {
          observer.observe(element);
        });
        
        
        
        // Parallax effect for image
        const parallaxElements = document.querySelectorAll('.parallax');
        
        window.addEventListener('scroll', () => {
          parallaxElements.forEach(element => {
            const speed = element.getAttribute('data-speed') || 0.1;
            const yPos = -(window.scrollY * speed);
            element.style.transform = `translateY(${yPos}px)`;
          });
        });
        
        // Initial trigger for elements already in viewport
        setTimeout(() => {
          window.dispatchEvent(new Event('scroll'));
        }, 300);
      });
    </script>
  </body>
</html>