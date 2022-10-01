<?php

namespace App\Http\Controllers\User;

use App\Mail\Email;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $remember_me = $request->has('remember_me') ? true : false;

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember_me)){

            return redirect()->route('user.dashboard.index');
        }

        return back()->with('message', 'Your email or password is invalid.');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        
        return redirect()->route('user.login.form');
    }

    public function forgotFormShow()
    {
        return view('user.auth.forgot');
    }

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();
        
        if(!$user)
        {
            return back()->with('message', 'Invalid email address. Please, try again.');
        }

        $token = md5($request->email);
        $user->token = $token;
        $user->update();

        Mail::to($user->email)->send(new Email($token));
        
        return back()->with('success', 'Token sent successfully. Please, check your email.');
    }

    public function passwordResetForm($token)
    {
        $user = User::where('token', $token)->first();

        return view('user.auth.password-reset', compact('user'));
    }

    public function passwordReset(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|max:20|confirmed'
        ]);

        $user = User::where('token', $request->token)->first();

        $user->password = Hash::make($request->password);
        $user->token = null;
        $user->update();

        return redirect()->route('user.login.form')->with('success', 'Your password reset successfully. Please, login.');
    }
}
