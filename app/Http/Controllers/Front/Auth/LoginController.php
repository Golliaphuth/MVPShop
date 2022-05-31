<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::guard('web')->check()) return redirect()->route('home');
        return view('auth.login');
    }

    public function authenticate(UserLoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->except('_token');
        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();
            return response()->json('ok', 200);
        }

        return response()->json([
            'message' => __('auth.failed')
        ], 403);
    }

    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        $request->session()->regenerate();
        return back();
    }
}
