<?php

namespace App\Http\Controllers\Front;

use App\Services\ICartService;
use Illuminate\Http\Request;

class CartController extends MainController
{
    public $service;

    public function __construct(ICartService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function index()
    {
        $this->data['items'] = $this->service->all();
        return view('front.cart.index', $this->data);
    }

    public function all(): \Illuminate\Http\JsonResponse
    {
        $products = $this->service->all();
        return response()->json($products, 200);
    }

    public function add(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->service->addProduct($request->get('product_id'), $request->get('quantity'));
        return response()->json('ok', 200);
    }

    public function remove(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->service->removeProduct($request->get('product_id'));
        return response()->json('ok', 200);
    }

    public function quantity(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->service->quantity($request->get('product_id'), $request->get('quantity'));
        return response()->json('ok', 200);
    }

}
