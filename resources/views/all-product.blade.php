@extends('maindesign')
@section('index')
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                All Products
            </h2>
        </div>

        @include('component.product-gride')
    </div>
 @endsection
