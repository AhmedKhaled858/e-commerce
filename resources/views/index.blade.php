@extends('maindesign')
@section('index')
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
@endsection
