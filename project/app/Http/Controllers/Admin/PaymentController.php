<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::get();

        return view('admin.payment.index', compact('payments'));
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);

        return view('admin.payment.edit', compact('payment'));
    }

    private function setEnv($key, $value)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' .env($key),
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }

    public function paymentConfig($input)
    {
        $this->setEnv('STRIPE_KEY', $input['key']);
        $this->setEnv('STRIPE_SECRET', $input['secret']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'key' => 'required',
            'secret' => 'required'
        ]);

        $input = $request->all();  

        $payment = Payment::findOrFail($id);

        $payment->fill($input)->save();

        $this->paymentConfig($input);

        return back()->with('success', 'Payemnt update successfully.');
        
    }

    public function status($id1, $id2)
    {
        $payment = Payment::findOrFail($id1);

        $payment->status = $id2;
        $payment->update();

        return back()->with('success', 'Status updated successfully.');
    }
}
