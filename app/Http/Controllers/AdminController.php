<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function createCategory(){
        return view('admin.createcategory');
    }
    public function storeCategory(Request $request){
        $category = new \App\Models\Category();
        $category->name = $request->category_name;
        $category->save();
        return redirect()->route('admin.createCategory')->with('success','Category created successfully');
    }
    public function listCategories(){
        $categories = \App\Models\Category::all();
        return view('admin.listcategories', compact('categories'));
    }
}
