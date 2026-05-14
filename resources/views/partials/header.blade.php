     <div class="hero_area">
         <header class="header_section">
             <nav class="navbar navbar-expand-lg custom_nav-container ">
                 <a class="navbar-brand" href="{{ route('index') }}">
                     <span>
                         Giftos
                     </span>
                 </a>
                 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                     aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class=""></span>
                 </button>

                 <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav  ">
                         <li class="nav-item active">
                             <a class="nav-link" href="{{ route('index') }}">Home <span
                                     class="sr-only">(current)</span></a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="shop.html">
                                 Shop
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('why') }}">
                                 Why Us
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="testimonial.html">
                                 Testimonial
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('contact_us') }}">Contact Us</a>
                         </li>
                     </ul>
                     <div class="user_option">
                         @if (Auth::check())
                             <a href="{{ route('dashboard') }}">
                                 <i class="fa fa-user" aria-hidden="true"></i>
                                 <span>
                                     Dashboard
                                 </span>
                             </a>
                             <a href="{{ route('logout') }}"
                                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                 <i class="fa fa-sign-out" aria-hidden="true"></i>

                                 <span>
                                     Logout
                                 </span>
                             </a>

                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                 @csrf
                             </form>
                         @else
                             <a href="{{ route('login') }}">
                                 <i class="fa fa-user" aria-hidden="true"></i>
                                 <span>
                                     Login
                                 </span>
                             </a>
                             <a href="{{ route('register') }}">
                                 <i class="fa fa-user-plus" aria-hidden="true"></i>
                                 <span>
                                     Sign Up
                                 </span>
                             </a>
                         @endif

                         <a href="{{ route('product.cart') }}" style="position:relative;">
                             <i class="fa fa-shopping-bag" aria-hidden="true"></i>

                             @if (($cartCount ?? 0) > 0)
                                 <span class="cart-count">
                                     {{ $cartCount ?? 0 }}
                                 </span>
                             @endif
                         </a>
                         <form class="form-inline ">
                             <button class="btn nav_search-btn" type="submit">
                                 <i class="fa fa-search" aria-hidden="true"></i>
                             </button>
                         </form>
                     </div>
                 </div>
             </nav>
         </header>
     </div>
