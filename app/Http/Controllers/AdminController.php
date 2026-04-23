<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class AdminController extends Controller
{
    //
    //! start functions for category
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
    //?end functions for category

    //! start functions for product
    public function addProduct(){
        $categories = Category::all();
        return view('admin.addproduct', compact('categories'));
    }
    // store product function with image upload
    public function storeProduct(StoreProductRequest $request){
      $product = new Product();
      $product->title = $request->input('product_title');
      $product->description = $request->input('product_description');
      $product->quantity = $request->input('product_quantity');
      $product->price = $request->input('product_price');
      $image=$request->file('product_image');
     if($image){
        $imageName= time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images/products'), $imageName);
        $product->product_image = 'images/products/'.$imageName;
     }

      $product->category_id = $request->input('product_category');
      $product->save();
      return redirect()->route('admin.addProduct')->with('success','Product created successfully');
    }
    // view products function with pagination
    public function ViewProducts(){
       $products = Product::with('category:id,name')
        ->select(
            'id',
            'title',
            'description',
            'quantity',
            'price',
            'product_image',
            'category_id'
        )
        ->paginate(10);
        $categories = Category::all();

    return view('admin.viewproducts', compact('products', 'categories'));
    }
    // delete product function
    public function deleteProduct($id){
        $product=Product::find($id);
        if($product){
            $product->delete();
            return redirect()->route('admin.ViewProducts')->with('success','Product deleted successfully');
        }
        return redirect()->route('admin.ViewProducts')->with('error','Product not found');
    }
     // edit product function
     public function editProduct(StoreProductRequest $request, $id){
        $product=Product::find($id);
         $image=$request->file('product_image');
     if($image){
        $imageName= time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images/products'), $imageName);
        
     }
        $product->update([
            'title' => $request->input('product_title'),
            'description' => $request->input('product_description'),
            'quantity' => $request->input('product_quantity'),
            'price' => $request->input('product_price'),
            'product_image' => $image ? 'images/products/'.$imageName : $product->product_image,
            
            'category_id' => $request->input('product_category')
        ]);
        $product->save();
        return redirect()->route('admin.ViewProducts')->with('success','Product updated successfully');
    }
     //? end functions for product
}
