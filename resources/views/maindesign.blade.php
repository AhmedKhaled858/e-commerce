<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('front_end/images/favicon.png') }}" type="image/x-icon">

    <title>
        Giftos
    </title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css')}}" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('front_end/css/bootstrap.css') }}" />

    <!-- Main Style -->

    <link rel="stylesheet" href="{{ asset('front_end/css/style.css') }}" />

    <!-- Responsive -->
    <link rel="stylesheet" href="{{ asset('front_end/css/responsive.css') }}" />

    {{-- Checkout Style --}}
    <link rel="stylesheet" href="{{ asset('front_end/css/checkout_style.css') }}" />

</head>

<body>
    
   @include('partials.flash_messages')
   @include('partials.header-home')
   @yield('content')
   <br></br> <br></br>
   @include('partials.footer')

    <!-- end info section -->
    <script src="{{ asset('front_end/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('front_end/js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    
    <script src="{{ asset('front_end/js/custom.js') }}"></script>
    <script src="{{ asset('front_end/js/timeout.js') }}"></script>
</body>

</html>
