<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->where('status', 1)->first();
        $categories = Category::where('status', 1)->get();
    
        return view('frontend.category', compact('category', 'categories'));
    }
}
