<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class OrderController extends AdminController
{
    public function index(Request $request)
    {

        return view('admin.orders.index');
    }
}
