<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function details($slug)
    {
        $product = Product::where('slug', $slug)
                            ->where('status', 1)
                            ->first();
        $comment = Comment::where('user_id', Auth::guard('web')->user()->id)->where('product_id', $product->id)->first();

        return view('frontend.product-details', compact('product', 'comment'));
    }
}
