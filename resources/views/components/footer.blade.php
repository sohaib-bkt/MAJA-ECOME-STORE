<footer class="footer">
    <div class="row">
      <div class="col d-flex">
        <h4>INFORMATION</h4>
        <a href="{{ route('about')}}">About us</a>
        @php
        $message = "Hello! Take a screen shot of the product and send it to me";
        $encodedMessage = urlencode($message);
        @endphp
        <a href="https://wa.me/+21239565569?text={{ $encodedMessage }}">Contact Us</a>
        <a href="">Term & Conditions</a>
      </div>
      <div class="col d-flex">
        <h4>USEFUL LINK</h4>
        <a href="{{ route('shop')}}">Online Store</a>
        <a href="">Customer Services</a>
        <a href="{{ route('shop')}}">Promotion</a>
        <a href="{{ route('shop')}}">Top Brands</a>
      </div>
      <div class="col d-flex">
        <span><i class="bx bxl-facebook-square"></i></span>
        <span><i class="bx bxl-instagram-alt"></i></span>
      </div>
    </div>
  </footer>