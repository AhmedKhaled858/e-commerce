@extends('maindesign')

@section('product_cart')

    <div class="container">

        @if (session('success'))
            <div class="alert success">
                <i class="fa fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert error">
                <i class="fa fa-times-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="heading_container heading_center mb-5 cart-title">
            <h2>My Cart</h2>
        </div>

        @if ($cartItems->count() > 0)
            <div class="table-responsive">

                <table class="table table-bordered text-center align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>

                    <tbody>

                        @php $grandTotal = 0; @endphp

                        @foreach ($cartItems as $item)
                            @php
                                $total = $item->product->price * $item->quantity;
                                $grandTotal += $total;
                            @endphp

                            <tr>

                                <td>
                                    <img src="{{ asset('storage/' . $item->product->product_image) }}" width="70"
                                        height="70" style="object-fit:cover; border-radius:8px;">
                                </td>

                                <td>{{ $item->product->title }}</td>

                                <td>
                                    $<span id="price-{{ $item->id }}">
                                        {{ $item->product->price }}
                                    </span>
                                </td>

                                <td>

                                    <div class="d-flex justify-content-center align-items-center gap-2">

                                        <button class="btn btn-sm btn-danger update-quantity" data-id="{{ $item->id }}"
                                            data-action="decrease">
                                            -
                                        </button>

                                        <input type="text" value="{{ $item->quantity }}" readonly
                                            id="quantity-{{ $item->id }}" style="width:50px; text-align:center;">

                                        <button class="btn btn-sm btn-success update-quantity" data-id="{{ $item->id }}"
                                            data-action="increase">
                                            +
                                        </button>

                                    </div>

                                </td>

                                <td id="item-total-{{ $item->id }}">
                                    ${{ $total }}
                                </td>

                                <td>
                                    <a href="{{ route('cart.remove', $item->id) }}" class="btn btn-danger btn-sm">

                                        <i class="fa fa-trash"></i>

                                    </a>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="text-end mt-4">
                <h4>
                    Total:
                    <span class="text-success" id="grand-total">
                        ${{ $grandTotal }}
                    </span>
                </h4>
            </div>

            <div class="text-start mt-4">
                <a href="{{ route('all.products') }}" class="continue-btn">
                    <i class="fa fa-arrow-left"></i>
                    Continue Shopping
                </a>
            </div>

            <div class="text-end mt-4">
                <a href="#" class="checkout-btn">
                    <i class="fa fa-shopping-cart"></i>
                    Checkout
                </a>
            </div>
        @else
            <div class="text-center py-5">

                <h4>Your cart is empty</h4>

                <a href="{{ route('all.products') }}" class="btn btn-dark mt-3">
                    Shop Now
                </a>

            </div>
        @endif

    </div>


    <script>
        setTimeout(function() {

            const alert = document.querySelector('.alert');

            if (alert) {

                alert.style.transition = "0.5s";
                alert.style.opacity = "0";
                alert.style.transform = "translateY(-10px)";

                setTimeout(() => {
                    alert.style.display = "none";
                }, 500);

            }

        }, 3000);
    </script>


    <script>
        document.querySelectorAll('.update-quantity').forEach(button => {

            button.addEventListener('click', function() {

                let itemId = this.dataset.id;
                let action = this.dataset.action;

                fetch(`/cart/update/${itemId}`, {

                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },

                        body: JSON.stringify({
                            action: action
                        })

                    })

                    .then(response => response.json())

                    .then(data => {

                        if (data.error) {
                            alert(data.error);
                            return;
                        }

                        document.getElementById(`quantity-${itemId}`).value =
                            data.quantity;

                        document.getElementById(`item-total-${itemId}`).innerText =
                            '$' + data.itemTotal;

                        document.getElementById('grand-total').innerText =
                            '$' + data.grandTotal;

                    });

            });

        });
    </script>

@endsection
