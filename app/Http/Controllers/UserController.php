<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(Auth::check()&&Auth::user()->user_type=='admin'){
            return view('admin.dashboard');
        }
        else if(Auth::check()&&Auth::user()->user_type=='user'){
            return view('dashboard');
        }
    }
    public function productDetails($id){
        $product = Product::findOrFail($id);
        return view('productdetails', compact('product'));
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
    public function show()
    {
        // return view('index') with the categories and latest products added to the database;
        $categories = Category::all();
        $products = Product::latest()->take(4)->get();
        return view('index', compact('categories', 'products'));
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
