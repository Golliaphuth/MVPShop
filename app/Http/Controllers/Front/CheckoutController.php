<?php

namespace App\Http\Controllers\Front;

use App\Services\CartService;
use App\Services\ICartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends MainController
{
    public function index(Request $request, ICartService $service)
    {
        $this->data['items'] = $service->all();
        $this->data['total'] = $service->total();
        $this->data['customer'] = Auth::guard('web')->user();
        return view('front.checkout.index', $this->data);
    }

}
