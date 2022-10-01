<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request)
    {;
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'about' => 'required'
        ]);

        $admin = Auth::guard('admin')->user();
       

        if($file = $request->file('image')){
            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/admin/image/profile', $imageName);

            if($admin->image){
                if(file_exists('assets/admin/image/profile/'.$admin->image)){
                    @unlink('assets/admin/image/profile/'.$admin->image);
                }
            }

            $request->image = $imageName;
        }

        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->about = $request->about;
        $admin->image = $request->image;
        $admin->update();

        return back()->with('success', 'Profile update successfully.');

    }

    public function resetPassword($id)
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile.password-reset', compact('admin'));
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'curr_password' => 'required',
            'new_password' => 'required|same:password_confirmation'
        ]);

        $admin = Auth::guard('admin')->user();

        if(!Hash::check($request->curr_password, $admin->password))
        {
            return back()->with('message', 'Current password does not match');
        }

        if(Hash::check($request->new_password, $admin->password))
        {
            return back()->with('message', 'Don not use old password.');
        }

        $admin->password = Hash::make($request->new_password);
        $admin->update();

        return back()->with('success', 'Password reset successfully.');
    }
}
