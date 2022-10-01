<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::get();

        return view('admin.currency.index', compact('currencies'));
    }

    public function create()
    {
        return view('admin.currency.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:currencies,name',
            'value' => 'required|numeric',
            'sign' => 'required|unique:currencies,sign'
        ]);

        $input = $request->all();

        $currency = new Currency();

        if(!$currency->where('is_default', 1)->exists())
        {
            $currency->is_default = 1;
        }

        $currency->fill($input)->save();

        return back()->with('success', 'Currency added successfully.');
    }

    public function edit($id)
    {
        $currency = Currency::findOrFail($id);

        return view('admin.currency.edit', compact('currency'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:currencies,name,'.$id,
            'value' => 'required|numeric',
            'sign' => 'required|unique:currencies,sign,'.$id,
        ]);

        $input = $request->all();

        $currency = Currency::findOrFail($id);

        $currency->fill($input)->update();

        return back()->with('success', 'Currency update successfully.');
        
    }

    public function delete($id)
    {
        $currency = Currency::findOrFail($id);

        if($currency->is_default == 1)
        {
            return back()->with('message', 'Default currency can not delete.');
        }

        $currency->delete();

        return back()->with('success', 'Currency deleted successfully.');
    }

    public function status($id1, $id2)
    {
        $currency = Currency::findOrFail($id1);

        $currency->is_default = $id2;
        $currency->update();

        $currency = Currency::where('id', '!=', $id1)->update(['is_default' => 0]);

        return back()->with('success', 'Status update successfully.');
    }
}
