<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends MainController
{
    public function index(Request $request)
    {

        return view('front.about.index', $this->data);
    }
}
