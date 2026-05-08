<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductCart;
use App\Models\Product;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    //
    public function index()
    {
        $cartItems = ProductCart::where('user_id', Auth::id())->get();
        $cartCount = $cartItems->sum('quantity');
        if ($cartCount == 0) {
            return redirect()->route('product.cart')->with('error', 'Your cart is empty.');
        }
        if ($cartItems->isEmpty()) {
            return redirect()->route('product.cart')->with('error', 'Your cart is empty.');
        }
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $userAddress = UserAddress::where('user_id', Auth::id())->first();
        $defaultAddress = $userAddress ? $userAddress->where('is_default', true)->first() : null;
        return view('checkout', compact('cartItems', 'totalPrice', 'userAddress', 'defaultAddress', 'cartCount'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $cartItems = ProductCart::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('product.cart')->with('error', 'Your cart is empty.');
        }
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        DB::beginTransaction();
        try {
            if ($request->has('save_address')) {
                UserAddress::updateOrCreate(['user_id' => Auth::id(), 'address' => $request->address], ['full_name' => $request->full_name, 'phone_number' => $request->phone, 'city' => $request->city], ['is_defult' => $request->has('save_address') ? true : false]);
            }
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => uniqid('ORD-'),
                'total_amount' => $totalPrice,
                's_full_name' => $request->full_name,
                's_phone_number' => $request->phone,
                's_address' => $request->address,
                's_city' => $request->city,
                'payment_method' => 'cash_on_delivery',
                'status' => 'pending',
            ]);
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                $item->delete();
            }
            DB::commit();
            return redirect()->route('product.cart')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('product.cart')->with('error', $e->getMessage());
        }
    }
}
