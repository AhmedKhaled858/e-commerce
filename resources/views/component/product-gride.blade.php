<div class="row g-4">

    @foreach ($products as $product)

        <div class="col-sm-6 col-md-4 col-lg-3">

            <div class="product-card">

                <a href="{{ route('product_details', $product->id) }}"
                   class="product-link">

                    {{-- Product Badge --}}
                    <div class="product-badge">

                        <span>
                            New
                        </span>

                    </div>


                    {{-- Product Image --}}
                    <div class="product-img-box">

                        <img src="{{ asset('storage/' . $product->product_image) }}"
                             alt="{{ $product->name }}"
                             class="product-img">

                    </div>


                    {{-- Product Details --}}
                    <div class="product-details">

                        <h5 class="product-card-title">

                            {{ $product->name }}

                        </h5>


                        <div class="product-price-box">

                            <span class="price-label">
                                Price
                            </span>

                            <span class="product-card-price">
                                ${{ $product->price }}
                            </span>

                        </div>

                    </div>

                </a>

            </div>

        </div>

    @endforeach

</div>