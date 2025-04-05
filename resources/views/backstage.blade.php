<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Backstage - MAJA</title>
    
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
        /* Ajoutez ces styles */
        .scroll-animate {
            opacity: 0;
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .grid-animate {
            transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .scroll-animate.animate-fade-in {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Animation pour les éléments de la grille */
        .grid-animate.opacity-100 {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
        
        /* Animation supplémentaire pour les cartes */
        .card-animate {
            transform: perspective(1000px) rotateX(-10deg) translateZ(0);
            transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .card-animate.visible {
            transform: perspective(1000px) rotateX(0) translateZ(0);
            opacity: 1 !important;
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
                DANS LES <span class="bg-gradient-to-r from-[#e6cba9] to-[#e0963b] bg-clip-text text-transparent">BACKSTAGES</span>
            </h1>
            <p class="text-gray-600 md:text-xl leading-relaxed max-w-3xl mx-auto">
                Bienvenue dans les backstages de Majāa, là où chaque détail est façonné avec amour et passion. On vous emmène au cœur de notre univers, là où les idées prennent vie et où chaque instant raconte une histoire. Plongez avec nous dans cette aventure !
            </p>
        </div>
    </section>

    <main class="container mx-auto px-4 pb-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">

            <div class="grid-animate md:col-span-3 group relative aspect-[2/1] overflow-hidden cursor-pointer rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                <img src="{{ asset('images/b5.jpg')}}" alt="Workshop" 
                     class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105"
                     loading="lazy">
                {{-- <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-4 md:p-6">
                    <div class="space-y-2 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                        <span class="text-white text-lg font-medium">Studio Workshop</span>
                        <span class="text-gray-300 text-sm block">Exploring material possibilities</span>
                    </div>
                </div> --}}
            </div>
            
            <div class="grid grid-cols-2 gap-4 md:contents grid-animate">
                <div class="group relative aspect-[3/4] md:aspect-square overflow-hidden cursor-pointer rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                
                    <video autoplay muted loop playsinline 
                           class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <source src="{{ asset('videos/bv.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                
                    {{-- <div class="absolute inset-0 flex items-end p-4 md:p-6 bg-gradient-to-t from-black/50 to-transparent">
                        <span class="text-white text-sm md:text-lg opacity-0 -translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                            Final Fitting
                        </span>
                    </div> --}}
                </div>
                <div class="grid-animate group relative aspect-[9/16 md:aspect-[9/9] overflow-hidden cursor-pointer rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>
                    <img src="{{ asset('images/b1.jpg')}}" alt="Design" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                         loading="lazy">
                         {{-- <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-3 md:p-6 space-y-2 md:space-y-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
                            <span class="text-white text-base md:text-xl font-light">Material Selection</span>
                            <p class="text-gray-300 text-xs md:text-sm">Curating sustainable materials</p>
                        </div> --}}
                </div>
            </div>
    
            
            <div class="grid grid-cols-2 gap-4 md:contents">
                <div class="grid-animate group relative aspect-[9/16] md:aspect-square overflow-hidden cursor-pointer rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <img src="{{ asset('images/b3.jpg')}}" alt="Model" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                         loading="lazy">
                    {{-- <div class="absolute inset-0 flex items-end p-4 md:p-6 bg-gradient-to-t from-black/50 to-transparent">
                        <span class="text-white text-sm md:text-lg opacity-0 -translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                            Final Fitting2
                        </span>
                    </div> --}}
                </div>
                
                <div class="grid-animate group relative aspect-[9/16] md:aspect-square overflow-hidden cursor-pointer rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
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
                    
                    {{-- <div class="absolute inset-0 flex items-end p-4 md:p-6 bg-gradient-to-t from-black/50 to-transparent">
                        <span class="text-white text-sm md:text-lg opacity-0 -translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                            Final Fitting22
                        </span>
                    </div> --}}
                </div>
            </div>

            <div class="grid-animate group relative aspect-square md:aspect-video overflow-hidden cursor-pointer rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                <img src="{{ asset('images/b2.jpg')}}" alt="Details" 
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                     loading="lazy">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 scale-50 group-hover:opacity-100 group-hover:scale-100 transition-all duration-500 shadow-lg">
                        <span class="text-black text-xs md:text-sm font-medium">View</span>
                    </div>
                </div>
            </div>
    
            <div class="grid-animate grid grid-cols-2 gap-4 md:contents">
                <div class=" group relative aspect-[9/14] md:aspect-square overflow-hidden cursor-pointer rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
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
                    
                    {{-- <div class="absolute inset-0 flex items-end p-4 md:p-6 bg-gradient-to-t from-black/50 to-transparent">
                        <span class="text-white text-sm md:text-lg opacity-0 -translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                            Final Fitting
                        </span>
                    </div> --}}
                </div>
                
            </div>
        </div>
    </main>


    <footer class="container mx-auto px-4 py-16 md:py-24 text-center scroll-animate" style="margin-bottom: 22px ">
        <div class="border-t border-gray-200 pt-16">
            <h2 class="text-2xl md:text-3xl font-light mb-6">Continuez le voyage</h2>
            
            <div class="mt-12 flex flex-col md:flex-row justify-center md:space-x-8 space-y-4 md:space-y-0">
                <a href="https://www.instagram.com/majaacouture?igsh=bm9lemlhYzRvZDZz" target="_blank" class="group flex items-center justify-center md:justify-start gap-2 text-gray-500 hover:text-black transition-colors duration-300">
                    <span class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 group-hover:bg-purple-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </span>
                    <span>Instagram</span>
                </a>
                <a href="https://www.tiktok.com/@majaacouture?_t=ZN-8v7oiutFHaY&_r=1" target="_blank" class="group flex items-center justify-center md:justify-start gap-2 text-gray-500 hover:text-black transition-colors duration-300">
                    <span class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 group-hover:bg-purple-100 transition-colors duration-300">
                        <!-- Code SVG pour l'icône TikTok -->
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
                            <path d="M 9 4 C 6.2495759 4 4 6.2495759 4 9 L 4 41 C 4 43.750424 6.2495759 46 9 46 L 41 46 C 43.750424 46 46 43.750424 46 41 L 46 9 C 46 6.2495759 43.750424 4 41 4 L 9 4 z M 9 6 L 41 6 C 42.671576 6 44 7.3284241 44 9 L 44 41 C 44 42.671576 42.671576 44 41 44 L 9 44 C 7.3284241 44 6 42.671576 6 41 L 6 9 C 6 7.3284241 7.3284241 6 9 6 z M 26.042969 10 A 1.0001 1.0001 0 0 0 25.042969 10.998047 C 25.042969 10.998047 25.031984 15.873262 25.021484 20.759766 C 25.016184 23.203017 25.009799 25.64879 25.005859 27.490234 C 25.001922 29.331679 25 30.496833 25 30.59375 C 25 32.409009 23.351421 33.892578 21.472656 33.892578 C 19.608867 33.892578 18.121094 32.402853 18.121094 30.539062 C 18.121094 28.675273 19.608867 27.1875 21.472656 27.1875 C 21.535796 27.1875 21.663054 27.208245 21.880859 27.234375 A 1.0001 1.0001 0 0 0 23 26.240234 L 23 22.039062 A 1.0001 1.0001 0 0 0 22.0625 21.041016 C 21.906673 21.031216 21.710581 21.011719 21.472656 21.011719 C 16.223131 21.011719 11.945313 25.289537 11.945312 30.539062 C 11.945312 35.788589 16.223131 40.066406 21.472656 40.066406 C 26.72204 40.066409 31 35.788588 31 30.539062 L 31 21.490234 C 32.454611 22.653646 34.267517 23.390625 36.269531 23.390625 C 36.542588 23.390625 36.802305 23.374442 37.050781 23.351562 A 1.0001 1.0001 0 0 0 37.958984 22.355469 L 37.958984 17.685547 A 1.0001 1.0001 0 0 0 37.03125 16.6875 C 33.886609 16.461891 31.379838 14.012216 31.052734 10.896484 A 1.0001 1.0001 0 0 0 30.058594 10 L 26.042969 10 z M 27.041016 12 L 29.322266 12 C 30.049047 15.2987 32.626734 17.814404 35.958984 18.445312 L 35.958984 21.310547 C 33.820114 21.201935 31.941489 20.134948 30.835938 18.453125 A 1.0001 1.0001 0 0 0 29 19.003906 L 29 30.539062 C 29 34.707538 25.641273 38.066406 21.472656 38.066406 C 17.304181 38.066406 13.945312 34.707538 13.945312 30.539062 C 13.945312 26.538539 17.066083 23.363182 21 23.107422 L 21 25.283203 C 18.286416 25.535721 16.121094 27.762246 16.121094 30.539062 C 16.121094 33.483274 18.528445 35.892578 21.472656 35.892578 C 24.401892 35.892578 27 33.586491 27 30.59375 C 27 30.64267 27.001859 29.335571 27.005859 27.494141 C 27.009759 25.65271 27.016224 23.20692 27.021484 20.763672 C 27.030884 16.376775 27.039186 12.849206 27.041016 12 z"></path>
                        </svg>
                    </span>
                    <span>TikTok</span>
                </a>
                <a href="https://snapchat.com/t/4Opv17y5" target="_blank" class="group flex items-center justify-center md:justify-start gap-2 text-gray-500 hover:text-black transition-colors duration-300">
                    <span class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 group-hover:bg-purple-100 transition-colors duration-300">
                        <!-- Code SVG pour l'icône TikTok -->
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
                            <path d="M 24.5625 3.34375 C 23.578125 3.34375 21.488281 3.496094 19.21875 4.5 C 16.949219 5.503906 14.496094 7.417969 12.96875 10.84375 C 11.816406 13.425781 12.15625 17.183594 12.34375 20.1875 C 12.359375 20.410156 12.363281 20.601563 12.375 20.8125 C 12.28125 20.855469 12.363281 20.875 12.0625 20.875 C 11.609375 20.875 11.003906 20.726563 10.25 20.375 C 9.949219 20.234375 9.628906 20.1875 9.3125 20.1875 C 8.738281 20.1875 8.175781 20.359375 7.6875 20.65625 C 7.199219 20.953125 6.730469 21.414063 6.59375 22.125 C 6.511719 22.5625 6.605469 23.21875 7.03125 23.75 C 7.457031 24.28125 8.117188 24.714844 9.15625 25.125 C 9.382813 25.214844 9.613281 25.300781 9.84375 25.375 C 10.3125 25.523438 10.863281 25.683594 11.28125 25.90625 C 11.699219 26.128906 11.945313 26.390625 12.03125 26.59375 C 12.125 26.8125 12.152344 27.152344 11.84375 27.78125 C 11.832031 27.800781 11.820313 27.824219 11.8125 27.84375 C 11.808594 27.859375 11.792969 27.871094 11.78125 27.90625 C 11.65625 28.1875 8.917969 34.15625 3.21875 35.09375 C 2.484375 35.214844 1.960938 35.855469 2 36.59375 C 2.011719 36.808594 2.082031 37.039063 2.15625 37.21875 C 2.433594 37.871094 3.027344 38.351563 4 38.78125 C 4.898438 39.179688 6.296875 39.53125 8.15625 39.84375 C 8.203125 39.972656 8.265625 40.214844 8.34375 40.5625 C 8.34375 40.570313 8.339844 40.585938 8.34375 40.59375 C 8.414063 40.917969 8.480469 41.273438 8.59375 41.65625 C 8.707031 42.046875 8.996094 42.429688 9.34375 42.625 C 9.691406 42.820313 10.019531 42.84375 10.21875 42.84375 C 10.632813 42.84375 10.976563 42.757813 11.34375 42.6875 C 11.949219 42.570313 12.679688 42.4375 13.625 42.4375 C 14.148438 42.4375 14.695313 42.472656 15.25 42.5625 C 16.199219 42.71875 17.132813 43.335938 18.25 44.125 C 19.867188 45.269531 21.808594 46.65625 24.71875 46.65625 C 24.769531 46.65625 24.824219 46.628906 24.875 46.625 C 24.925781 46.628906 24.980469 46.625 25.03125 46.625 C 25.113281 46.628906 25.199219 46.65625 25.28125 46.65625 C 28.191406 46.65625 30.128906 45.269531 31.75 44.125 C 32.863281 43.335938 33.800781 42.71875 34.75 42.5625 C 35.304688 42.472656 35.851563 42.4375 36.375 42.4375 C 37.289063 42.4375 38.011719 42.554688 38.6875 42.6875 C 39.117188 42.773438 39.445313 42.8125 39.78125 42.8125 L 39.84375 42.8125 C 40.152344 42.8125 40.507813 42.726563 40.8125 42.5 C 41.117188 42.273438 41.320313 41.949219 41.40625 41.65625 C 41.519531 41.273438 41.582031 40.90625 41.65625 40.5625 C 41.738281 40.179688 41.800781 39.972656 41.84375 39.84375 C 43.703125 39.53125 45.101563 39.179688 46 38.78125 C 46.972656 38.351563 47.566406 37.867188 47.84375 37.21875 C 47.925781 37.03125 47.988281 36.808594 48 36.59375 C 48.039063 35.859375 47.511719 35.214844 46.78125 35.09375 C 43.90625 34.621094 41.796875 32.890625 40.375 31.21875 C 38.960938 29.554688 38.257813 27.964844 38.21875 27.875 C 38.21875 27.863281 38.21875 27.855469 38.21875 27.84375 C 38.210938 27.824219 38.199219 27.800781 38.1875 27.78125 C 37.875 27.152344 37.875 26.816406 37.96875 26.59375 C 38.054688 26.390625 38.300781 26.128906 38.71875 25.90625 C 39.136719 25.683594 39.683594 25.523438 40.15625 25.375 C 40.390625 25.300781 40.625 25.210938 40.84375 25.125 C 41.753906 24.765625 42.378906 24.390625 42.8125 23.9375 C 43.246094 23.484375 43.445313 22.921875 43.4375 22.4375 C 43.417969 21.414063 42.65625 20.734375 41.78125 20.40625 L 41.75 20.375 C 41.742188 20.371094 41.726563 20.378906 41.71875 20.375 C 41.359375 20.230469 40.980469 20.15625 40.59375 20.15625 C 40.332031 20.15625 39.96875 20.167969 39.53125 20.375 C 38.851563 20.695313 38.28125 20.851563 37.84375 20.875 C 37.816406 20.875 37.839844 20.875 37.8125 20.875 C 37.785156 20.875 37.804688 20.878906 37.78125 20.875 C 37.652344 20.859375 37.691406 20.835938 37.625 20.8125 C 37.636719 20.640625 37.644531 20.488281 37.65625 20.3125 L 37.65625 20.1875 C 37.847656 17.183594 38.183594 13.429688 37.03125 10.84375 C 35.503906 7.417969 33.054688 5.472656 30.78125 4.46875 C 28.507813 3.464844 26.425781 3.34375 25.4375 3.34375 L 25.34375 3.34375 C 25.332031 3.34375 25.324219 3.34375 25.3125 3.34375 Z M 24.5625 5.34375 L 25.4375 5.34375 C 26.238281 5.34375 28.054688 5.46875 29.96875 6.3125 C 31.882813 7.15625 33.898438 8.691406 35.21875 11.65625 C 35.96875 13.335938 35.847656 17.0625 35.65625 20.0625 L 35.65625 20.1875 C 35.628906 20.605469 35.582031 21.011719 35.5625 21.40625 C 35.554688 21.6875 35.667969 21.960938 35.875 22.15625 C 36.03125 22.316406 36.6875 22.832031 37.78125 22.875 C 37.792969 22.875 37.800781 22.875 37.8125 22.875 C 37.824219 22.875 37.832031 22.875 37.84375 22.875 C 38.652344 22.84375 39.5 22.597656 40.375 22.1875 C 40.398438 22.175781 40.507813 22.15625 40.59375 22.15625 C 40.71875 22.15625 40.882813 22.1875 40.96875 22.21875 C 40.976563 22.222656 40.992188 22.214844 41 22.21875 C 41.019531 22.230469 41.042969 22.242188 41.0625 22.25 C 41.296875 22.332031 41.40625 22.425781 41.4375 22.46875 C 41.445313 22.476563 41.433594 22.496094 41.4375 22.5 C 41.425781 22.519531 41.414063 22.519531 41.375 22.5625 C 41.230469 22.714844 40.832031 22.988281 40.09375 23.28125 C 39.972656 23.328125 39.789063 23.398438 39.5625 23.46875 C 39.089844 23.617188 38.417969 23.820313 37.78125 24.15625 C 37.144531 24.492188 36.472656 24.988281 36.125 25.8125 C 35.753906 26.683594 35.910156 27.640625 36.34375 28.5625 C 36.347656 28.578125 36.339844 28.582031 36.34375 28.59375 C 36.359375 28.636719 36.375 28.660156 36.375 28.65625 C 36.464844 28.863281 37.222656 30.628906 38.84375 32.53125 C 40.300781 34.242188 42.515625 36.011719 45.46875 36.78125 C 45.34375 36.863281 45.429688 36.859375 45.1875 36.96875 C 44.46875 37.285156 43.234375 37.625 41.21875 37.9375 C 40.648438 38.023438 40.222656 38.5625 40.0625 38.9375 C 39.902344 39.3125 39.820313 39.683594 39.71875 40.15625 C 39.671875 40.375 39.613281 40.574219 39.5625 40.78125 C 39.425781 40.769531 39.3125 40.769531 39.0625 40.71875 C 38.335938 40.578125 37.457031 40.4375 36.375 40.4375 C 35.734375 40.4375 35.09375 40.484375 34.4375 40.59375 C 32.902344 40.851563 31.707031 41.710938 30.59375 42.5 C 28.96875 43.644531 27.585938 44.65625 25.28125 44.65625 C 25.1875 44.65625 25.09375 44.660156 25 44.65625 C 24.957031 44.652344 24.917969 44.652344 24.875 44.65625 C 24.835938 44.660156 24.765625 44.65625 24.71875 44.65625 C 22.414063 44.65625 21.023438 43.644531 19.40625 42.5 C 18.289063 41.710938 17.097656 40.847656 15.5625 40.59375 C 14.90625 40.484375 14.265625 40.4375 13.625 40.4375 C 12.472656 40.4375 11.542969 40.601563 10.9375 40.71875 C 10.695313 40.765625 10.605469 40.792969 10.46875 40.8125 C 10.414063 40.59375 10.332031 40.386719 10.28125 40.15625 C 10.1875 39.726563 10.125 39.347656 9.96875 38.96875 C 9.890625 38.78125 9.78125 38.574219 9.59375 38.375 C 9.40625 38.175781 9.128906 38.015625 8.8125 37.96875 C 6.800781 37.65625 5.53125 37.285156 4.8125 36.96875 C 4.5625 36.859375 4.65625 36.867188 4.53125 36.78125 C 10.761719 35.171875 13.472656 29.007813 13.625 28.65625 C 13.636719 28.632813 13.644531 28.617188 13.65625 28.59375 C 13.660156 28.582031 13.652344 28.578125 13.65625 28.5625 C 14.089844 27.640625 14.246094 26.683594 13.875 25.8125 C 13.523438 24.988281 12.855469 24.492188 12.21875 24.15625 C 11.582031 23.820313 10.941406 23.617188 10.46875 23.46875 C 10.238281 23.394531 10.023438 23.328125 9.90625 23.28125 C 9.066406 22.949219 8.699219 22.632813 8.59375 22.5 C 8.59375 22.519531 8.570313 22.433594 8.71875 22.34375 C 8.882813 22.246094 9.171875 22.1875 9.3125 22.1875 C 9.390625 22.1875 9.386719 22.191406 9.375 22.1875 C 10.3125 22.625 11.203125 22.875 12.0625 22.875 C 13.25 22.875 13.960938 22.359375 14.15625 22.15625 C 14.351563 21.957031 14.453125 21.683594 14.4375 21.40625 C 14.414063 20.96875 14.371094 20.523438 14.34375 20.0625 C 14.15625 17.058594 14.03125 13.335938 14.78125 11.65625 C 16.101563 8.695313 18.089844 7.15625 20 6.3125 C 21.910156 5.46875 23.761719 5.34375 24.5625 5.34375 Z"></path>
                            </svg>
                    </span>
                    <span>Snapchat</span>
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
    <script>
        // Ajoutez ce script à la fin avant </body>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation au défilement
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px'
            };
        
            const animateOnScroll = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                        observer.unobserve(entry.target);
                    }
                });
            };
        
            const observer = new IntersectionObserver(animateOnScroll, observerOptions);
        
            // Éléments à animer
            const scrollAnimations = document.querySelectorAll('.scroll-animate');
            scrollAnimations.forEach(el => observer.observe(el));
        
            // Animation spécifique pour la grille
            const gridItems = document.querySelectorAll('.grid-animate');
            gridItems.forEach((el, index) => {
                el.style.transitionDelay = `${index * 0.1}s`;
                el.classList.add('opacity-0', 'translate-y-6');
            });
        
            const gridObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                    }
                });
            }, { threshold: 0.1 });
        
            gridItems.forEach(el => gridObserver.observe(el));
        });
        </script>
        
        
</body>
</html>