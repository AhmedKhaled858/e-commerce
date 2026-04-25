<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCart;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // user dashboard function
    public function index()
    {
        if(Auth::check()&&Auth::user()->user_type=='admin'){
            return view('admin.dashboard');
        }
        else if(Auth::check()&&Auth::user()->user_type=='user'){
            return view('dashboard');
        }
    }
    // all products function
     public function allProducts(){
        $cartCount = 0;
        if(Auth::check()){
            $cartCount = ProductCart::where('user_id', Auth::id())->sum('quantity');
        }
        $products = Product::all();
        return view('all-product', compact('products', 'cartCount'));
    }
    // product details function
    public function productDetails($id){
         $cartCount = 0;
        if(Auth::check()){
            $cartCount = ProductCart::where('user_id', Auth::id())->sum('quantity');
        }
        $product = Product::findOrFail($id);
        return view('productdetails', compact('product' ,'cartCount'));
    }
    // add to cart function
    public function addToCart(Request $request){
        $product = Product::findOrFail($request->product_id);
        if($request->quantity > $product->quantity){
            return redirect()->back()->with('error', 'Quantity exceeds available stock.');
        }
        $cart=ProductCart::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
        if($cart){
            $cart->quantity += $request->quantity;
            $cart->save();
        }
        else{
            ProductCart::create([
                'user_id'=>Auth::id(),
                'product_id'=>$request->product_id,
                'quantity'=>$request->quantity
            ]);
        }
        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    // product cart function
    public function productCart(){
         $cartCount = 0;
        if(Auth::check()){
            $cartCount = ProductCart::where('user_id', Auth::id())->sum('quantity');
        }
        $cartItems = ProductCart::where('user_id', Auth::id())->with('product')->get();
        return view('productCart', compact('cartItems', 'cartCount'));
    }

    // remove from cart function
    public function removeFromCart($id){
        $cartItem = ProductCart::findOrFail($id);
        if($cartItem->user_id != Auth::id()){
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
        $cartItem->delete();
        return redirect()->back()->with('success', 'Product removed from cart successfully.');
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
        if(Auth::check()){
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
