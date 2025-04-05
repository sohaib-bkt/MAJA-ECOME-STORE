<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
  <style>
    .filter-dropdown {
      display: none;
    }
    .filter-dropdown.active {
      display: block;
    }
    

  </style>
  <title>Maja Store</title>
</head>
<body>
    <x-nav></x-nav>
    <section class="section all-products" id="products">
      <!-- Filter Controls -->
      <div class="container mb-8">
        <div class="flex flex-wrap gap-4 items-center mb-4"> 
            <!-- Filter Button -->  
            <div class="relative" id="filterContainer">  
                <button id="filterButton" class="bg-[#ba9c76] text-white px-4 py-2 rounded hover:bg-[#a78b6a] flex items-center text-[16px]">  
                    <i class="fas fa-filter mr-2"></i> Filters  
                </button>  
                
                <!-- Dropdown Content -->  
                <div id="filterDropdown" class="filter-dropdown absolute bg-white shadow-lg rounded p-4 mt-2 min-w-[200px] z-10">  
                    <div class="space-y-4">  
                        <!-- Size Filter -->  
                        {{-- <div>  
                            <label class="block text-[16px] font-medium text-gray-700 mb-2">Size</label> <!-- Increased font size -->  
                            <select id="sizeFilter" class="w-full border rounded p-2 text-[16px]">   
                                <option value="">All Sizes</option>  
                                <option>S/M</option>  
                                <option>M/L</option>     
                            </select>  
                        </div>   --}}
                        
                        <!-- Color Filter -->  
                        <div>  
                            <label class="block text-[16px] font-medium text-gray-700 mb-2">Color</label> <!-- Increased font size -->  
                            <select id="colorFilter" class="w-full border rounded p-2 text-[16px]"> <!-- Increased font size -->  
                                <option value="">All Colors</option>  
 
                                <option>Marron</option>  
                                <option>Biege</option>  
                                <option>Taupe</option>  
                            </select>  
                        </div>  
                    </div>  
                </div>  
            </div>  
        
            <!-- Sort Dropdown -->  
            <div class="relative">  
                <select id="sortBy" class="bg-white border rounded p-2 text-[16px]"> <!-- Increased font size -->  
                    <option value="newest">Newest First</option>  
                    <option value="price_asc">Price: Low to High</option>  
                    <option value="price_desc">Price: High to Low</option>  
                </select>  
            </div>  
        
            <!-- Active Filters Badge -->  
            <div id="activeFilters" class="flex gap-2 items-center"></div>  
        </div>  
      </div>
      <div id="noProductsMessage" class="hidden container text-center py-12  rounded-lg">
            <div class="max-w-md mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-[#ba9c76] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h.01M15 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Aucun produit trouvé</h2>
                <p class="text-gray-600 mb-6">Nous n'avons trouvé aucun produit correspondant à vos filtres actuels.</p>
                <button onclick="clearAllFilters()" class="bg-[#ba9c76] text-white px-6 py-3 rounded-lg hover:bg-[#a78b6a] transition duration-300">
                    Effacer les filtres
                </button>
            </div>
        </div>
      <div class="product-center container" id="productContainer" style="padding: 0 !important;">
        
        @include('partials.products', ['products' => $products])
      </div>
      
        
        <!-- Loading Indicator -->
        <div id="loading" class="hidden text-center py-4">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-gray-300 border-t-[#ba9c76] mr-2"></div>
            <p class="text-gray-600 mt-2">Loading more products...</p>
        </div>
        
        <!-- Hidden element to store next page URL -->
        <div id="nextPageUrl" data-url="{{ $products->nextPageUrl() }}"></div>
    </section>
  <x-footer></x-footer>
  <script src="{{ asset('js/index.js') }}"></script>

 <script>
 document.addEventListener('DOMContentLoaded', function() {
    // Variables for controlling UI state
    let loading = false;
    const loadingDiv = document.getElementById('loading');
    const productContainer = document.getElementById('productContainer');
    const noProductsMessage = document.getElementById('noProductsMessage');
    
    // Set a flag to prevent reload loops
    let isInitialLoad = true;
    
    // Filter and pagination state
    let currentFilters = {
        size: '',
        color: '',
        sort: 'newest',
        page: 1
    };
    
    let totalPages = 1;
    
    // Initialize UI
    const filterButton = document.getElementById('filterButton');
    const filterDropdown = document.getElementById('filterDropdown');
    const filterContainer = document.getElementById('filterContainer');
    
    // Get initial parameters from URL
    parseCurrentUrlParams();
    
    // Set up event listeners
    setupEventListeners();
    
    // Initial load of products
    fetchProducts(true);
    
    // After initial setup, mark initialization as complete
    setTimeout(() => {
        isInitialLoad = false;
    }, 500);
    
    /**
     * Parse URL parameters and update filter controls
     */
    function parseCurrentUrlParams() {
        const urlParams = new URLSearchParams(window.location.search);
        currentFilters = {
            size: urlParams.get('size') || '',
            color: urlParams.get('color') || '',
            sort: urlParams.get('sort') || 'newest',
            page: parseInt(urlParams.get('page')) || 1
        };
        
        // Update UI controls to match URL parameters
        if (document.getElementById('colorFilter')) {
            document.getElementById('colorFilter').value = currentFilters.color;
        }
        
        if (document.getElementById('sortBy')) {
            document.getElementById('sortBy').value = currentFilters.sort;
        }
    }
    
    /**
     * Set up all event listeners
     */
    function setupEventListeners() {
        // Filter dropdown toggle
        if (filterButton) {
            filterButton.addEventListener('click', (e) => {
                e.stopPropagation();
                filterDropdown.classList.toggle('active');
            });
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (filterContainer && !filterContainer.contains(e.target)) {
                filterDropdown.classList.remove('active');
            }
        });
        
        // Filter change events
        if (document.getElementById('colorFilter')) {
            document.getElementById('colorFilter').addEventListener('change', (e) => {
                currentFilters.color = e.target.value;
                resetPagination();
            });
        }
        
        if (document.getElementById('sortBy')) {
            document.getElementById('sortBy').addEventListener('change', (e) => {
                currentFilters.sort = e.target.value;
                resetPagination();
            });
        }
        
        // Handle infinite scroll
        window.addEventListener('scroll', scrollHandler);
        
        // Handle browser navigation - only reload when it's a genuine back/forward navigation
        window.addEventListener('popstate', function(event) {
            // Only reload if this isn't during the initial page load
            if (!isInitialLoad) {
                // Prevent multiple reloads by using location.replace instead of reload
                window.location.replace(window.location.href);
            }
        });
    }
    
    /**
     * Reset pagination and fetch products
     */
    function resetPagination() {
        currentFilters.page = 1;
        fetchProducts(true);
    }
    
    /**
     * Fetch products with current filters
     */
    async function fetchProducts(resetPagination = true) {
        if (loading) return;
        loading = true;
        
        if (loadingDiv) {
            loadingDiv.classList.remove('hidden');
        }
        
        // Build clean URL parameters
        const cleanParams = new URLSearchParams();
        Object.entries(currentFilters).forEach(([key, value]) => {
            if (value && value !== '') {
                cleanParams.append(key, value);
            }
        });
        
        try {
            const baseUrl = window.location.pathname;
            const url = `${baseUrl}?${cleanParams.toString()}`;
            
            // Add cache busting parameter to avoid cached responses
            const cacheBuster = new Date().getTime();
            const fetchUrl = `${url}&_=${cacheBuster}`;
            
            const response = await fetch(fetchUrl, {
                headers: { 
                    'X-Requested-With': 'XMLHttpRequest',
                    'Cache-Control': 'no-cache, no-store, must-revalidate',
                    'Pragma': 'no-cache'
                },
                cache: 'no-cache'
            });
            
            if (!response.ok) {
                throw new Error('Network error');
            }
            
            const data = await response.json();
            
            // Handle the response data
            if (data && typeof data === 'object') {
                // Check if we got HTML content
                if (data.html !== undefined) {
                    if (resetPagination) {
                        productContainer.innerHTML = data.html;
                    } else {
                        productContainer.insertAdjacentHTML('beforeend', data.html);
                    }
                    
                    // Update pagination info
                    if (data.current_page) currentFilters.page = data.current_page;
                    if (data.last_page) totalPages = data.last_page;
                    
                    // Check if there are products
                    updateNoProductsMessage(data.html.trim() !== '');
                    
                    // Update URL without reload - don't push state during popstate handling
                    if (!isInitialLoad) {
                        history.pushState({ filters: currentFilters }, '', url);
                    }
                    
                    // Update filter badges
                    updateActiveFilters();
                } else {
                    console.error('Response missing HTML content', data);
                }
            } else {
                console.error('Invalid response format', data);
            }
        } catch (error) {
            console.error('Error fetching products:', error);
            // On error, show no products message
            updateNoProductsMessage(false);
        } finally {
            loading = false;
            if (loadingDiv) {
                loadingDiv.classList.add('hidden');
            }
        }
    }
    
    /**
     * Update the no products message visibility
     */
    function updateNoProductsMessage(hasProducts) {
        if (!noProductsMessage || !productContainer) return;
        
        if (hasProducts) {
            noProductsMessage.classList.add('hidden');
            productContainer.classList.remove('hidden');
        } else {
            noProductsMessage.classList.remove('hidden');
            productContainer.classList.add('hidden');
        }
    }
    
    /**
     * Update the active filters display
     */
    function updateActiveFilters() {
        const activeFilters = document.getElementById('activeFilters');
        if (!activeFilters) return;
        
        activeFilters.innerHTML = '';
        
        Object.entries(currentFilters).forEach(([key, value]) => {
            if (value && !['sort', 'page'].includes(key)) {
                const badge = document.createElement('div');
                badge.className = 'bg-gray-100 px-2 py-1 rounded text-sm flex items-center';
                badge.innerHTML = `
                    ${value}
                    <button class="ml-1 text-gray-500 hover:text-gray-700" data-filter="${key}">
                        &times;
                    </button>
                `;
                
                // Add event listener to remove button
                const removeButton = badge.querySelector('button');
                removeButton.addEventListener('click', function() {
                    removeFilter(key);
                });
                
                activeFilters.appendChild(badge);
            }
        });
    }
    
    /**
     * Remove a filter and update products
     */
    function removeFilter(filterType) {
        currentFilters[filterType] = '';
        const filterElement = document.getElementById(`${filterType}Filter`);
        if (filterElement) filterElement.value = '';
        resetPagination();
    }
    
    /**
     * Global function to remove a filter
     */
    window.removeFilter = removeFilter;
    
    /**
     * Load more products when scrolling
     */
    async function loadMoreProducts() {
        if (currentFilters.page >= totalPages || loading) return;
        currentFilters.page++;
        await fetchProducts(false);
    }
    
    /**
     * Handle scroll events for infinite loading
     */
    function scrollHandler() {
        const { scrollTop, scrollHeight, clientHeight } = document.documentElement;
        if (scrollTop + clientHeight >= scrollHeight - 300 && !loading) {
            loadMoreProducts();
        }
    }
    
    /**
     * Clear all filters and reset
     */
    window.clearAllFilters = function() {
        // Reset all filter controls
        if (document.getElementById('sizeFilter')) {
            document.getElementById('sizeFilter').value = '';
        }
        
        if (document.getElementById('colorFilter')) {
            document.getElementById('colorFilter').value = '';
        }
        
        if (document.getElementById('sortBy')) {
            document.getElementById('sortBy').value = 'newest';
        }
        
        // Reset current filters
        currentFilters = {
            size: '',
            color: '',
            sort: 'newest',
            page: 1
        };
        
        // Fetch products with reset filters
        resetPagination();
    };
});

    </script>
</body>
</html>
