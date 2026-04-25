<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //
    public function store(Request $request){
        $data=[
            'product_id'=>$request->product_id,
            'user_id'=>Auth::id(),
            'rating'=>$request->rating,
            'review'=>$request->review,
            'status'=>0
        ];
        Review::create($data);
        return redirect()->back()->with('success', 'Review submitted successfully and is pending approval.');

    }
}
