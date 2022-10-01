<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    public function index()
    {
        return view('admin.dashboard');
    }

    public function language($id)
    {
        Session::put('adminlanguage', $id);

        return back();
    }
}
