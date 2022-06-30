<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactsController extends MainController
{
    public function index(Request $request)
    {

        return view('front.contacts.index', $this->data);
    }
}
