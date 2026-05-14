@extends('maindesign')

@section('content')

    <section class="product_section layout_padding product-details-page">

        <div class="container">

            {{-- Header --}}
            <div class="heading_container heading_center mb-5 position-relative">

                <a href="{{ url('/') }}" class="back-btn text-decoration-none position-absolute"
                    style="left:0; top:50%; transform:translateY(-50%);">

                    <i class="fa fa-arrow-left"></i>
                    Back

                </a>

                <h2>Product Details</h2>

            </div>

            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-center">

                    <div class="cart-product-image mx-auto">

                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->title }}"
                            class="img-fluid">

                    </div>

                </div>
                <div class="col-lg-6">

                    <h2 class="product-name mb-3">
                        {{ $product->title }}
                    </h2>

                    <h4 class="product-price mb-4">
                        ${{ $product->price }}
                    </h4>

                    <p class="product-description">
                        {{ $product->description }}
                    </p>

                    @if ($product->quantity > 0)
                        <span class="badge bg-success mt-2">In Stock</span>
                    @else
                        <span class="badge bg-danger mt-2">Out of Stock</span>
                    @endif

                    <div class="mt-4">

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf

                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <label class="fw-bold mb-2">Quantity</label>

                            <input type="number" name="quantity" value="1" min="1"
                                max="{{ $product->quantity }}" class="form-control w-25 mb-3">

                            <button type="submit" class="btn btn-dark" @if ($product->quantity == 0) disabled @endif>

                                <i class="fa fa-shopping-cart"></i>
                                Add To Cart

                            </button>

                        </form>

                    </div>

                </div>

            </div>


            <div class="mt-5 pt-5">

                <h3 class="section-title mb-4">Write Review</h3>
                @auth
                    <form action="{{ route('reviews.store') }}" method="POST">

                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">


                        <textarea name="review" rows="4" class="custom-textarea mb-4" placeholder="Write your review here..." required></textarea>


                        <select name="rating" class="custom-select mb-4" required>

                            <option value="">Select Rating</option>
                            <option value="5">★★★★★</option>
                            <option value="4">★★★★☆</option>
                            <option value="3">★★★☆☆</option>
                            <option value="2">★★☆☆☆</option>
                            <option value="1">★☆☆☆☆</option>

                        </select>


                        <button type="submit" class="btn btn-dark review-btn">

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


            <div class="mt-5 pt-5">

                <h3 class="mb-4">Customer Reviews</h3>

                @forelse($reviews as $review)
                    <div class="card mb-3 shadow-sm">

                        <div class="card-body">

                            <h6 class="mb-2">
                                {{ $review->user->name ?? 'Anonymous' }}
                            </h6>

                            <div class="text-warning mb-2">
                                @for ($i = 1; $i <= $review->rating; $i++)
                                    ★
                                @endfor
                            </div>

                            <p class="mb-0">
                                {{ $review->review }}
                            </p>

                        </div>

                    </div>

                @empty

                    <p class="text-muted">No reviews yet.</p>
                @endforelse

            </div>

        </div>

    </section>

@endsection
