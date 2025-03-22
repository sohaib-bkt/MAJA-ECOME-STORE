<div class="navigation " >
    <div class="nav-center container d-flex ">
    <a href="/" class="logo "><img src="{{ asset('images/logo1.png')}}" style="height: auto" alt="" class="w-[100px] md:w-[120px]" /></a>

      <ul class="nav-list d-flex">
        <li class="nav-item">
          <a href="/" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('shop') }}" class="nav-link">ABAYAS</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('shop') }}" class="nav-link">KIMONOS</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('shop') }}" class="nav-link">HIJAB</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('shop') }}" class="nav-link">ACCESSOIRES</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('about') }}" class="nav-link">NOTRE HISTOIRE</a>
        </li>
        <li class="nav-item">
          @php
          $message = "Hello! Take a screen shot of the product and send it to me";
          $encodedMessage = urlencode($message);
          @endphp

          <a href="https://wa.me/+21239565569?text={{ $encodedMessage }}" class="nav-link">CONTACT</a>
        </li>
        <li class="icons d-flex">
          @if (Auth::check())
          <form action="{{ route('logout') }}" method="POST" style="display:inline;">
          @csrf
                 <button type="submit"  class="text-white hover:text-green-900 bg-green-400 hover:bg-green-500 ease-in-out" style="display: flex;justify-content: center;align-items: center ;height: 40px;width: 100px;
                border-radius: 10px ">
                      Logout
                  </button>
              </form>
          @else
              <a href="{{ route('login') }}" class="icon">
                  <i class="bx bx-user"></i>
              </a>
          @endif
      
{{--         
        <a href="{{ route('wishlist') }}" class="icon">
          <i class="bx bx-heart"></i>
          <span class="d-flex">{{ $wishlistCount }}</span>
        </a> --}}

      </li>
      </ul>

      <div class="icons d-flex">
        @if (Auth::check())
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="text-white hover:text-green-900 bg-green-400 hover:bg-green-500 ease-in-out" style="display: flex;justify-content: center;align-items: center ;height: 40px;width: 100px;
            border-radius: 10px ">
                Logout
            </button>
        </form>
        @else
            <a href="{{ route('login') }}" class="icon">
                <i class="bx bx-user"></i>
            </a>
        @endif
        {{-- <a href="{{ route('wishlist') }}" class="icon">
          <i class="bx bx-heart"></i>
          <span class="d-flex" id="wishlist-count">{{ $wishlistCount }}</span>
        </a> --}}

      </div>

      <div class="hamburger">
        <i class="bx bx-menu-alt-left"></i>
      </div>
    </div>
  </div>