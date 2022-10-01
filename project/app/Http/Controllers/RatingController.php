<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rating(Request $request)
    {
        $user = Auth::guard('web')->user();

        if(!$user)
        {
            return back()->with('message', 'Please, login.');
        }

        if($request->rating == null)
        {
            return back()->with('message', 'Please, submit at lest one rating.');
        }

        if(Rating::where('user_id', $user->id)->where('product_id', $request->product_id)->first())
        {
            return back()->with('message', 'You already submit this product rating.');
        }

        $rating = new Rating();

        $input = $request->all();
        $rating->user_id = $user->id;

        $rating->fill($input)->save();

        return back()->with('success', 'Rating submitted successfully.');

    }
}
