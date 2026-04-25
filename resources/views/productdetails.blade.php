@extends('maindesign')
@section('product_details')
    
    <div class="container">
        <div class="heading_container heading_center mb-5">
            <h2>Product Details</h2>
        </div>

        <div class="row align-items-center">

            <!-- Product Image -->
            <div class="col-md-6">
                <div class="img-box text-center">
                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->title }}"
                        class="img-fluid rounded shadow" style="max-height:500px; object-fit:cover;">
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-md-6">

                <h2 class="mb-3">{{ $product->title }}</h2>

                <h4 class="text-success mb-4">
                    ${{ $product->price }}
                </h4>

                <p style="line-height:1.9;">
                    {{ $product->description }}
                </p>

                <h6 class="mt-4">
                    Quantity:
                    <span class="text-primary">
                        {{ $product->quantity }}
                    </span>
                </h6>

                @if ($product->quantity > 0)
                    <span class="badge bg-success p-2 mt-2">
                        In Stock
                    </span>
                @else
                    <span class="badge bg-danger p-2 mt-2">
                        Out of Stock
                    </span>
                @endif

                <div class="mt-4">
                    <a href="#" class="btn btn-dark px-4 py-2">
                        Add To Cart
                    </a>
                </div>

            </div>

        </div>

    </div>
@endsection
