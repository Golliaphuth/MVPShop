<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\CustomerLoginRequest;
use App\Http\Requests\Front\CustomerRegistrationRequest;
use App\Models\Customer;
use App\Services\ICartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::guard('web')->check()) return redirect()->route('home');
        return view('auth.login');
    }

    public function authenticate(CustomerLoginRequest $request, ICartService $service): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->except('_token');
        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();
            $service->setCartCustomer();
            return response()->json('ok', 200);
        }

        return response()->json([
            'message' => __('auth.failed')
        ], 403);
    }

    public function registration(CustomerRegistrationRequest $request): \Illuminate\Http\JsonResponse
    {
        $customerData = $request->all();
        $customerData['password'] = Hash::make($customerData['password']);
        $customer = Customer::create($customerData);
        auth()->guard('web')->login($customer);
        return response()->json('ok', 200);
    }

    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        return back();
    }
}
