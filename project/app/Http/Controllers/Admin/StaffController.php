<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Admin::where('id', '!=', 1)->where('id', '!=', Auth::guard('admin')->user()->id)->paginate(10);

        return view('admin.staff.index', compact('staffs'));
    }

    public function create()
    {
        $roles = Role::get();

        return view('admin.staff.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        $input = $request->all();

        $staff = new Admin();

        $input['password'] = Hash::make($request->password);

        $staff->fill($input)->save();

        return back()->with('success', 'Staff added successfully.');
    }

    public function edit($id)
    {
        $staff = Admin::findOrFail($id);

        $roles = Role::get();

        return view('admin.staff.edit', compact('staff', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,
            'role_id' => 'required'
        ]);

        $input = $request->all();

        $staff = Admin::findOrFail($id);

        $staff->fill($input)->update();

        return back()->with('success', 'Staff update successfully.');
    }

    public function delete($id)
    {
        $staff = Admin::findOrFail($id);

        $staff->delete();

        return back()->with('success', 'Staff deleted successfully.');
    }
}
