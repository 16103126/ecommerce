<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function store(Request $request)
    {
       if(!Auth::check())
       {
           return response()->json(['status' => 'Login please.']);
       }

       $product_name = $request->product_name;
       $id = $request->product_id;
       $product_price = $request->product_price;
       $product_image = $request->product_image;
       $product_quantity = $request->quantity;
       $user = Auth::guard('web')->user()->id;

       
       $cartItem = Session::get('cartItem');

       if(!$cartItem)
       {
           $cartItem = [

               $id => [
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => $product_image,
                'product_quantity' => $product_quantity,
                'user_id'          => $user,
               ]

            ];

            Session::put('cartItem', $cartItem);

            return response()->json(['status' => 'Cart added successfully!']);
       }

       if(isset($cartItem[$id]))
       {
            $cartItem[$id]['product_quantity']++;

            Session::put('cartItem', $cartItem);

            return response()->json(['status' => 'Cart added successfully!']);
       }

       $cartItem[$id] = [
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_quantity' => $product_quantity,
            'user_id'          => $user,
       ];

       Session::put('cartItem', $cartItem);

        return response()->json(['status' => 'Cart added successfully!']);

    }

    public function show()
    {
        $cartItems = Session::get('cartItem');
        // dd($cartItems);
        return view('frontend.cart', compact('cartItems'));
    }

    public function remove($id)
    {
        $cartItem = Session::get('cartItem');
        
        unset($cartItem[$id]);

        Session::put('cartItem', $cartItem);
        
        return back()->with('success', 'Cart remove successfylly');
    }

    public function update(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        $quantity = $product->quantity;

        if($quantity < $request->quantity)
        {
            return back()->with('message', 'Product quantity not more than '.$quantity.'.');
        }

        if($request->quantity < 1)
        {
            return back()->with('message', 'Product quantity not less than 1.');
        }

        if($request->id && $request->quantity)
        {
            $cartItem = Session::get('cartItem');

            if(isset($cartItem[$request->id]))
            {
                $cartItem[$request->id]['product_quantity'] = $request->quantity;

                Session::put('cartItem', $cartItem);

                return back()->with('success', 'Cart item update successfully.');
            }
        }
    }
}
