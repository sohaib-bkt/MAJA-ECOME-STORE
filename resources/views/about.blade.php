<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- Glide js -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.theme.css"
    />
    <title>About</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/about.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css')}}" />
  </head>
  <body>
    <x-nav></x-nav>
    <section class="about-us">
      <div class="about">
        <img src="{{ asset('images/logo.png')}}" class="pic" />
        <div class="text">
            <h2>About Us</h2>
            <h5><span style="font-size: 20px">Gift</span> Store</h5>
            <p style="font-size: 13px">Welcome to our premier gift store, where we offer a curated selection of high-quality gifts for every occasion. Our commitment to excellence ensures that every item we provide meets the highest standards of craftsmanship and quality. We pride ourselves on delivering not only beautiful gifts but also exceptional service and security, making your shopping experience both enjoyable and reliable.</p>
            <div class="data" >
                @php
                $message = "Hello! Take a screen shot of the product and send it to me";
                $encodedMessage = urlencode($message);
                @endphp
              <a href="https://wa.me/+21239565569?text={{ $encodedMessage }}" class="hire" style="font-size: 16px"><i class="bx bxl-whatsapp" style="font-size: 20px"></i> Contact Us</a>
            </div>            
        </div>
      </div>
    </section>

    <x-footer></x-footer>

    <!-- Glide JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/glide.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const glide = new Glide('.glide').mount();
      });
    </script>
    <script src="{{ asset('js/index.js') }}"></script>

  </body>
</html>
