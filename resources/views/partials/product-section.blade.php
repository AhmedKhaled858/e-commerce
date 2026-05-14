<div class="container">

    <div class="heading_container heading_center">
        <h2>
            {{ $title }}
        </h2>
    </div>

    @include('component.product-gride')

    @if (isset($showAllBtn) && $showAllBtn)
        <div class="products-btn-wrapper text-center mt-5">

            <a href="{{ route('all.products') }}" class="view-products-btn">
                View All Products
                <i class="fa fa-arrow-right ms-2"></i>
            </a>

        </div>
    @endif

</div>
