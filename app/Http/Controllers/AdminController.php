<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    //! start functions for category
    public function createCategory()
    {
        return view('admin.createcategory');
    }
    public function storeCategory(Request $request)
    {
        $category = new Category();
        $category->name = $request->category_name;
        $category->save();
        return redirect()->route('admin.createCategory')->with('success', 'Category created successfully');
    }
    public function listCategories()
    {
        $categories = Category::all();
        return view('admin.listcategories', compact('categories'));
    }
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return redirect()->route('admin.listCategories')->with('success', 'Category deleted successfully');
        }
        return redirect()->route('admin.listCategories')->with('error', 'Category not found');
    }
    public function editCategory(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update([
            'name' => $request->input('category_name'),
        ]);
        $category->save();
        return redirect()->route('admin.listCategories')->with('success', 'Category updated successfully');
    }
    //?end functions for category

    //! start functions for product
    public function addProduct()
    {
        $categories = Category::all();
        return view('admin.addproduct', compact('categories'));
    }
    // store product function with image upload

    public function storeProduct(StoreProductRequest $request)
    {
        $data = [
            'title' => $request->product_title,
            'description' => $request->product_description,
            'quantity' => $request->product_quantity,
            'price' => $request->product_price,
            'category_id' => $request->product_category,
        ];

        if ($request->hasFile('product_image')) {
            $data['product_image'] = $request->file('product_image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.addProduct')->with('success', 'Product created successfully');
    }
    // view products function with pagination
    public function ViewProducts()
    {
        $products = Product::with('category:id,name')->select('id', 'title', 'description', 'quantity', 'price', 'product_image', 'category_id')->paginate(10);
        $categories = Category::all();

        return view('admin.viewproducts', compact('products', 'categories'));
    }
    // delete product function
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $imagePath = public_path($product->product_image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        if ($product) {
            $product->delete();
            return redirect()->route('admin.ViewProducts')->with('success', 'Product deleted successfully');
        }
        return redirect()->route('admin.ViewProducts')->with('error', 'Product not found');
    }
    // edit product function
    public function editProduct(UpdateProductRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $data = [
                'title' => $request->product_title,
                'description' => $request->product_description,
                'quantity' => $request->product_quantity,
                'price' => $request->product_price,
                'category_id' => $request->product_category,
            ];

            if ($request->hasFile('product_image')) {
                $imagePath = public_path($product->product_image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $data['product_image'] = $request->file('product_image')->store('products', 'public');
            }
            $product->update($data);

            return redirect()->route('admin.ViewProducts')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.ViewProducts')
                ->with('error', 'An error occurred while updating the product: ' . $e->getMessage());
        }
    }
    //? end functions for product
    // view orders function
    public function ViewOrders()
    {
        $orders = Order::with(['user', 'items.product'])
            ->orderBy('created_at', 'asc')
            ->paginate(5);

        return view('admin.vieworder', compact('orders'));
    }
    // order details function
    public function OrderDetails($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orderdetails', compact('order'));
    }
    // update order status function
    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.OrderDetails', ['id' => $id])->with('success', 'Order status updated successfully');
    }
}
