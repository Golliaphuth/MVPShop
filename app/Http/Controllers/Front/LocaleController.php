<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class LocaleController extends Controller
{
    public function set($locale): \Illuminate\Http\RedirectResponse
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
