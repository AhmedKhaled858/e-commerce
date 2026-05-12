@extends('maindesign')

@section('product_details')

    <div class="container product-details-page">

        {{-- Heading --}}
        <div class="heading_container heading_center mb-5 position-relative">
            @if (session('success'))
                <script>
                    window.flashSuccess = @json(session('success'));
                </script>
            @endif

            @if (session('error'))
                <script>
                    window.flashError = @json(session('error'));
                </script>
            @endif

            {{-- Back Button --}}
            <a href="{{ url('/') }}" class="back-btn text-decoration-none position-absolute"
                style="left:0; top:50%; transform:translateY(-50%);">

                <i class="fa fa-arrow-left"></i>
                Back to Product

            </a>

            {{-- Title --}}
            <div class="heading_container heading_center Product-title">

                <h2>
                    Product Details
                </h2>

            </div>

        </div>


        {{-- Product Section --}}
        <div class="row align-items-center g-5">

            {{-- Product Image --}}
            <div class="col-lg-6">

                <div class="img-box text-center">

                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->title }}"
                        class="product-image">

                </div>

            </div>


            {{-- Product Info --}}
            <div class="col-lg-6">

                {{-- Product Name --}}
                <h2 class="product-name mb-3">
                    {{ $product->title }}
                </h2>

                {{-- Product Price --}}
                <h4 class="product-price mb-4">
                    ${{ $product->price }}
                </h4>

                {{-- Description --}}
                <p class="product-description">
                    {{ $product->description }}
                </p>


                {{-- Stock --}}
                @if ($product->quantity > 0)
                    <span class="custom-badge mt-2 d-inline-block">
                        In Stock
                    </span>
                @else
                    <span class="custom-badge mt-2 d-inline-block">
                        Out Of Stock
                    </span>
                @endif


                {{-- Cart Form --}}
                <div class="mt-4">

                    <form action="{{ route('cart.add') }}" method="POST">

                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">


                        {{-- Quantity --}}
                        <label class="fw-bold mb-3 d-block">
                            Select Quantity
                        </label>

                        <div class="qty-box mb-3">

                            <input type="number" name="quantity" value="1" min="1"
                                max="{{ $product->quantity }}" class="qty-input">

                        </div>


                        {{-- Add To Cart --}}
                        <button type="submit" class="cart-btn" @if ($product->quantity == 0) disabled @endif>

                            <i class="fa fa-shopping-cart me-2"></i>

                            Add To Cart

                        </button>

                    </form>

                </div>

            </div>

        </div>


        {{-- Review Section --}}
        <div class="mt-5 pt-5">

            <h3 class="section-title mb-4">
                Write Review
            </h3>

            @auth

                <form action="{{ route('reviews.store') }}" method="POST">

                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">


                    {{-- Review Text --}}
                    <textarea name="review" rows="4" class="custom-textarea mb-4" placeholder="Write your review here..."></textarea>


                    {{-- Rating --}}
                    <select name="rating" class="custom-select mb-4">

                        <option value="">
                            Select Rating
                        </option>

                        <option value="5">
                            ★★★★★
                        </option>

                        <option value="4">
                            ★★★★☆
                        </option>

                        <option value="3">
                            ★★★☆☆
                        </option>

                        <option value="2">
                            ★★☆☆☆
                        </option>

                        <option value="1">
                            ★☆☆☆☆
                        </option>

                    </select>


                    {{-- Submit Review --}}
                    <button type="submit" class="review-btn">

                        Submit Review

                    </button>

                </form>
            @else
                <div class="login-warning mt-4">
                    <i class="fa fa-lock"></i>
                    <span>Please login first to add your review.</span>
                </div>
            @endauth

        </div>


        {{-- Reviews --}}
        <div class="mt-5 pt-4">

            <h3 class="section-title mb-4">

                Customer Reviews

            </h3>

            @forelse($product->reviews as $review)
                <div class="review-card">

                    <div class="card-body">

                        {{-- User --}}
                        <h5 class="review-user mb-2">

                            {{ $review->user->name ?? 'Anonymous' }}

                        </h5>


                        {{-- Stars --}}
                        <div class="review-stars mb-3">

                            @for ($i = 1; $i <= $review->rating; $i++)
                                ★
                            @endfor

                        </div>


                        {{-- Review --}}
                        <p class="review-text mb-0">

                            {{ $review->review }}

                        </p>

                    </div>

                </div>

            @empty

                <div class="empty-review">

                    No reviews yet.

                </div>
            @endforelse

        </div>

    </div>

@endsection
