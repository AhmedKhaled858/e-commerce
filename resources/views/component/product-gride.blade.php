      <div class="row">
        @foreach ($products as $product)
          <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="{{ route('product_details', $product->id) }}">
              <div class="img-box">
                <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}">
              </div>
              <div class="detail-box">
                <h6>
                  {{ $product->name }}
                </h6>
                <h6>
                  Price
                  <span>
                    ${{ $product->price }}
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>