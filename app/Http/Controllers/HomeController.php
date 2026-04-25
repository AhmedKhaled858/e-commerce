<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    //
    public function search(Request $request){
        $keyword = $request->search;

    $products = Product::where('title', 'like', "%$keyword%")
        ->orWhere('description', 'like', "%$keyword%")
        ->orWhere('price', 'like', "%$keyword%")
        ->get();

    $categories = Category::where('name', 'like', "%$keyword%")->get();

    return view('admin.search_results', compact('products', 'categories', 'keyword'));
    }
    public function allProducts(){
        $products = Product::all();
        return view('all-product', compact('products'));
    }
}
