<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $user = Auth::guard('web')->user();

        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {;
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'about' => 'required'
        ]);

        $user = Auth::guard('web')->user();
       

        if($file = $request->file('image')){
            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/user/image/profile', $imageName);

            if($user->image){
                if(file_exists('assets/user/image/profile/'.$user->image)){
                    @unlink('assets/user/image/profile/'.$user->image);
                }
            }

            $request->image = $imageName;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->about = $request->about;
        $user->image = $request->image;
        $user->update();

        return back()->with('success', 'Profile update successfully.');

    }

    public function resetPassword($id)
    {
        $user = Auth::guard('web')->user();

        return view('user.profile.password-reset', compact('user'));
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'curr_password' => 'required',
            'new_password' => 'required|same:password_confirmation'
        ]);

        $user = Auth::guard('web')->user();

        if(!Hash::check($request->curr_password, $user->password))
        {
            return back()->with('message', 'Current password does not match');
        }

        if(Hash::check($request->new_password, $user->password))
        {
            return back()->with('message', 'Don not use old password.');
        }

        $user->password = Hash::make($request->new_password);
        $user->update();

        return back()->with('success', 'Password reset successfully.');
    }
}
