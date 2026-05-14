@extends('maindesign')

@section('content')

<div class="hero_area">

    <section class="slider_section">
        @include('partials.welcome')
        @yield('index')
    </section>

</div>

<section class="shop_section layout_padding">

    <div class="container">

        <div class="heading_container heading_center">
            <h2>
                Latest Products
            </h2>
        </div>

        @include('component.product-gride')

        <div class="products-btn-wrapper text-center mt-5">

            <a href="{{ route('all.products') }}" class="view-products-btn">

                View All Products

                <i class="fa fa-arrow-right ms-2"></i>

            </a>

        </div>

    </div>

</section>

    <section class="contact_section layout_padding">
    @include('partials.contact')
</section>

@endsection