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

    $products = Product::whereRaw("MATCH(title, description) AGAINST(? IN BOOLEAN MODE)", [$keyword])
    ->orWhere('title', 'like', "%$keyword%")
    ->orWhere('description', 'like', "%$keyword%")
    ->get();

    $categories = Category::whereRaw("MATCH(name) AGAINST(? IN BOOLEAN MODE)", [$keyword])
    ->orWhere('name', 'like', "%$keyword%")
    ->get();

    return view('admin.search_results', compact('products', 'categories', 'keyword'));
    }
    public function whyUs(){
        return view('why');
    }
   
}
