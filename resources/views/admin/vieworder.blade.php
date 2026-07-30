@extends('admin.maindesign')

@section('view_orders')

    <head>
        <link rel="stylesheet" href="{{ asset('admin/css/customstyle.css') }}">

    </head>

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
                        @forelse ($orders as $order)
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
                        @empty
                            <tr>
                                <td class="text-center" colspan="7">No Orders found.</td>
                            </tr>
                        @endforelse

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
