<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('user.auth.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'name'     => 'required|min:5|max:50|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'username' => 'required|min:5|max:50|unique:users',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|max:20|confirmed'
        ];

        $customs = [
            'name.required'     => 'Your name is required.',
            'username.required' => 'Your username is required.',
            'username.unique'   => 'This username is already used.',
            'email.required'    => 'Your email address is required.',
            'email.unique'      => 'This email is already used.',
            'password.required' => 'Password is required'
        ];

        $validate = Validator::make($request->all(), $rules, $customs);
        
        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $input = $request->all();

        $data = new User();
        $input['password'] = Hash::make($request->password);
        $data->fill($input)->save();
        $msg = 'Now, Your are registered. Please, login.';

        return response()->json($msg);
    }
}
