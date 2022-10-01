<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addWishlist(Request $request)
    {
        $user = Auth::guard('web')->user();

        if(!$user)
        {
            return back()->with('message', 'Please, login first.');
        }

        $isWishlist = Wishlist::where('user_id', $user->id)->where('product_id', $request->product_id)->first();

        if($isWishlist)
        {
            return back()->with('message', 'You already added wishlist.');
        }

        $wishlist = new Wishlist();
        $wishlist->product_id = $request->product_id;
        $wishlist->user_id = $user->id;
        $wishlist->save();

        return back()->with('success', 'Wishlist added successfully.');
    }

    public function wishlist()
    {
        $user = Auth::guard('web')->user();

        if(!$user)
        {
            return back()->with('status', 'Please, login.');
        }

        $wishlists = Wishlist::where('user_id', $user->id)->get();

        return view('frontend.wishlist', compact('wishlists'));
    }

    public function removeWishlist($id)
    {
        $wishlist = Wishlist::findOrFail($id);

        $wishlist->delete();

        return back()->with('message', 'Wishlist remove successfully.');
    }
}
