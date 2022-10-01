<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function favicon($id)
    {
        $favicon = Setting::findOrFail($id);
        
        return view('admin.setting.favicon', compact('favicon'));
    }

    public function faviconUpdate(Request $request, $id)
    {
        $request->validate([
            'favicon' => 'image|mimes:jpg,jpeg,png'
        ]);

        $favicon = Setting::findOrFail($id);

        $file = $request->file('favicon');
        $faviconName = time().str_replace(' ', '', $file->getClientOriginalName());
        $file->move('assets/admin/images/favicon', $faviconName);

        if($favicon->favicon)
        {
            if(File::exists('assets/admin/images/favicon/'.$favicon->favicon))
            {
                File::delete('assets/admin/images/favicon/'.$favicon->favicon);
            }
        }

        $favicon->favicon = $faviconName;
        $favicon->update();

        return back()->with('success', 'Favicon updated successfully.');
        
    }

    public function logo($id)
    {
        $logo = Setting::findOrFail($id);
        return view('admin.setting.logo', compact('logo'));
    }

    public function logoUpdate(Request $request, $id)
    {
        $request->validate([
            'logo' => 'image|mimes:jpg,jpeg,png'
        ]);

        $logo = Setting::findOrFail($id);

        $file = $request->file('logo');
        $logoName = time().str_replace(' ', '', $file->getClientOriginalName());
        $file->move('assets/admin/images/logo', $logoName);

        if($logo->logo)
        {
            if(File::exists('assets/admin/images/logo/'.$logo->logo))
            {
                File::delete('assets/admin/images/logo/'.$logo->logo);
            }
        }

        $logo->logo = $logoName;
        $logo->update();

        return back()->with('success', 'Logo updated successfully.');
        
    }

    public function brandText($id)
    {
        $brandText = Setting::findOrFail($id);

        return view('admin.setting.brand-text', compact('brandText'));
    }

    public function brandTextUpdate(Request $request, $id)
    {
        $request->validate([
            'brand_text' => 'max:10',
        ]);

        $brandText = Setting::findOrFail($id);

        $brandText->brand_text = $request->brand_text;
        $brandText->update();

        return back()->with('success', 'Brand text updated successfully.');
    }

    public function frontendTitle($id)
    {
        $title = Setting::findOrFail($id);

        return view('admin.setting.frontend-title', compact('title'));
    }

    public function frontendTitleUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'max:50',
        ]);

        $title = Setting::findOrFail($id);

        $title->frontend_title = $request->title;
        $title->update();

        return back()->with('success', 'Frontend title updated successfully.');
    }

    public function backendTitle($id)
    {
        $title = Setting::findOrFail($id);

        return view('admin.setting.backend-title', compact('title'));
    }

    public function backendTitleUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'max:50',
        ]);

        $title = Setting::findOrFail($id);

        $title->backend_title = $request->title;
        $title->update();

        return back()->with('success', 'Backend title updated successfully.');
    }

    public function userTitle($id)
    {
        $title = Setting::findOrFail($id);

        return view('admin.setting.user-title', compact('title'));
    }

    public function userTitleUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'max:50',
        ]);

        $title = Setting::findOrFail($id);

        $title->user_title = $request->title;
        $title->update();

        return back()->with('success', 'User title updated successfully.');
    }

}
