<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Gifts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
        }

        /* Glassmorphism Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }
    </style>
</head>

<body class="p-6 md:p-12">

 <div class="max-w-5xl mx-auto">
        <!-- Navigation Row -->
        <div class="flex justify-between items-center mb-8">
            <a href="/" class="glass-card px-4 py-2 text-sm font-medium text-gray-700 hover:bg-white/50 transition-all flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Back to Home
            </a>
        </div>
    
    @foreach ($orders as $order) 
        <div class="mb-20"> 
            <!-- Header -->
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Order <span class="text-gray-500 font-medium">#{{ $order->order_number }}</span></h1>

            <div class="glass-card p-6 mb-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    @php
                        $steps = collect(App\Enums\OrderStatus::cases())->filter(fn($s) => $s !== App\Enums\OrderStatus::CANCELLED);
                    @endphp

                    @foreach ($steps as $status)
                        @php $styles = $status->getStyles($order->status); @endphp
                        <div class="border-2 {{ $styles['border'] }} {{ $styles['bg'] }} {{ $styles['opacity'] }} p-4 rounded-xl text-center transition-all">
                            <p class="text-[10px] font-bold {{ $styles['text'] }} uppercase tracking-wider">{{ $status->value }}</p>
                            @if ($status->stepLevel() <= $order->status->stepLevel() && $order->status !== App\Enums\OrderStatus::CANCELLED)
                                <p class="text-[9px] {{ $styles['text'] }} mt-1">Completed</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Content -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="md:col-span-2 glass-card p-8">
                    <h2 class="text-lg font-bold mb-6">Items</h2>
                    <div class="space-y-6">
                        @foreach ($order->items as $item)
                            <div class="flex justify-between items-center">
                                <p class="text-gray-700">
                                    {{ $item->product->title }} 
                                    <span class="text-gray-400 mx-2">×</span> 
                                    {{ $item->quantity }}
                                </p>
                                <p class="font-semibold">${{ number_format($item->price * $item->quantity, 2) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="glass-card p-8 h-fit"> 
                    <h2 class="text-lg font-bold mb-6">Order summary</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                        {{-- <div class="flex justify-between text-gray-600">
                            <span>Delivery</span>
                            <span>${{ number_format($order->delivery_fee, 2) }}</span>
                        </div> --}}
                        <hr class="border-gray-200">
                        <div class="flex justify-between items-center pt-2">
                            <span class="font-bold text-lg">Total</span>
                            <span class="font-bold text-xl text-rose-600">${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endforeach
</div>

</body>

</html>
