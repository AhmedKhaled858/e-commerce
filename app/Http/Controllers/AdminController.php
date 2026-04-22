<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminController extends Controller
{
    //
    public function createCategory(){
        return view('admin.createcategory');
    }
    public function storeCategory(Request $request){
        $category = new Category();
        $category->name = $request->category_name;
        $category->save();
        return redirect()->route('admin.createCategory')->with('success','Category created successfully');
    }
    public function listCategories(){
        $categories =Category::all();
        return view('admin.listcategories', compact('categories'));
    }
    public function deleteCategory($id){
        $category=Category::find($id);
        if($category){
            $category->delete();
            return redirect()->route('admin.listCategories')->with('success','Category deleted successfully');
        }
        return redirect()->route('admin.listCategories')->with('error','Category not found');
    }
    public function editCategory(Request $request, $id){
        $category=Category::find($id);
        $category->update([
            'name' => $request->input('category_name')
        ]);
        $category->save();
        return redirect()->route('admin.listCategories')->with('success','Category updated successfully');
    }
}
