<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);

        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $input = $request->all();

        $role = new Role();

        if(!empty($request->permission))
        {
            $input['permission'] = implode(', ', $request->permission);
        }else{
            $input['permission'] = '';
        }

        $role->fill($input)->save();

        return back()->with('success', 'Role save successfully');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('admin.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $input = $request->all();

        $role = Role::findOrFail($id);

        if(!empty($request->permission))
        {
            $input['permission'] = implode(', ', $request->permission);
        }else{
            $input['permission'] = '';
        }

        $role->fill($input)->update();

        return back()->with('success', 'Role update successfully');
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);
        
        $role->delete();

        return back()->with('success', 'Role deleted successfully.');
    }
}
