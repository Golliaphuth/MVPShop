<?php

namespace App\Services\Deliveries;

use Illuminate\Support\Collection;

interface IDeliveryService
{
    public function searchCity($query): Collection;
    public function searchStreet($query, $cityRef): Collection;
    public function searchWarehouse($query, $cityRef): Collection;
}
