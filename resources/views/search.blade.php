@extends('maindesign')

@section('content')

<div class="container py-5">

    <h3 class="mb-4">
        Search results for: 
        <span style="color:#000;">"{{ $keyword }}"</span>
    </h3>

    @if($products->count() > 0)

        <div class="row">

            @foreach($products as $product)
                <div class="col-md-4 mb-4">

                    <div class="card product-card shadow-sm border-0">

                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->title }}"
                             class="card-img-top"
                             style="height:200px; object-fit:cover;">

                        <div class="card-body">

                            <h5>{{ $product->title }}</h5>

                            <p class="text-muted">
                                {{ Str::limit($product->description, 80) }}
                            </p>

                            <a href="{{ route('product_details', $product->id) }}" class="btn btn-dark btn-sm">
                                View Product
                            </a>

                        </div>
                    </div>

                </div>
            @endforeach

        </div>

    @else

        <div class="alert alert-warning">
            No products found for "<b>{{ $keyword }}</b>"
        </div>

    @endif

</div>

@endsection