@extends('admin.maindesign')

@section('order_details')
<head>
    <style>
        /* Dark Theme Variables */
        :root {
            --bg-dark: #0f172a;
            --card-bg: #1e293b;
            --accent-blue: #3b82f6;
            --border-color: #334155;
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
        }

        body { background-color: var(--bg-dark); color: var(--text-main); }

        .detail-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
            margin-bottom: 1.5rem;
        }

        .card-header-dark {
            border-bottom: 1px solid var(--border-color);
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header-dark h5 { margin: 0; color: var(--accent-blue); font-weight: 600; }

        /* Product Table Styling */
        .table-dark-custom { color: var(--text-main); margin-bottom: 0; }
        .table-dark-custom thead { background: rgba(255,255,255,0.03); }
        .table-dark-custom th { border-color: var(--border-color); color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase; }
        .table-dark-custom td { border-color: var(--border-color); vertical-align: middle; padding: 1rem; }

        .product-thumb {
            border-radius: 8px;
            border: 2px solid var(--border-color);
            transition: border-color 0.3s;
        }

        .product-thumb:hover { border-color: var(--accent-blue); }

        .stats-box {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
        }

        .label-pill {
            color: var(--text-muted);
            font-size: 0.8rem;
            display: block;
            margin-bottom: 4px;
        }

        .value-text {
            color: var(--text-main);
            font-weight: 500;
            display: block;
        }
    </style>
</head>

<div class="container-fluid px-5 py-5">
    
    {{-- Top Navigation Bar --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--text-main);">Order Overview</h2>
            <p class="text-muted mb-0">ID: <span class="text-info">#{{ $order->id }}</span> • Date: {{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-4" style="border-color: var(--border-color)">
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
                        <span class="badge bg-primary px-3">{{ strtoupper($order->payment_method) }}</span>
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
                                                     class="product-thumb" width="70" height="70" alt="{{ $item->product->title }}" loading="lazy">
                                                <div>
                                                    <div class="fw-bold" style="padding: 15px">{{ $item->product->title }}</div>
                                                    <small class="text-muted" style="padding: 15px">SKU: {{ $item->product->id ?? 'N/A' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge rounded-pill bg-dark border border-secondary">x{{ $item->quantity }}</span>
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