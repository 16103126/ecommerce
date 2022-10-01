<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::guard('web')->user()->id)->paginate(10);

        return view('user.order.index', compact('orders'));
    }

    public function details($id)
    {
        $order = Order::findOrFail($id);

        return view('user.order.details', compact('order'));
    }

    public function orderPDF($id)
    {
        $order = Order::findOrFail($id);
        
        $pdf = PDF::loadView('user.order.pdf', compact('order'));
    
        return $pdf->download('order.pdf');
    }
}
