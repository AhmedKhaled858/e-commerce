@extends('maindesign')
@section('index')
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      @include('component.product-gride')
      <div class="btn-box">
        <a href="{{ route('all.products') }}">
          View All Products
        </a>
      </div>
    </div>
@endsection