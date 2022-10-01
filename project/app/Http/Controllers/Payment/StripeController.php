<?php

namespace App\Http\Controllers\Payment;

use Exception;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Currency;
use App\Models\OrderDetail;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class StripeController extends Controller
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
            'payment_id' => 'required'
        ]);

        if(Session::has('currency'))
        {
            $currency_id = Session::get('currency');
            $currency = Currency::findOrFail($currency_id);
        }

        $currency = Currency::where('is_default', 1)->first();

        if($currency->name != 'USD')
        {
            return back()->with('message', 'Please select a USD currency for this payment.');
        }

        $total_price = 0;

        $cartItems = Session::get('cartItem');

        foreach($cartItems as $id => $cartItem)
        {
            $tax = Product::findOrFail($id)->tax;
            $total_price = ($cartItem['product_price'] * $cartItem['product_quantity']) + $tax;
        }

        $payment = Payment::where('id', $request->payment_id)->first();

        $stripe = Stripe::setApiKey($payment->secret);

        try {

        $token = $stripe->tokens()->create([
            'card' => [
                'number' => $request->card_no,
                'exp_month' => $request->ccExpireMonth,
                'exp_year' => $request->ccExpireYear,
                'cvc' => $request->cvvNumber,
            ],
        ]);

        if (!isset($token['id'])) {
            return back();
        }

        $charge = $stripe->charges()->create([
            'card' => $token['id'],
            'currency' => 'USD',
            'amount' => $total_price * currencyValue(),
            'description' => 'Order',
        ]);
        
        if($charge['status'] == 'succeeded') 
        {

            $order = new Order();
            $order->payment_id = $request->payment_id;
            $order->user_id = Auth::guard('web')->user()->id;
            $order->order_number = Str::random(8);
            $order->transaction_id = Str::random(12);
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

        }else {

            return back()->with('message','Payment not success!!');
        }

        } catch (Exception $e) {

            return back()->with('message', $e->getMessage());

        } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {

            return back()->with('message', $e->getMessage());

        } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {

            return back()->with('message', $e->getMessage());

        }
    }
}
