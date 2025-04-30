
<div class="navigation " >
    <div class="nav-center container d-flex ">
    <a href="/" class="logo "><img src="{{ asset('images/logo1.png')}}" style="height: auto" alt="" class="w-[100px] md:w-[120px]" /></a>

      <ul class="nav-list d-flex">
        <li class="nav-item">
          <a href="{{ route('collections.abayas') }}" class="nav-link relative  hover:text-[#C9B194] transition-colors font-med after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] 
                          after:bg-[#C9B194] after:transition-all hover:after:w-full">ABAYAS</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('collections.kimonos') }}" class="nav-link  relative  hover:text-[#C9B194] transition-colors font-med after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] 
                          after:bg-[#C9B194] after:transition-all hover:after:w-full">KIMONOS</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('collections.hijabs') }}" class="nav-link  relative  hover:text-[#C9B194] transition-colors font-med after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] 
                          after:bg-[#C9B194] after:transition-all hover:after:w-full">HIJAB</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('collections.accessoires') }}" class="nav-link  relative  hover:text-[#C9B194] transition-colors font-med after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] 
                          after:bg-[#C9B194] after:transition-all hover:after:w-full">ACCESSOIRES</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('backstage') }}" class="nav-link  relative  hover:text-[#C9B194] transition-colors font-med after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] 
                          after:bg-[#C9B194] after:transition-all hover:after:w-full">BACKSTAGE</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('about') }}" class="nav-link  relative  hover:text-[#C9B194] transition-colors font-med after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] 
                          after:bg-[#C9B194] after:transition-all hover:after:w-full">NOTRE HISTOIRE</a>
        </li>
        
        <li class="icons d-flex">
          @if (Auth::check())
          <form action="{{ route('logout') }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit" class="p-2  rounded-lg transition-all duration-300 hover:scale-110 text-[#555555]" style="font-size: 22px ;">
              <i class="bx bx-log-out "></i>
          </button>
              </form>
          @else
              <a href="{{ route('login') }}" class="icon transition-all duration-300 hover:scale-110">
                  <i class="bx bx-user"></i>
              </a>
          @endif
      
        
        <a href="{{ route('wishlist') }}" class="icon transition-all duration-300 hover:scale-110">
          <i class="bx bx-heart"></i>
          <span class="d-flex absolute -top-1 -right-2 bg-[#C9B194] text-white text-xs w-5 h-5 rounded-full flex items-center justify-center transition-all group-hover:scale-125 group-hover:bg-[#B89E80]">{{ $wishlistCount }}</span>
        </a>

        <a href="{{ route('panier') }}" class="icon transition-all duration-300 hover:scale-110">
          <i class="bx bx-cart"></i>
          <span class="d-flex absolute -top-1 -right-2 bg-[#C9B194] text-white text-xs w-5 h-5 rounded-full flex items-center justify-center transition-all group-hover:scale-125 group-hover:bg-[#B89E80]">{{ $cartCount }}</span>
        </a>

      </li>
      </ul>

      <div class="icons d-flex iconss">
        @if (Auth::check())
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="p-2  rounded-lg transition-all duration-300 hover:scale-110 text-[#555555]" style="font-size: 22px ;">
              <i class="bx bx-log-out "></i>
          </button>
        </form>
        @else
            <a href="{{ route('login') }}" class="icon transition-all duration-300 hover:scale-110">
                <i class="bx bx-user"></i>
            </a>
        @endif
        <a href="{{ route('wishlist') }}" class="icon transition-all duration-300 hover:scale-110">
          <i class="bx bx-heart"></i>
          <span class="d-flex absolute -top-1 -right-2 bg-[#C9B194] text-white text-xs w-5 h-5 rounded-full flex items-center justify-center transition-all group-hover:scale-125 group-hover:bg-[#B89E80]" id="wishlist-count">{{ $wishlistCount }}</span>
        </a>
        <a href="{{ route('panier') }}" class="icon transition-all duration-300 hover:scale-110">
          <i class="bx bx-cart"></i>
          <span class="d-flex absolute -top-1 -right-2 bg-[#C9B194] text-white text-xs w-5 h-5 rounded-full flex items-center justify-center transition-all group-hover:scale-125 group-hover:bg-[#B89E80]" id="cart-count">{{ $cartCount }}</span>
        </a>
      
      </div>

      <div class="hamburger">
        <i class="bx bx-menu-alt-left"></i>
      </div>
    </div>
  </div>