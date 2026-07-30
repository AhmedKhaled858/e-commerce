@extends('admin.maindesign')

@section('order_details')

    <head>
        <link rel="stylesheet" href="{{ asset('admin/css/customstyle.css') }}">
    </head>

    <div class="container-fluid px-5 py-5">

        {{-- Top Navigation Bar --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1" style="color: var(--text-main);">Order Overview</h2>
                <p class="text-muted mb-0">ID: <span class="text-info">#{{ $order->id }}</span> • Date:
                    {{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-4"
                style="border-color: var(--border-color)">
                <i class="fa fa-chevron-left me-2"></i> Return
            </a>
        </div>

        <div class="row">
            {{-- Side Info Panel --}}
            <div class="col-xl-4 col-lg-5">

                {{-- Customer Card --}}
                <div class="detail-card">
                    <div class="card-header-dark">
                        <i class="fa fa-user-circle"></i>
                        <h5>Customer Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="label-pill">FULL NAME</span>
                            <span class="value-text">{{ $order->s_full_name }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="label-pill">CONTACT NUMBER</span>
                            <span class="value-text text-info">{{ $order->s_phone_number }}</span>
                        </div>
                        <div>
                            <span class="label-pill">SHIPPING ADDRESS</span>
                            <span class="value-text">{{ $order->s_address }}</span>
                        </div>
                    </div>
                </div>

                {{-- Payment Card --}}
                <div class="detail-card">
                    <div class="card-header-dark">
                        <i class="fa fa-wallet"></i>
                        <h5>Payment Info</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between">
                            <span class="text-muted">Method:</span>
                            <span class="badge bg-primary px-3">{{ $order->payment_method->label() }}</span>
                        </div>
                        <div class="stats-box">
                            <span class="text-muted d-block mb-1">Total Bill</span>
                            <h3 class="fw-bold text-success mb-0">${{ number_format($order->total_amount, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Products Table --}}
            <div class="col-xl-8 col-lg-7">
                <div class="detail-card">
                    <div class="card-header-dark justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa fa-shopping-basket"></i>
                            <h5>Order Items</h5>
                        </div>
                        <span class="text-muted small">{{ count($order->items) }} Products</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-dark-custom">
                                <thead>
                                    <tr>
                                        <th>Item Details</th>
                                        <th class="text-center">Qty</th>
                                        <th>Unit Price</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ asset('storage/' . $item->product->product_image) }}"
                                                        class="product-thumb" width="70" height="70"
                                                        alt="{{ $item->product->title }}" loading="lazy">
                                                    <div>
                                                        <div class="fw-bold" style="padding: 15px">
                                                            {{ $item->product->title }}</div>
                                                        <small class="text-muted" style="padding: 15px">SKU:
                                                            {{ $item->product->id ?? 'N/A' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="badge rounded-pill bg-dark border border-secondary">x{{ $item->quantity }}</span>
                                            </td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td class="text-end fw-bold text-info">
                                                ${{ number_format($item->price * $item->quantity, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
