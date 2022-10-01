<?php

namespace App\Http\Controllers\Payment;

use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MobileMoneyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_no' => 'required|numeric|min:11,max:11',
            'email' => 'required|email',
            'shipping_address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'payment_id' => 'required',
            'transaction_id' => 'required',
        ]);

        $total_price = 0;

        $cartItems = Session::get('cartItem');

        foreach($cartItems as $id => $cartItem)
        {
            $tax = Product::findOrFail($id)->tax;
            $total_price = ($cartItem['product_price'] * $cartItem['product_quantity']) + $tax;
        }

        $order = new Order();
        $order->payment_id = $request->payment_id;
        $order->user_id = Auth::guard('web')->user()->id;
        $order->order_number = Str::random(8);
        $order->transaction_id = $request->transaction_id;
        $order->name = $request->name;
        $order->phone_no = $request->phone_no;
        $order->email = $request->email;
        $order->shipping_address = $request->shipping_address;
        $order->country = $request->country;
        $order->state = $request->state;
        $order->zipecode = $request->zipcode;
        $order->payment_status = 1;
        $order->save();

        foreach($cartItems as $id => $cartItem)
        {
            $order_details = new OrderDetail();
            $order_details->order_id = $order->id;
            $order_details->name = $cartItem['product_name'];
            $order_details->quantity = $cartItem['product_quantity'];
            $order_details->price = ($cartItem['product_quantity'] * $cartItem['product_price']) * currencyValue();
            $tax = Product::findOrFail($id)->tax;
            $order_details->tax =  ($cartItem['product_quantity'] * $tax) * currencyValue();
            $order_details->save();

            $product = Product::findOrFail($id);
            $product->decrement('quantity', $cartItem['product_quantity']); 
        }

        
        $transaction = new Transaction();
        $transaction->user_id = Auth::guard('web')->user()->id;
        $transaction->transaction_id = $order->transaction_id;
        $transaction->amount = $total_price;
        $transaction->remark = 'Order';
        $transaction->type = '+';
        $transaction->save();

        Session::forget('cartItem');

        Mail::to(Auth::guard('web')->user()->email)->send(new OrderMail($order));

        return back()->with('success', 'Payment successfull.');
        // return redirect()->route('order.invoice', $order->id);
    }
}
