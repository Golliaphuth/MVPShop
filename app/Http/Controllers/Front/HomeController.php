<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends MainController
{
    public function index()
    {
        return view('front.index', $this->data);
    }
}
