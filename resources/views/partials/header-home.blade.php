<div class="hero_area">
    <header class="header_section">
        <nav class="navbar navbar-expand-lg custom_nav-container">

            <a class="navbar-brand" href="{{ route('index') }}">
                <span>Giftos</span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('index') }}">
                            Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('shop.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('shop.index') }}">
                            Shop
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('why') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('why') }}">
                            Why Us
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('testimonial') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('testimonial') }}">
                            Testimonial
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('contact_us') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('contact_us') }}">
                            Contact Us
                        </a>
                    </li>

                </ul>
                <div class="user_option">

                    @if (Auth::check())
                        <a href="{{ route('dashboard') }}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            <span>Logout</span>

                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Login</span>
                        </a>

                        <a href="{{ route('register') }}">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                            <span>Sign Up</span>
                        </a>
                    @endif
                    <a href="{{ route('product.cart') }}" style="position:relative;">
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>

                        @if (($cartCount ?? 0) > 0)
                            <span class="cart-count">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    {{-- SEARCH --}}
                    <form class="form-inline search-form" action="{{ route('search') }}" method="GET">

                        <div class="search-box">

                            <input type="search" name="search" placeholder="Search products..." class="search-input"
                                required>

                            <button class="search-btn" type="submit">
                                <i class="fa fa-search"></i>
                            </button>

                        </div>

                    </form>

                </div>

            </div>
        </nav>
    </header>
</div>
