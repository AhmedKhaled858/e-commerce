@extends('maindesign')

@section('content')
    <div class="hero_area">
        <section class="slider_section">
            @include('partials.welcome')
        </section>
    </div>

    <section class="shop_section layout_padding">

        @include('partials.product-section', [
            'title' => 'Latest Products',
            'showAllBtn' => true,
        ])

    </section>

    <section class="contact_section layout_padding">
        @include('partials.contact')
    </section>
@endsection
