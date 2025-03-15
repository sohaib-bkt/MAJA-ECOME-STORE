<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
  <title>Shoop</title>
</head>
<body>
  <x-nav></x-nav>
  <section class="section all-products" id="products">
    <div class="top container">
      <form id="filterForm">
        <select id="categorySelect">
          <option value="all">Default Category</option>
          <option value="jew">Jewelery</option>
          <option value="border">Border</option>
        </select>
        <span><i class="bx bx-chevron-down"></i></span>
        <select id="dateSelect">
          <option value="all">Default Date</option>
          <option value="newest">Newest</option>
          <option value="oldest">Oldest</option>
        </select>
        <span><i class="bx bx-chevron-down"></i></span>
      </form>
    </div>
    <div class="product-center container" id="productContainer">
        @include('partials.products', ['products' => $products])
    </div>
    <div id="paginationContainer">
        @include('partials.pagination', ['products' => $products])
    </div>
  </section>
  <x-footer></x-footer>
  <script src="{{ asset('js/index.js') }}"></script>
  <script>
   document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('categorySelect');
    const dateSelect = document.getElementById('dateSelect');
    const productContainer = document.getElementById('productContainer');
    const paginationContainer = document.getElementById('paginationContainer');

    function fetchFilteredProducts(url = null) {
        const category = categorySelect.value;
        const date = dateSelect.value;

        const fetchUrl = url ? url : `/shop?category=${category}&date=${date}`;

        fetch(fetchUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest' 
            }
        })
        .then(response => response.json())
        .then(data => {
            productContainer.innerHTML = data.products;
            paginationContainer.innerHTML = data.pagination;

            document.querySelectorAll('#paginationContainer a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    fetchFilteredProducts(link.href);
                });
            });
        })
        .catch(error => console.error('Error:', error));
    }

    categorySelect.addEventListener('change', () => fetchFilteredProducts());
    dateSelect.addEventListener('change', () => fetchFilteredProducts());

    document.querySelectorAll('#paginationContainer a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            fetchFilteredProducts(link.href);
        });
    });
});


  </script>
</body>
</html>
