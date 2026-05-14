<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCart;
use App\Enums\UserType;
use App\Models\Order;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // user dashboard function
    public function index()
    {
        $user = Auth::user();
        $users_count=User::count();
        $new_order_count=Order::where('status',OrderStatus::PENDING)->count();
        $orders_count=Order::count();
        $orders=Order::where('user_id',Auth::id())->with('items.product')->get();


      
        if ($user->user_type == UserType::Admin) {
            return view('admin.dashboard',compact('users_count','new_order_count','orders_count'));
        }
        if ($user->user_type == UserType::User) {
            //   dd($orders->toArray());
            return view('dashboard',compact('orders'));
        }
    }
        // contact us function
        public function contactUs()
        {
            return view('contact_us');
        }
     
    // all products function
    public function allProducts()
    {
        $cartCount = 0;
        if (Auth::check()) {
            $cartCount = ProductCart::where('user_id', Auth::id())->sum('quantity');
        }
        $products = Product::all();
        return view('all-product', compact('products', 'cartCount'));
    }
    // product details function
    public function productDetails($id)
    {
        $cartCount = 0;
        if (Auth::check()) {
            $cartCount = ProductCart::where('user_id', Auth::id())->sum('quantity');
        }
        $product = Product::findOrFail($id);
        return view('productdetails', compact('product', 'cartCount'));
    }
    // add to cart function
    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to add products to cart.');
        } elseif ($request->quantity < 1) {
            return redirect()->back()->with('error', 'Quantity must be at least 1.');
        }

        $product = Product::findOrFail($request->product_id);
        if ($request->quantity > $product->quantity) {
            return redirect()->back()->with('error', 'Quantity exceeds available stock.');
        }
        $cart = ProductCart::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            ProductCart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }
        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    // product cart function
    public function productCart()
    {
        $cartCount = 0;
        if (Auth::check()) {
            $cartCount = ProductCart::where('user_id', Auth::id())->sum('quantity');
        }
        $cartItems = ProductCart::where('user_id', Auth::id())->with('product')->get();
        return view('productCart', compact('cartItems', 'cartCount'));
    }

    // remove from cart function
    public function removeFromCart($id)
    {
        $cartItem = ProductCart::findOrFail($id);
        if ($cartItem->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
        $cartItem->delete();
        return redirect()->back()->with('success', 'Product removed from cart successfully.');
    }

    // update cart function
    public function updateQuantity(Request $request, $id)
    {
        try {
            $cartItem = ProductCart::with('product')->findOrFail($id);

            if ($request->action == 'increase') {
                if ($cartItem->quantity + 1 > $cartItem->product->quantity) {
                    return response()->json(
                        [
                            'error' => 'Quantity exceeds available stock.',
                        ],
                        400,
                    );
                }

                $cartItem->quantity += 1;
            } elseif ($request->action == 'decrease') {
                if ($cartItem->quantity > 1) {
                    $cartItem->quantity -= 1;
                }
            }

            $cartItem->save();

            $itemTotal = $cartItem->quantity * $cartItem->product->price;

            $grandTotal = ProductCart::where('user_id', Auth::id())
                ->with('product')
                ->get()
                ->sum(function ($item) {
                    return $item->quantity * $item->product->price;
                });

            return response()->json([
                'quantity' => $cartItem->quantity,

                'itemTotal' => $itemTotal,

                'grandTotal' => $grandTotal,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the cart.'], 500);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    // function to show the home page with the categories and latest products added to the database;
    public function show()
    {
        // return view('index') with the categories and latest products added to the database;
        $cartCount = 0;
        if (Auth::check()) {
            $cartCount = ProductCart::where('user_id', Auth::id())->sum('quantity');
        }
        $categories = Category::all();
        $products = Product::latest()->take(4)->get();
        return view('index', compact('categories', 'products', 'cartCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
