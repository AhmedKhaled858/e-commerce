<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function search(Request $request)
        {
            $user = Auth::user();
            $keyword = $request->search;

            $products = Product::whereRaw('MATCH(title, description) AGAINST(? IN BOOLEAN MODE)', [$keyword])
                ->orWhere('title', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%")
                ->get();

            $categories = Category::whereRaw('MATCH(name) AGAINST(? IN BOOLEAN MODE)', [$keyword])
                ->orWhere('name', 'like', "%$keyword%")
                ->get();
            // SAFE ROLE CHECK
            if ($user && $user->user_type == UserType::Admin) {
                return view('admin.search_results', compact('products', 'categories', 'keyword'));
            }

            return view('search', compact('products', 'categories', 'keyword'));
        }
    public function whyUs()
        {
            return view('why');
        }
    public function shop()
        {
            $products = Product::latest()->paginate(12);
            return view('shop', compact('products'));
        }
    public function testimonial()
        {
            return view('testimonial');
        }
}
