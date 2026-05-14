@extends('maindesign')

@section('content')
    <section class="shop_section layout_padding">

        @include('partials.product-section', [
            'title' => 'All Products',
            'showAllBtn' => false,
        ])

    </section>
@endsection
