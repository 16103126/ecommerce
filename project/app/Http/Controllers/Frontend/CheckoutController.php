<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if(!Session::has('cartItem'))
        {
            return redirect()->route('cart.show');
        }
        
        $user = Auth::user();
        $payments = Payment::where('status', 1)->get();
        return view('frontend.checkout', compact('user','payments'));
    }
}
