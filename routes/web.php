<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

Route::get('/', [UserController::class, 'show'])->name('index');
Route::get('/product_details/{id}', [UserController::class, 'productDetails'])->name('product_details');

Route::get('/dashboard',[UserController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->group(function(){
    // Route::get('/test',[AdminController::class,'test']);
    Route::get('/createCategory',[AdminController::class,'createCategory'])->name('admin.createCategory');
    Route::post('/storeCategory',[AdminController::class,'storeCategory'])->name('admin.storeCategory');
    Route::get('/listCategories',[AdminController::class,'listCategories'])->name('admin.listCategories');
    Route::delete('/deleteCategory/{id}',[AdminController::class,'deleteCategory'])->name('admin.deleteCategory');
    Route::post('/editCategory/{id}',[AdminController::class,'editCategory'])->name('admin.editCategory');
    Route::get('/addProduct',[AdminController::class,'addProduct'])->name('admin.addProduct');
    Route::post('/storeProduct',[AdminController::class,'storeProduct'])->name('admin.storeProduct');
    Route::get('/ViewProducts',[AdminController::class,'ViewProducts'])->name('admin.ViewProducts');
    Route::delete('/deleteProduct/{id}',[AdminController::class,'deleteProduct'])->name('admin.deleteProduct');
    Route::post('/editProduct/{id}',[AdminController::class,'editProduct'])->name('admin.editProduct');
});

require __DIR__.'/auth.php';
