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
      
        
        <a href="{{ route('wishlist') }}" class="icon">
          <i class="bx bx-heart"></i>
          <span class="d-flex">{{ $wishlistCount }}</span>
        </a>

      </li>
      </ul>

      <div class="icons d-flex iconss">
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
        <a href="{{ route('wishlist') }}" class="icon">
          <i class="bx bx-heart"></i>
          <span class="d-flex" id="wishlist-count">{{ $wishlistCount }}</span>
        </a>

      </div>

      <div class="hamburger">
        <i class="bx bx-menu-alt-left"></i>
      </div>
    </div>
  </div>