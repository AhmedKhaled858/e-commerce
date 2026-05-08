@extends('admin.maindesign')
@section('view_orders')

    <head>
        <style>
            .order-details-btn {
                background: linear-gradient(135deg, #2563eb, #3b82f6);
                color: white;
                border: none;
                padding: 8px 16px;
                border-radius: 10px;
                font-weight: 600;
                transition: 0.3s ease;
                box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
            }

            .order-details-btn:hover {
                transform: translateY(-2px);
                background: linear-gradient(135deg, #1d4ed8, #2563eb);
                color: white;
                box-shadow: 0 6px 14px rgba(37, 99, 235, 0.35);
            }

            .status-select {
                min-width: 130px;
                border-radius: 8px;
                border: 1px solid #3b82f6;
                background: #f8fafc;
                color: #1e293b;
                font-weight: 600;
            }

            .status-text {
                font-weight: 600;
                color: #2563eb;
                min-width: 90px;
            }

            /* Custom spacing for the action buttons */
            .action-wrapper {
                display: flex;
                gap: 8px;
            }
        </style>
    </head>

    <div id="loadingScreen">
        <div class="spinner"></div>
    </div>

    <div class="container-fluid px-5">
        <h2 class="my-4">Orders List</h2>
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Payment Method</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->s_full_name }}</td>
                        <td>${{ $order->total_amount }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>

                        {{-- Status Column --}}
                        <td>
                            <form id="form-{{ $order->id }}" action="{{ route('admin.updateOrderStatus', $order->id) }}" method="POST">
                                @csrf
                                
                                <span class="status-text">{{ ucfirst($order->status->value) }}</span>
                                <select name="status" class="form-select form-select-sm status-select d-none">
                                    @foreach (App\Enums\OrderStatus::cases() as $status)
                                        <option value="{{ $status->value }}" {{ $order->status === $status->value ? 'selected' : '' }}>
                                            {{ ucfirst($status->value) }}
                                        </option>
                                        
                                    @endforeach
                                </select>
                            </form>
                        </td>

                        {{-- Actions Column --}}
                        <td>
                            <div class="action-wrapper">
                                {{-- View Details --}}
                                <a href="{{ route('admin.OrderDetails', $order->id) }}" class="btn btn-sm order-details-btn" title="View Details">
                                    <i class="fa fa-eye"></i>
                                </a>

                                {{-- Edit Button: Pencil Icon --}}
                                <button type="button" class="btn btn-sm btn-primary edit-order-btn" title="Edit Status">
                                    <i class="fa fa-edit"></i>
                                </button>

                                {{-- Save Button: Checkmark Icon (Hidden by default) --}}
                                <button type="button" class="btn btn-sm btn-success save-order-btn d-none" data-id="{{ $order->id }}" title="Save Changes">
                                    <i class="fa fa-check-circle"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Handle Edit Click: Switch from text to dropdown
            document.querySelectorAll('.edit-order-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let row = this.closest('tr');

                    // Hide text, show dropdown
                    row.querySelector('.status-text').classList.add('d-none');
                    row.querySelector('.status-select').classList.remove('d-none');

                    // Switch buttons: Hide edit, show save
                    row.querySelector('.save-order-btn').classList.remove('d-none');
                    this.classList.add('d-none');
                });
            });

            // Handle Save Click: Submit the hidden form
            document.querySelectorAll('.save-order-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let orderId = this.getAttribute('data-id');
                    let form = document.getElementById('form-' + orderId);
                    if (form) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection