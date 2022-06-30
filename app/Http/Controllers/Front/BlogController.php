<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends MainController
{
    public function index(Request $request)
    {

        return view('front.blog.index', $this->data);
    }
}
