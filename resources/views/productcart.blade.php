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

                                <td>${{ $item->product->price }}</td>

                                <td>{{ $item->quantity }}</td>

                                <td>${{ $total }}</td>

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

            <!-- Grand Total -->
            <div class="text-end mt-4">
                <h4>Total: <span class="text-success">${{ $grandTotal }}</span></h4>
            </div>

            <!-- Continue Shopping -->
            <div class="text-start mt-4">
                <a href="{{ route('all.products') }}" class="continue-btn">
                    <i class="fa fa-arrow-left"></i> Continue Shopping
                </a>
            </div>

            <!-- Checkout -->
            <div class="text-end mt-4">
                <a href="#" class="checkout-btn">
                    <i class="fa fa-shopping-cart"></i> Checkout
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
        // Your JavaScript code here
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

        }, 15000);
    </script>
@endsection
