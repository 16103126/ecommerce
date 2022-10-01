<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function index()
    {
        $trendingProducts = Product::where('status', 1)->where('trending', 1)->take(15)->get();
        $categories = Category::get();
        return view('frontend.index', compact('trendingProducts', 'categories'));
    }

    public function language($id)
    {
        Session::put('language', $id);
        return back();
    }

    public function currency($id)
    {
        Session::put('currency', $id);
        return back();
    }
}
