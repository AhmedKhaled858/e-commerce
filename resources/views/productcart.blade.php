@extends('maindesign')

@section('content')

    <section class="cart_section layout_padding">

        <div class="container">

            {{-- ALERTS --}}
            {{-- @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif --}}

            {{-- TITLE --}}
            <div class="heading_container heading_center mb-5 cart-title">
                <h2>My Cart</h2>
            </div>

            @if ($cartItems->count() > 0)
                <div class="table-responsive shadow-sm rounded">

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

                                    <td>
                                        <div class="d-flex justify-content-center align-items-center gap-2">

                                            <button class="btn btn-sm btn-danger update-quantity"
                                                data-id="{{ $item->id }}" data-action="decrease">-</button>

                                            <input type="text" value="{{ $item->quantity }}" readonly
                                                id="quantity-{{ $item->id }}" style="width:50px;text-align:center;">

                                            <button class="btn btn-sm btn-success update-quantity"
                                                data-id="{{ $item->id }}" data-action="increase">+</button>

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

                <div class="d-flex justify-content-between mt-4">

                    <a href="{{ route('all.products') }}" class="btn btn-outline-dark">
                        ← Continue Shopping
                    </a>

                    <a href="{{ route('checkout.index') }}" class="btn btn-success">
                        Checkout →
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

    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.update-quantity').click(function(e) {
                e.preventDefault();

                let button = $(this);
                let cartId = button.data('id');
                let action = button.data('action');

                $.ajax({
                    url: "{{ route('cart.update', ':id') }}".replace(':id', cartId),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        action: action
                    },

                    success: function(response) {

                        // update quantity input
                        $('#quantity-' + cartId).val(response.quantity);

                        // update item total
                        $('#item-total-' + cartId).text('$' + response.itemTotal);

                        // update grand total
                        $('#grand-total').text('$' + response.grandTotal);
                    },

                    error: function(xhr) {

                        if (xhr.responseJSON.error) {
                            alert(xhr.responseJSON.error);
                        } else {
                            alert('Something went wrong');
                        }
                    }
                });
            });

        });
    </script>
@endsection
