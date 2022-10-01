<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FrontendLanguage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class FrontendLanguageController extends Controller
{
    public function index()
    {
        $languages = FrontendLanguage::paginate(10);

        return view('admin.frontend-language.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.frontend-language.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required|unique:frontend_languages,language',
        ]);

        $data = new FrontendLanguage();

        $data->name = time().Str::random(8);
        $data->file = $data->name.'.json';

        if($data->count() < 1)
        {
            $data->is_default = 1;
        }

        $data->language = $request->language;
        $data->save();

        $new = [];

        $keys = $request->keys;
        $values = $request->values;

        foreach(array_combine($keys, $values) as $key => $value)
        {
            $n = str_replace('-', ' ', $key);
            $new[$n] = $value;
        }

        $myData = json_encode($new);

        file_put_contents(resource_path().'/lang/'.$data->file, $myData);

        return back()->with('success', 'Language Add successfully!');
    }

    public function edit($id)
    {
        $language = FrontendLanguage::findOrFail($id);

        $data = file_get_contents(resource_path().'/lang/'.$language->file);

        $lang = json_decode($data);

        return view('admin.frontend-language.edit', compact('language', 'lang'));
    }

    public function update(Request $request, $id)
    {
        $language = FrontendLanguage::findOrFail($id);

        $language->language = $request->language;
        $language->name = time().Str::random(8);
        $language->file = $language->name.'.json';

        $language->update();

        $new = [];

        $values = $request->values;
        $keys = $request->keys;

        foreach(array_combine($keys, $values) as $key => $value)
        {
            $n = str_replace('_', ' ', $key);
            $new[$n] = $value;
        }

        $myData = json_encode($new);

        if(File::exists(base_path('resources/lang/'.$language->file)))
        {
            File::delete(base_path('resources/lang/'.$language->file));
        }

        file_put_contents(resource_path().'/lang/'.$language->file, $myData);

        return back()->with('success', 'Language update successfully.');

    }

    public function status($id1, $id2)
    {
        $language = FrontendLanguage::findOrFail($id1);

        $language->is_default = $id2;
        $language->update();

        $language = FrontendLanguage::where('id', '!=', $id1)->update(['is_default' => 0]);

        return back()->with('success', 'Status update successfully.');
    }

    public function delete($id)
    {
        $language = FrontendLanguage::findOrFail($id);

        if($language->is_default == 1)
        {
            return back()->with('message', 'You can not delete default language.');
        }

        if($language->count() < 2)
        {
            return back()->with('message', 'You can not deleted language.');
        }

        if(File::exists(base_path('resources/lang/'.$language->file)))
        {
            File::delete(base_path('resources/lang/'.$language->file));
        }

        Session::forget('language');

        $language->delete();


        if(file_exists(resource_path().'/lang/'.$language->file)){
            @unlink(file_exists(resource_path().'/lang/'.$language->file));
        }

        return back()->with('success', 'Language Deleted Su ccessfully.');
    }
}
