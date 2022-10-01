<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function userList()
    {
        $users = User::get();
        return view('admin.user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'image' => 'mimes:jpg,png,jpeg'
        ]);

        $user = User::findOrFail($id);

        $input = $request->all();

        if($file = $request->file('image')){

            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/user/img/users/', $imageName);

            if($user->image){
                if(file_exists('assets/user/img/users/'.$user->image)){
                    @unlink('assets/user/img/users/'.$user->image);
                }
            }

            $input['image'] = $imageName;
        }

        $user->fill($input)->save();

        return back()->with('success', 'User Information update successfully.');

    }

    public function status($id1, $id2)
    {
        $user = User::findOrFail($id1);
        $user->status = $id2;
        $user->update();
        return back()->with('success', 'status update successfully.');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
