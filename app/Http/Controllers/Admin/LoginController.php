<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::guard('admin')->check()) return redirect()->route('admin.dashboard');
        return view('admin.auth.login');
    }

    public function authenticate(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $credentials = $request->except('_token');
        if (Auth::guard('admin')->attempt($credentials, true)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'auth' => 'Не верный логин/пароль!',
        ]);
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
