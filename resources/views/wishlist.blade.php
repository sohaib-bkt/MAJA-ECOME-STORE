<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Box icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
    />
    <!-- Custom StyleSheet -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <title>Your Wishlist</title>
  </head>
  <body>
    <!-- Navigation -->

    <x-nav></x-nav>

    <!-- Wishlist Items -->
    <div class="container cart">
      <table>
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th></th>
        </tr>

        @foreach ($prods as $product)
        <tr>
          <td>
            <div class="wishlist-info">
              <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="rounded-lg" />
              <div>
                <p>{{ $product->name }}</p>
              </div>
            </div>
          </td>
          <td>${{ number_format($product->price, 2) }}</td>
          <td>
            <form action="{{ route('wishlist.remove', $product->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-500 hover:text-red-700 text-5xl">
                <i class="bx bx-x"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach

      </table>
    </div>

    <!-- Latest Products -->
    <section class="section featured">
      <div class="top container">
        <h1>Latest Products</h1>
        <a href="{{ route('shop') }}" class="view-more">View more</a>
      </div>
      <div class="product-center container">
        @foreach ($products as $product)
            <x-product :product="$product"></x-product>
        @endforeach
      </div>
    </section>

    <!-- Footer -->
    <x-footer></x-footer>

    <!-- Custom Script -->
    <script src="{{ asset('js/index.js') }}"></script>
  </body>
</html>
