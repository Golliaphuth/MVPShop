<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class DashboardController extends AdminController
{
    public function index(Request $request)
    {

        return view('admin.home');
    }
}
