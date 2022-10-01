<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function edit($id)
    {
        $data = Seo::findOrFail($id);
        return view('admin.seo.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'meta_keyword' => 'required',
            'meta_description' => 'required'
        ]);

        $data = Seo::findOrFail($id);

        $input = $request->all();

        $data->fill($input)->update();

        return back()->with('success', 'Seo update successfully.');
    }
}
