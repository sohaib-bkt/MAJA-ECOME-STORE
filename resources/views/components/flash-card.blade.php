@props(['flashData'])

<div class="flash-card bg-gradient-to-br from-[#fff8f0] to-[#fef4e8] border-2 border-[#9c6d2f]/20 shadow-xl backdrop-blur-sm px-4 md:px-6 py-4 md:py-5 rounded-2xl relative mb-4 transition-all duration-300 transform hover:shadow-2xl hover:-translate-y-1 group max-w-[95vw] mx-auto">
    <!-- Decorative pulse effect -->
    <div class="absolute top-0 left-0 w-full h-full rounded-2xl border-2 border-[#9c6d2f]/10 pointer-events-none"></div>
    
    <!-- Header with animated icon -->
    <div class="flex items-center gap-2 md:gap-3 mb-3 md:mb-4 pr-8"> <!-- Added pr-8 for spacing -->
        <div class="relative">
            <div class="animate-ping absolute w-6 h-6 md:w-8 md:h-8 bg-[#9c6d2f]/20 rounded-full"></div>
            <div class="w-6 h-6 md:w-8 md:h-8 bg-[#9c6d2f] rounded-full flex items-center justify-center text-white text-sm md:text-base">
                ✓
            </div>
        </div>
        <h3 class="font-bold text-xl md:text-2xl text-[#2a2a2a] leading-tight">Payment Successful!</h3>
    </div>

    <!-- Email confirmation with icon -->
    <div class="flex items-center gap-2 p-2 md:p-3 bg-white/50 rounded-lg text-xs md:text-sm">
        <i class='bx bx-envelope text-[#9c6d2f] text-base md:text-lg'></i>
        <p>Confirmation sent to <span class="font-semibold break-all">{{ $flashData['email'] ?? 'N/A' }}</span></p>
    </div>

    <!-- Modern close button with increased spacing -->
    <button onclick="this.parentElement.remove()" 
            class="absolute top-3 right-4 md:top-4 md:right-5 p-1 md:p-1.5 rounded-full hover:bg-[#9c6d2f]/10 transition-colors duration-200"
            aria-label="Close notification">
        <svg class="w-4 h-4 md:w-5 md:h-5 text-[#9c6d2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    <!-- Progress bar animation -->
    <div class="absolute bottom-0 left-0 h-0.5 md:h-1 bg-[#9c6d2f]/10 w-full overflow-hidden rounded-b-2xl">
        <div class="h-full bg-[#9c6d2f] animate-progress"></div>
    </div>
</div>

<style>
    @keyframes progress {
        from { transform: translateX(-100%); }
        to { transform: translateX(0); }
    }
    .animate-progress {
        animation: progress 5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }
    
    @media (max-width: 640px) {
        .flash-card {
            backdrop-filter: blur(4px);
        }
    }
</style>