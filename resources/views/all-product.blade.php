@extends('maindesign')

@section('content')
    <section class="shop_section layout_padding">

        <div class="container">
            <div class="heading_container heading_center mb-5">
                <h2>All Products</h2>
                <p class="text-muted">
                    Browse all available products in our store
                </p>
            </div>
            @include('component.product-gride')

        </div>

    </section>
@endsection
