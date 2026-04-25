@extends('maindesign')

@section('product_details')

<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        
    @endif

    <!-- Title + Back Button -->
    <div class="heading_container heading_center mb-4 position-relative">

        <a href="{{ url('/') }}"
           class="text-dark text-decoration-none position-absolute"
           style="left:0; top:50%; transform:translateY(-50%); font-size:16px;">
            <i class="fa fa-arrow-left"></i> Back to Product
        </a>

        <h2>Product Details</h2>

    </div>

    <div class="row align-items-center">

        <!-- Product Image -->
        <div class="col-md-6">
            <div class="img-box text-center">
                <img src="{{ asset('storage/' . $product->product_image) }}"
                     alt="{{ $product->title }}"
                     class="img-fluid rounded shadow"
                     style="max-height:500px; object-fit:cover;">
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

    <!-- Review Section -->
    <div class="mt-5">

        <h3 class="mb-4">Write Review</h3>

        @auth
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf

            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <textarea name="review"
                      class="form-control mb-3"
                      rows="4"
                      placeholder="Write your review here..."></textarea>

            <select name="rating" class="form-control mb-3">
                <option value="">Select Rating</option>
                <option value="5">⭐⭐⭐⭐⭐</option>
                <option value="4">⭐⭐⭐⭐</option>
                <option value="3">⭐⭐⭐</option>
                <option value="2">⭐⭐</option>
                <option value="1">⭐</option>
            </select>

            <button type="submit" class="btn btn-dark px-4">
                Submit Review
            </button>
        </form>
        @else
            <div class="alert alert-warning">
                Please login first to add your review.
            </div>
        @endauth

    </div>
     <!-- Display Reviews -->
    <div class="mt-5">
        <h3 class="mb-4">Customer Reviews</h3>

        @forelse($product->reviews as $review)

            <div class="card mb-3 shadow-sm">
                <div class="card-body">

                    <h5 class="mb-1">
                        {{ $review->user->name ?? 'Anonymous' }}
                    </h5>

                    <div class="mb-2">
                        @for($i = 1; $i <= $review->rating; $i++)
                            ⭐
                        @endfor
                    </div>

                    <p class="mb-0 text-muted">
                        {{ $review->review }}
                    </p>

                </div>
            </div>

        @empty

            <div class="alert alert-secondary">
                No reviews yet.
            </div>

        @endforelse

    </div>



</div>
<script>
    // Auto-hide success message after 3 seconds
    setTimeout(() => {
        const alert = document.querySelector('.alert-success');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 3000);
</script>
@endsection