<?php

namespace App\Services\Deliveries;

use App\Models\NPCity;
use App\Models\NPStreet;
use App\Models\NPWarehouse;
use Illuminate\Support\Facades\Http;

class DeliveryNovaPoshta implements IDeliveryService
{

    /**
     *  Магазин посылок         - 6f8c7162-4b72-4b0a-88e5-906948c6a92f
     *  Почтовое отделение      - 841339c7-591a-42e2-8233-7a0a00f0ed6f
     *  Почтомат приват банка   - 95dc212d-479c-4ffb-a8ab-8c1b9073d0bc
     *  Грузовое отделение      - 9a68df70-0267-42a8-bb5c-37f427e36ee4
     *  Почтомат                - f9316480-5f2d-425d-bc2c-ac7cd29decf0
     */

    public function __constructor()
    {

    }

    public function searchCity($query): \Illuminate\Support\Collection
    {
        $response = Http::acceptJson()
            ->post('https://api.novaposhta.ua/v2.0/json/', [
                "apiKey" => env('NOVA_POSHTA_API'),
                "modelName" => "Address",
                "calledMethod" => "searchSettlements",
                "methodProperties" => [
                    "Language" => app()->getLocale(),
                    "CityName" => $query,
                    "Limit" => "5",
                    "Page" => "1",
                ]
            ]);

        if ($response->successful()) {
            if (count($response->json()['data']) > 0) {
                return collect($response->json()['data'][0]['Addresses'])->transform(function ($values) {
                    return new NPCity($values);
                });
            } else {
                return collect([]);
            }
        } else {
            return collect([]);
        }
    }

    public function searchStreet($query, $cityRef): \Illuminate\Support\Collection
    {
        $response = Http::acceptJson()
            ->post('https://api.novaposhta.ua/v2.0/json/', [
                "apiKey" => env('NOVA_POSHTA_API'),
                "modelName" => "Address",
                "calledMethod" => "searchSettlementStreets",
                "methodProperties" => [
                    "Language" => app()->getLocale(),
                    "StreetName" => $query,
                    "SettlementRef" => $cityRef,
                    "Limit" => "10",
                    "Page" => "1",
                ]
            ]);

        if ($response->successful()) {
            if (count($response->json()['data']) > 0) {
                return collect($response->json()['data'][0]['Addresses'])->transform(function ($values) {
                    return new NPStreet($values);
                });
            } else {
                return collect([]);
            }
        } else {
            return collect([]);
        }
    }

    public function searchWarehouse($query, $cityRef): \Illuminate\Support\Collection
    {
        $response = Http::acceptJson()
            ->post('https://api.novaposhta.ua/v2.0/json/', [
                "apiKey" => env('NOVA_POSHTA_API'),
                "modelName" => "Address",
                "calledMethod" => "getWarehouses",
                "methodProperties" => [
                    "Language" => app()->getLocale(),
                    "SettlementRef" => $cityRef,
                    "FindByString" => $query,
                    "Limit" => "100",
                    "Page" => "1",
                ]
            ]);

        if ($response->successful()) {
            if (count($response->json()['data']) > 0) {
                return collect($response->json()['data'])->transform(function ($values) {
                    return new NPWarehouse($values);
                });
            } else {
                return collect([]);
            }
        } else {
            return collect([]);
        }
    }
}
