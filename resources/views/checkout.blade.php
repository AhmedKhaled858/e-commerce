@extends('maindesign')

@section('checkout')


    <div class="container py-5">
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Left Side: Interactive Steps -->
                <div class="col-lg-8">

                    <!-- Step 1: Customer -->
                    <div class="checkout-step">
                        <div class="step-icon">1</div>
                        <h4 class="font-weight-bold mb-4">Contact Information</h4>
                        <div class="glass-card p-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small">Full Name</label>
                                    <input type="text" name="full_name" class="form-control"
                                        value="{{ Auth::user()->name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Shipping -->
                    <div class="checkout-step">
                        <div class="step-icon">2</div>
                        <h4 class="font-weight-bold mb-4">Shipping Address</h4>
                        <div class="glass-card p-4">
                            <div class="mb-3">
                                <label class="text-muted small">Street Address</label>
                                <textarea name="address" class="form-control" rows="2" placeholder="House number and street name" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small">City</label>
                                <input type="text" name="city" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Payment -->
                    <div class="checkout-step">
                        <div class="step-icon">3</div>
                        <h4 class="font-weight-bold mb-4">Payment Method</h4>
                        <div class="glass-card p-4">
                            <div class="row">
                                <!-- 1. Cash on Delivery -->
                                <div class="col-md-6 mb-3">
                                    <label class="w-100 mb-0">
                                        <input type="radio" name="payment_method" value="cash" class="d-none" checked>
                                        <div class="payment-select-box p-3 text-center"
                                            onclick="updatePaymentSelection(this)">
                                            <i class="fas fa-truck fa-2x mb-2 text-primary"></i>
                                            <div class="font-weight-bold">Cash</div>
                                            <small class="text-muted">Pay on Delivery</small>
                                        </div>
                                    </label>
                                </div>

                                <!-- 2. Credit/Debit Card -->
                                <div class="col-md-6 mb-3">
                                    <label class="w-100 mb-0">
                                        <input type="radio" name="payment_method" value="visa" class="d-none">
                                        <div class="payment-select-box p-3 text-center"
                                            onclick="updatePaymentSelection(this)">
                                            <i class="fas fa-credit-card fa-2x mb-2 text-primary"></i>
                                            <div class="font-weight-bold">Card</div>
                                            <small class="text-muted">Visa / Mastercard</small>
                                        </div>
                                    </label>
                                </div>

                                <!-- 3. Mobile Wallets (e.g. Vodafone Cash, InstaPay) -->
                                <div class="col-md-6 mb-3">
                                    <label class="w-100 mb-0">
                                        <input type="radio" name="payment_method" value="wallet" class="d-none">
                                        <div class="payment-select-box p-3 text-center"
                                            onclick="updatePaymentSelection(this)">
                                            <i class="fas fa-mobile-alt fa-2x mb-2 text-primary"></i>
                                            <div class="font-weight-bold">Wallet</div>
                                            <small class="text-muted">Vodafone / InstaPay</small>
                                        </div>
                                    </label>
                                </div>

                                <!-- 4. Installments / BNPL (e.g. Tabby, Tamara, ValU) -->
                                <div class="col-md-6 mb-3">
                                    <label class="w-100 mb-0">
                                        <input type="radio" name="payment_method" value="installments" class="d-none">
                                        <div class="payment-select-box p-3 text-center"
                                            onclick="updatePaymentSelection(this)">
                                            <i class="fas fa-calendar-check fa-2x mb-2 text-primary"></i>
                                            <div class="font-weight-bold">Installments</div>
                                            <small class="text-muted">Split your payment</small>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Side: Floating Summary -->
                <div class="col-lg-4">
                    <div class="glass-card p-4 sticky-top" style="top: 20px;">
                        <h5 class="font-weight-bold mb-4">Your Order</h5>

                        @foreach ($cartItems as $item)
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded p-2 mr-3" style="width: 50px; height: 50px; overflow: hidden;">
                                    <!-- Example product image placeholder -->
                                    <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/50' }}"
                                        class="img-fluid" alt="">
                                </div>
                                <div class="flex-grow-1">
                                    <div class="small font-weight-bold">{{ $item->product->name }}</div>
                                    <div class="small text-muted">Qty: {{ $item->quantity }}</div>
                                </div>
                                <div class="small font-weight-bold">
                                    ${{ number_format($item->product->price * $item->quantity, 2) }}</div>
                            </div>
                        @endforeach

                        <hr>
                        <div class="d-flex justify-content-between mb-2 text-muted">
                            <span>Subtotal</span>
                            <span>${{ number_format($totalPrice, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="h5 font-weight-bold">Total</span>
                            <span class="h5 font-weight-bold text-primary">${{ number_format($totalPrice, 2) }}</span>
                        </div>

                        <button type="submit" class="btn btn-checkout btn-block shadow-sm">
                            Place Order Now <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function updatePaymentSelection(element) {
            // Remove active style from all
            document.querySelectorAll('.payment-select-box').forEach(box => {
                box.style.borderColor = '#f1f5f9';
                box.style.background = 'transparent';
            });
            // Add active style to selected
            element.style.borderColor = '#4f46e5';
            element.style.background = '#f8faff';
            // Check the hidden radio button
            element.previousElementSibling.checked = true;
        }
    </script>
@endsection
