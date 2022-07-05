<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\Front\CheckoutRequest;
use App\Services\Cart\ICartService;
use App\Services\Deliveries\IDeliveryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends MainController
{
    public $delivery;

    public function __construct(IDeliveryService $delivery)
    {
        parent::__construct();
        $this->delivery = $delivery;
    }

    public function index(Request $request, ICartService $service)
    {
        $this->data['cart'] = $service->all();
        $this->data['total'] = $service->total();
        $this->data['customer'] = Auth::guard('web')->user();
        return view('front.checkout.index', $this->data);
    }

    public function getCity(Request $request): \Illuminate\Http\JsonResponse
    {
        $citiesRaw = $this->delivery->searchCity($request->get('query'));
        $cities = [];
        foreach ($citiesRaw as $city) {
            $cities[] = [
                'id' => $city->Ref,
                'text' => $city->Present
            ];
        }
        return response()->json($cities, 200);
    }

    public function getStreet(Request $request): \Illuminate\Http\JsonResponse
    {
        $streetsRaw = $this->delivery->searchStreet($request->get('query'), $request->get('city_ref'));
        $streets = [];
        foreach ($streetsRaw as $street) {
            $streets[] = [
                'id' => $street->SettlementStreetRef,
                'text' => $street->Present
            ];
        }
        return response()->json($streets, 200);
    }

    public function getWarehouse(Request $request): \Illuminate\Http\JsonResponse
    {
        $warehousesRaw = $this->delivery->searchWarehouse($request->get('query'), $request->get('city_ref'));
        $warehouses = [];
        foreach ($warehousesRaw as $warehouse) {
            $warehouses[] = [
                'id' => $warehouse->Ref,
                'text' => $warehouse->Description
            ];
        }
        return response()->json($warehouses, 200);
    }

    public function checkout(CheckoutRequest $request)
    {

    }

}
