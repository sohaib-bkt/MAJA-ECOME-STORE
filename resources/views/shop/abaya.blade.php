<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
      <div class="product-center container" id="productContainer">
        
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
    
    let loading = false;
    const loadingDiv = document.getElementById('loading');
    const productContainer = document.getElementById('productContainer');
    const noProductsMessage = document.getElementById('noProductsMessage');

    
    let currentFilters = {
        size: '',
        color: '',
        sort: 'newest',
        page: 1
    };

    let totalPages = 1;

    // Get initial page from URL
    const urlParams = new URLSearchParams(window.location.search);
    currentFilters.page = parseInt(urlParams.get('page')) || 1;

    const filterButton = document.getElementById('filterButton');
    const filterDropdown = document.getElementById('filterDropdown');
    const filterContainer = document.getElementById('filterContainer');

    // Initial load
    fetchProducts(true);

    // Toggle dropdown on button click
    filterButton.addEventListener('click', (e) => {
        e.stopPropagation();
        filterDropdown.classList.toggle('active');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!filterContainer.contains(e.target)) {
            filterDropdown.classList.remove('active');
        }
    });

    // Event listeners for filters
    document.getElementById('sizeFilter')?.addEventListener('change', (e) => {
        currentFilters.size = e.target.value;
        resetPagination();
    });

    document.getElementById('colorFilter')?.addEventListener('change', (e) => {
        currentFilters.color = e.target.value;
        resetPagination();
    });

    document.getElementById('sortBy')?.addEventListener('change', (e) => {
        currentFilters.sort = e.target.value;
        resetPagination();
    });

    function resetPagination() {
        currentFilters.page = 1;
        fetchProducts(true);
    }

    // Function to update no products message
    function updateNoProductsMessage(hasProducts) {
        console.log(noProductsMessage);
        
        if (!noProductsMessage) return;
        
        if (hasProducts) {
            console.log('here');
            noProductsMessage.classList.add('hidden');
            productContainer.classList.remove('hidden');
        } else {
            console.log('here2');
            noProductsMessage.classList.remove('hidden');
            productContainer.classList.add('hidden');
        }
    }

    async function fetchProducts(resetPagination = true) {
        if (loading) return;
        loading = true;
        loadingDiv.classList.remove('hidden');

        // Clean empty filters
        const cleanParams = new URLSearchParams();
        Object.entries(currentFilters).forEach(([key, value]) => {
            if (value && value !== '') {
                cleanParams.append(key, value);
            }
        });

        try {
            const url = `{{ url()->current() }}?${cleanParams.toString()}`;
            const response = await fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            
            if (!response.ok) throw new Error('Network error');
            
            const data = await response.json();
            
            if (resetPagination) {
                productContainer.innerHTML = data.html;
            } else {
                productContainer.insertAdjacentHTML('beforeend', data.html);
            }
            
            // Update pagination info
            currentFilters.page = data.current_page;
            totalPages = data.last_page;
            
            // Check if there are products (trim to handle potential whitespace)
            updateNoProductsMessage(data.html.trim() != '');
            
            // Update URL without reload
            history.replaceState(null, '', url);
            
            updateActiveFilters();
        } catch (error) {
            console.error('Error:', error);
            // Ensure loading state is reset even if there's an error
            updateNoProductsMessage(false);
        } finally {
            loading = false;
            loadingDiv.classList.add('hidden');
        }
    }

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
                    <button onclick="removeFilter('${key}')" class="ml-1 text-gray-500 hover:text-gray-700">
                        &times;
                    </button>
                `;
                activeFilters.appendChild(badge);
            }
        });
    }

    window.removeFilter = function(filterType) {
        currentFilters[filterType] = '';
        const filterElement = document.getElementById(`${filterType}Filter`);
        if (filterElement) filterElement.value = '';
        resetPagination();
    };

    async function loadMoreProducts() {
        if (currentFilters.page >= totalPages || loading) return;
        currentFilters.page++;
        await fetchProducts(false);
    }
    
    function scrollHandler() {
        const { scrollTop, scrollHeight, clientHeight } = document.documentElement;
        if (scrollTop + clientHeight >= scrollHeight - 300 && !loading) {
            loadMoreProducts();
        }
    }

    // Add global function to clear all filters
    window.clearAllFilters = function() {
        // Reset filter dropdowns
        document.getElementById('sizeFilter').value = '';
        document.getElementById('colorFilter').value = '';
        document.getElementById('sortBy').value = 'newest';

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

    window.addEventListener('scroll', scrollHandler);

    window.addEventListener('popstate', () => {  
    const currentUrl = window.location.href;  
    fetchProductsFromUrl(currentUrl);  
    console.log('popstate event triggered');  
});  
});
    </script>
</body>
</html>
