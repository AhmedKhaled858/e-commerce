
@extends('maindesign')
@section('checkout')
<div class="container">
    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- تفاصيل الشحن -->
            <div class="col-md-7">
                <h4>Shipping Details</h4>
                <div class="form-group mb-3">
                    <label>Full Name</label>
                    <input type="text" name="full_name" class="form-control" value="{{ Auth::user()->name }}" required>
                </div>
                <div class="form-group mb-3">
                    <label>Phone Number</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Address</label>
                    <textarea name="address" class="form-control" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" required>
                </div>
                <div class="form-check mt-2">
                    <input type="checkbox" name="save_address" class="form-check-input" id="save_address" value="1">
                    <label class="form-check-label" for="save_address">Save this address for future</label>
                </div>
            </div>

            <!-- ملخص الدفع -->
            <div class="col-md-5">
                <div class="card p-3 shadow-sm">
                    <h5>Order Summary</h5>
                    <hr>
                    @foreach($cartItems as $item)
                        <div class="d-flex justify-content-between">
                            <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                            <span>${{ $item->product->price * $item->quantity }}</span>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between font-weight-bold">
                        <span>Total:</span>
                        <span>${{ $totalPrice }}</span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-4">Confirm & Place Order</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection