@extends('admin.maindesign')

@section('searchresults')

<div class="container py-5">

    <h2 class="mb-4">
        Search Results For:
        <span class="text-primary">"{{ $keyword }}"</span>
    </h2>

    {{-- Products Results --}}
    @if($products->isNotEmpty())
        <h4 class="mb-3">Products</h4>

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">

                        <img 
                            src="{{ asset('storage/' . $product->product_image) }}" 
                            alt="{{ $product->title }}"
                            class="card-img-top"
                            style="height:220px; object-fit:cover;"
                            loading="lazy"
                        >

                        <div class="card-body">

                            <h5 class="card-title">
                                {{ $product->title }}
                            </h5>

                            <p class="text-muted">
                                {{ Str::limit($product->description, 80) }}
                            </p>

                            <h6 class="text-success">
                                ${{ $product->price }}
                            </h6>

                            <a href="#" class="btn btn-primary btn-sm mt-2">
                                View Details
                            </a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif


    {{-- Categories Results --}}
    @if($categories->isNotEmpty())

        <h4 class="mt-5 mb-3">Categories</h4>

        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-3 mb-3">
                    <div class="p-3 bg-light rounded shadow-sm text-center">
                        {{ $category->name }}
                    </div>
                </div>
            @endforeach
        </div>

    @endif


    {{-- No Results --}}
    @if($products->isEmpty() && $categories->isEmpty())

        <div class="text-center py-5">
            <h3>No Results Found</h3>
            <p class="text-muted">
                Try searching with another keyword.
            </p>
        </div>

    @endif

</div>

@endsection