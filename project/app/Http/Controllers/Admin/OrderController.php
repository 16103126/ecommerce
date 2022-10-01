<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function allOrder()
    {
        $orders = Order::paginate(10);

        return view('admin.order.all-order', compact('orders'));
    }

    public function search()
    {
        return view('admin.order.search');
    }

    public function orderDetails($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.order.detail', compact('order'));
    }

    public function pendingOrder()
    {
        $orders = Order::where('status', 0)->paginate(10);

        return view('admin.order.pending', compact('orders'));
    }

    public function completeOrder()
    {
        $orders = Order::where('status', 1)->paginate(10);

        return view('admin.order.complete', compact('orders'));
    }

    public function status($id1, $id2)
    {
        $order = Order::findOrFail($id1);

        $order->status = $id2;
        $order->update();

        return back()->with('success', 'status update successfully.');
    }

}
