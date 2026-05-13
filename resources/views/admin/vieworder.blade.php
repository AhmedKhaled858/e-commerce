@extends('admin.maindesign')

@section('view_orders')
    <style>
        /* ===== ORDER TABLE MODERN STYLE ===== */

        .order-card {
            background: #111827;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .order-table {
            color: #e5e7eb;
        }

        .order-table thead {
            background: #0f172a;
        }

        .order-table tbody tr {
            transition: 0.2s ease;
        }

        .order-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        /* Status badges */
        .status-badge {
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
        }

        .status-completed {
            background: rgba(34, 197, 94, 0.15);
            color: #4ade80;
        }

        .status-cancelled {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
        }

        /* Buttons */
        .btn-icon {
            border-radius: 10px;
            transition: 0.2s;
        }

        .btn-icon:hover {
            transform: translateY(-2px);
        }

        /* Select */
        .status-select {
            background: #1f2937;
            color: #fff;
            border: 1px solid #374151;
            border-radius: 8px;
        }
    </style>

    <div class="container-fluid px-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-light mb-0">Orders List</h3>
        </div>

        {{-- TABLE CARD --}}
        <div class="order-card">

            <div class="table-responsive">
                <table class="table order-table align-middle mb-0">

                    <thead>
                        <tr class="text-secondary">
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $order)
                            <tr>

                                {{-- ID --}}
                                <td class="text-info fw-bold">
                                    #{{ $order->id }}
                                </td>

                                {{-- Customer --}}
                                <td>
                                    {{ $order->s_full_name }}
                                </td>

                                {{-- Total --}}
                                <td class="text-success fw-bold">
                                    ${{ $order->total_amount }}
                                </td>

                                {{-- Payment --}}
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $order->payment_method }}
                                    </span>
                                </td>

                                {{-- Date --}}
                                <td class="text-muted">
                                    {{ $order->created_at->format('Y-m-d') }}
                                </td>

                                {{-- STATUS --}}
                                <td>
                                    <form id="form-{{ $order->id }}"
                                        action="{{ route('admin.updateOrderStatus', $order->id) }}" method="POST">
                                        @csrf

                                        {{-- Badge --}}
                                        <span class="status-badge status-{{ $order->status->value }}">
                                            {{ ucfirst($order->status->value) }}
                                        </span>

                                        {{-- Select (hidden) --}}
                                        <select name="status" class="form-select form-select-sm mt-2 status-select d-none">
                                            @foreach (App\Enums\OrderStatus::cases() as $status)
                                                <option value="{{ $status->value }}"
                                                    {{ $order->status->value === $status->value ? 'selected' : '' }}>
                                                    {{ ucfirst($status->value) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>

                                {{-- ACTIONS --}}
                                <td>
                                    <div class="d-flex justify-content-center gap-2">

                                        {{-- VIEW --}}
                                        <a href="{{ route('admin.OrderDetails', $order->id) }}"
                                            class="btn btn-sm btn-outline-info btn-icon">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                            
                                        {{-- EDIT --}}
                                        <button type="button"
                                            class="btn btn-sm btn-outline-warning btn-icon edit-order-btn">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        {{-- SAVE --}}
                                        <button type="button" class="btn btn-sm btn-success btn-icon save-order-btn d-none"
                                            data-id="{{ $order->id }}">
                                            <i class="fa fa-check"></i>
                                        </button>

                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

        {{-- PAGINATION --}}
        <div class="mt-4">
            {{ $orders->links() }}
        </div>

    </div>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // EDIT MODE
            document.querySelectorAll('.edit-order-btn').forEach(btn => {
                btn.addEventListener('click', function() {

                    let row = this.closest('tr');

                    row.querySelector('.status-badge').classList.add('d-none');
                    row.querySelector('.status-select').classList.remove('d-none');

                    row.querySelector('.save-order-btn').classList.remove('d-none');
                    this.classList.add('d-none');
                });
            });

            // SAVE
            document.querySelectorAll('.save-order-btn').forEach(btn => {
                btn.addEventListener('click', function() {

                    let id = this.dataset.id;
                    let form = document.getElementById('form-' + id);

                    if (form) form.submit();
                });
            });

        });
    </script>
@endsection
