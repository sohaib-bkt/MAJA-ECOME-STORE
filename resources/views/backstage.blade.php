<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Modern Backstage Gallery</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in { 
            animation: fadeIn 0.6s ease-out; 
        }
        
        .aspect-portrait { 
            aspect-ratio: 3/4; 
        }
        
        .aspect-landscape { 
            aspect-ratio: 16/9; 
        }
        
        .aspect-square { 
            aspect-ratio: 1/1; 
        }
        
        .aspect-panorama { 
            aspect-ratio: 2/1; 
        }
        
        .aspect-vertical { 
            aspect-ratio: 9/16; 
        }
        
        .image-container {
            position: relative;
            overflow: hidden;
        }
        
        .image-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: translateX(-100%);
            animation: shimmer 1.5s infinite;
            z-index: 1;
        }
        
        @keyframes shimmer {
            100% {
                transform: translateX(100%);
            }
        }
        
        /* Custom scrollbar for modern feel */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #d1d1d1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-neutral-50 font-['Inter'] text-neutral-900 selection:bg-[#e6cba9]">

    <!-- Navigation Section -->
    <x-nav></x-nav>

    <!-- Hero Section -->
    <section class="container mx-auto px-4 py-12 md:py-20 lg:py-28 " style="margin-top: 22px">
        <div class="max-w-4xl mx-auto text-center space-y-6">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-thin mb-6 animate-fade-in">
                Derrière le <span class="bg-gradient-to-r from-[#e6cba9] to-[#e0963b] bg-clip-text text-transparent">Vision</span>
            </h1>
            <p class="text-gray-600 md:text-xl leading-relaxed max-w-3xl mx-auto">
                
Entrez dans notre sanctuaire créatif. Découvrez la fusion de la créativité brute et du savoir-faire de précision qui caractérise nos collections.
            </p>
        </div>
    </section>

    <main class="container mx-auto px-4 pb-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">

            <div class="md:col-span-3 group relative aspect-[2/1] overflow-hidden cursor-pointer rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                <img src="{{ asset('images/b1.jpg')}}" alt="Workshop" 
                     class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105"
                     loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-4 md:p-6">
                    <div class="space-y-2 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                        <span class="text-white text-lg font-medium">Studio Workshop</span>
                        <span class="text-gray-300 text-sm block">Exploring material possibilities</span>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4 md:contents">
                <div class="group relative aspect-[3/4] md:aspect-square overflow-hidden cursor-pointer rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                
                    <video autoplay muted loop playsinline 
                           class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <source src="{{ asset('videos/bv.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                
                    <div class="absolute inset-0 flex items-end p-4 md:p-6 bg-gradient-to-t from-black/50 to-transparent">
                        <span class="text-white text-sm md:text-lg opacity-0 -translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                            Final Fitting
                        </span>
                    </div>
                </div>
                <div class="group relative aspect-square overflow-hidden cursor-pointer rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>
                    <img src="{{ asset('images/b1.jpg')}}" alt="Design" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                         loading="lazy">
                         <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-3 md:p-6 space-y-2 md:space-y-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
                            <span class="text-white text-base md:text-xl font-light">Material Selection</span>
                            <p class="text-gray-300 text-xs md:text-sm">Curating sustainable materials</p>
                        </div>
                </div>
            </div>
    
            <div class="md:col-span-3 group relative aspect-video overflow-hidden cursor-pointer rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                <img src="{{ asset('images/b4.jpeg')}}" alt="Team" 
                     class="w-full h-full object-cover transition-filter duration-500 group-hover:brightness-110"
                     style="object-position: 50% 32%;"
                     loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-4 md:p-6">
                        <div class="space-y-2 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                            <span class="text-white text-lg font-medium">Studio Workshop</span>
                            <span class="text-gray-300 text-sm block">Exploring material possibilities</span>
                        </div>
                    </div>
                
            </div>

            <div class="grid grid-cols-2 gap-4 md:contents">
                <div class="group relative aspect-[9/16] md:aspect-square overflow-hidden cursor-pointer rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <img src="{{ asset('images/b3.jpg')}}" alt="Model" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                         loading="lazy">
                    <div class="absolute inset-0 flex items-end p-4 md:p-6 bg-gradient-to-t from-black/50 to-transparent">
                        <span class="text-white text-sm md:text-lg opacity-0 -translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                            Final Fitting
                        </span>
                    </div>
                </div>
                
                <div class="group relative aspect-[9/16] md:aspect-square overflow-hidden cursor-pointer rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <video 
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                        autoplay
                        muted
                        loop
                        playsinline
                        poster="{{ asset('images/b3.jpg') }}" 
                    >
                        <source src="{{ asset('videos/bv2.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    
                    <div class="absolute inset-0 flex items-end p-4 md:p-6 bg-gradient-to-t from-black/50 to-transparent">
                        <span class="text-white text-sm md:text-lg opacity-0 -translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                            Final Fitting
                        </span>
                    </div>
                </div>
            </div>

            <div class="group relative aspect-square md:aspect-video overflow-hidden cursor-pointer rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                <img src="{{ asset('images/b2.jpg')}}" alt="Details" 
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                     loading="lazy">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 scale-50 group-hover:opacity-100 group-hover:scale-100 transition-all duration-500 shadow-lg">
                        <span class="text-black text-xs md:text-sm font-medium">View</span>
                    </div>
                </div>
            </div>
    
            <div class="grid grid-cols-2 gap-4 md:contents">
                <div class="group relative aspect-[9/14] md:aspect-square overflow-hidden cursor-pointer rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <video 
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                        autoplay
                        muted
                        loop
                        playsinline
                        poster="{{ asset('images/b1.jpg') }}" 
                    >
                        <source src="{{ asset('videos/bv3.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    
                    <!-- Existing overlay content -->
                    <div class="absolute inset-0 flex items-end p-4 md:p-6 bg-gradient-to-t from-black/50 to-transparent">
                        <span class="text-white text-sm md:text-lg opacity-0 -translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                            Final Fitting
                        </span>
                    </div>
                </div>
                
            </div>
        </div>
    </main>

    <section class="container mx-auto px-4 py-12 md:py-16">
        <div class="max-w-xl mx-auto text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-light mb-4">Explorez notre processus</h2>
            <p class="text-gray-600">Faites glisser ou faites défiler le parcours créatif qui définit notre travail.</p>
        </div>
        
        <div class="relative">
            <!-- Scroll Container -->
            <div id="scrollContainer" class="flex overflow-x-auto pb-6 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-transparent snap-x snap-mandatory">
                <div class="flex gap-6 px-4 md:px-8">
                    <div class="flex-none w-72 snap-center rounded-xl overflow-hidden shadow-sm">
                        <div class="relative aspect-video">
                            <img src="{{ asset("images/img1.jpeg")}}" alt="Concept sketching" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4 bg-white">
                            <h3 class="font-medium text-lg mb-1">Concept initiale</h3>
                            <p class="text-sm text-gray-600">Les premiers coups de pinceau de chaque nouvelle idée</p>
                        </div>
                    </div>
                    <div class="flex-none w-72 snap-center rounded-xl overflow-hidden shadow-sm">
                        <div class="relative aspect-video">
                            <img src="{{ asset("images/img1.jpeg")}}" alt="Material research" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4 bg-white">
                            <h3 class="font-medium text-lg mb-1">Etude Matériel</h3>
                            <p class="text-sm text-gray-600">Recherche sur les matériaux et leur utilisation</p>
                        </div>
                    </div>
                    <div class="flex-none w-72 snap-center rounded-xl overflow-hidden shadow-sm">
                        <div class="relative aspect-video">
                            <img src="{{ asset("images/img1.jpeg")}}" alt="Prototyping" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4 bg-white">
                            <h3 class="font-medium text-lg mb-1">Prototyping</h3>
                            <p class="text-sm text-gray-600">Du concept à la première forme physique</p>
                        </div>
                    </div>
                    <div class="flex-none w-72 snap-center rounded-xl overflow-hidden shadow-sm">
                        <div class="relative aspect-video">
                            <img src="{{ asset("images/img1.jpeg")}}" alt="Refinement" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4 bg-white">
                            <h3 class="font-medium text-lg mb-1">Raffinement</h3>
                            <p class="text-sm text-gray-600">Perfectionner chaque détail et élément</p>
                        </div>
                    </div>
                    <div class="flex-none w-72 snap-center rounded-xl overflow-hidden shadow-sm">
                        <div class="relative aspect-video">
                            <img src="{{ asset("images/img1.jpeg")}}" alt="Final product" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4 bg-white">
                            <h3 class="font-medium text-lg mb-1">Produit final</h3>
                            <p class="text-sm text-gray-600">L'aboutissement de notre processus créatif</p>
                        </div>
                    </div>
                    
                </div>
            </div>
    
            <!-- Navigation Buttons -->
            <div class="hidden md:flex justify-between absolute top-1/2 left-0 right-0 -translate-y-1/2 pointer-events-none px-2">
                <button 
                    id="prevButton"
                    class="h-12 w-12 rounded-full bg-white/70 backdrop-blur-sm shadow-lg flex items-center justify-center pointer-events-auto cursor-pointer hover:bg-white transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                    aria-label="Étape précédente">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <button 
                    id="nextButton"
                    class="h-12 w-12 rounded-full bg-white/70 backdrop-blur-sm shadow-lg flex items-center justify-center pointer-events-auto cursor-pointer hover:bg-white transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                    aria-label="Étape suivante">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
        </div>
    </section>
    
    

    <footer class="container mx-auto px-4 py-16 md:py-24 text-center">
        <div class="border-t border-gray-200 pt-16">
            <h2 class="text-2xl md:text-3xl font-light mb-6">Continuez le voyage</h2>
            
            <div class="mt-12 flex flex-col md:flex-row justify-center md:space-x-8 space-y-4 md:space-y-0">
                <a href="#" class="group flex items-center justify-center md:justify-start gap-2 text-gray-500 hover:text-black transition-colors duration-300">
                    <span class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 group-hover:bg-purple-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </span>
                    <span>Instagram</span>
                </a>
                <a href="#" class="group flex items-center justify-center md:justify-start gap-2 text-gray-500 hover:text-black transition-colors duration-300">
                    <span class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 group-hover:bg-purple-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5z"></path>
                            <path d="M8 7h6"></path>
                            <path d="M8 11h8"></path>
                            <path d="M8 15h5"></path>
                        </svg>
                    </span>
                    <span>Process Journal</span>
                </a>
                <a href="#" class="group flex items-center justify-center md:justify-start gap-2 text-gray-500 hover:text-black transition-colors duration-300">
                    <span class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 group-hover:bg-purple-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </span>
                    <span>Contact Studio</span>
                </a>
            </div>


        </div>
    </footer>
    <x-footer></x-footer>

    <script>
        const scrollContainer = document.getElementById('scrollContainer');
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');
    
        function updateButtonStates() {
            const { scrollLeft, scrollWidth, clientWidth } = scrollContainer;
            prevButton.disabled = scrollLeft === 0;
            nextButton.disabled = scrollLeft >= scrollWidth - clientWidth - 1;
        }
    
        function scrollTo(direction) {
            const itemWidth = scrollContainer.querySelector('.snap-center').offsetWidth;
            const gap = 24; 
            const scrollAmount = itemWidth + gap;
            
            scrollContainer.scrollBy({
                left: direction === 'next' ? scrollAmount : -scrollAmount,
                behavior: 'smooth'
            });
        }

        prevButton.addEventListener('click', () => scrollTo('prev'));
        nextButton.addEventListener('click', () => scrollTo('next'));
        scrollContainer.addEventListener('scroll', updateButtonStates);

        updateButtonStates();
    </script>
    <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>