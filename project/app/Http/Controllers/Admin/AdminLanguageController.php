<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AdminLanguage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminLanguageController extends Controller
{
    public function index()
    {
        $languages = AdminLanguage::paginate(10);

        return view('admin.admin-language.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.admin-language.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required|unique:admin_languages,language'
        ]);

        $language = new AdminLanguage();

        $language->language = $request->language;
        $name = time().Str::random(8);

        if($language->count() < 1)
        {
            $language->is_default = 1;
        }

        $language->name = $name;
        $language->file = $name.'.json';

        $language->save();

        $new = [];

        $keys = $request->keys;
        $values = $request->values;

        foreach(array_combine($keys, $values) as $key => $value)
        {
            $n = str_replace('_', ' ', $key);
            $new[$n] = $value;
        }

        $myData = json_encode($new);

        file_put_contents(resource_path().'/lang/'.$language->file, $myData);

        return back()->with('success', 'Language added successfully.');
    }

    public function edit($id)
    {
        $language = AdminLanguage::findOrFail($id);
        
        $langFile = file_get_contents(resource_path().'/lang/'.$language->file);
        $langData = json_decode($langFile);

        return view('admin.admin-language.edit', compact('language', 'langData'));
    }

    public function update(Request $request, $id)
    {
        $language = AdminLanguage::findOrFail($id);

        $language->language = $request->language;
        $name = time().Str::random(8);

        if($language->count() < 2)
        {
            $language->is_default = 1;
        }

        $language->name = $name;
        $language->file = $name.'.json';

        $language->update();

        $new = [];

        $keys = $request->keys;
        $values = $request->values;

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

        return back()->with('success', 'Language updated successfully.');
    }

    public function status($id1, $id2)
    {
        $language = AdminLanguage::findOrFail($id1);

        $language->is_default = $id2;
        $language->update();

        $language = AdminLanguage::where('id', '!=', $id1)->update(['is_default' => 0]);

        return back()->with('success', 'Status update successfully.');
    }

    public function delete($id)
    {
        $language = AdminLanguage::findOrFail($id);

        if($language->is_default == 1)
        {
            return back()->with('message', 'You can not delete default language.');
        }

        if($language->count() < 2)
        {
            return back()->with('message', 'You can not deleted language.');
        }

        $language->delete();

        if(File::exists(base_path('resources/lang/'.$language->file)))
        {
            File::delete(base_path('resources/lang/'.$language->file));
        }

        return back()->with('success', 'Language Deleted Successfully.');
    }
}
