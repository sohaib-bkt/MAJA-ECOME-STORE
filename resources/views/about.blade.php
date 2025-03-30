<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>À Propos - Maja Store</title>
    
    <!-- Polices modernes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
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
          <!-- Image -->
          <div class="relative group h-[550px] md:h-[550px] rounded-2xl overflow-hidden shadow-2xl hover:shadow-3xl transition-shadow duration-500">
            <div class="absolute inset-0 bg-gradient-to-r from-[#C9B194]/20 to-transparent z-10"></div>
            <img 
              src="{{ asset('images/img2.jpeg') }}" 
              alt="Boutique Maja Store"
              class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out"
              loading="lazy"
              style="filter: brightness(0.8); object-position: 50% 22%;"
            />
          </div>

          <!-- Contenu texte -->
          <div class="space-y-6 md:space-y-8">
            <div class="inline-flex items-center gap-3 mb-4">
              <div class="h-px w-8 bg-[#C9B194]"></div>
              <span class="text-base font-semibold tracking-wide text-[#C9B194] uppercase">Notre Histoire</span>
            </div>
            
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 leading-snug">
              Redéfinir l'<span class="text-[#C9B194]">expérience</span> du luxe
            </h1>
            
            <p class="text-xl md:text-2xl text-gray-600 leading-relaxed">
              Chez Maja Store, nous croyons que le vrai luxe réside dans les détails. 
              Notre curation exclusive allie savoir-faire artisanal et design contemporain.
            </p>
            
            <ul class="grid grid-cols-2 gap-4">
              <li class="flex items-center gap-3 p-4 bg-white rounded-lg border border-gray-100">
                <div class="flex-shrink-0 w-8 h-8 bg-[#C9B194]/10 rounded-full flex items-center justify-center">
                  <i class='bx bx-check text-[#C9B194] text-2xl'></i>
                </div>
                <span class="text-base font-medium text-gray-700">Collections exclusives</span>
              </li>
              <li class="flex items-center gap-3 p-4 bg-white rounded-lg border border-gray-100">
                <div class="flex-shrink-0 w-8 h-8 bg-[#C9B194]/10 rounded-full flex items-center justify-center">
                  <i class='bx bx-check text-[#C9B194] text-2xl'></i>
                </div>
                <span class="text-base font-medium text-gray-700">Matériaux premium</span>
              </li>
            </ul>
            
            <a href="/collections" class="inline-flex items-center gap-2 px-8 py-4 bg-[#C9B194] hover:bg-[#B89E80] text-white rounded-full transition-all duration-300 group text-lg">
              <span>Découvrir la collection</span>
              <i class='bx bx-arrow-right text-2xl group-hover:translate-x-1 transition-transform'></i>
            </a>
          </div>
        </div>
      </section>

      <!-- Section Chiffres clés -->
      <section class="py-16 bg-[#C9B194]/10">
        <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-3 gap-8">
          <div class="text-center p-6">
            <div class="text-5xl md:text-6xl font-bold text-[#C9B194] mb-2">15+</div>
            <div class="text-gray-600 text-base">Années d'expertise</div>
          </div>
          <div class="text-center p-6">
            <div class="text-5xl md:text-6xl font-bold text-[#C9B194] mb-2">200+</div>
            <div class="text-gray-600 text-base">Créations uniques</div>
          </div>
          <div class="text-center p-6">
            <div class="text-5xl md:text-6xl font-bold text-[#C9B194] mb-2">98%</div>
            <div class="text-gray-600 text-base">Clients satisfaits</div>
          </div>
        </div>
      </section>
    </main>
    <x-footer class="scroll-section"></x-footer>
    <script src="{{ asset('js/index.js') }}"></script>
  </body>
</html>