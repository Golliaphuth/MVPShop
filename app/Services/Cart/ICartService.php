<?php

namespace App\Services\Cart;

interface ICartService
{
    public function all();
    public function addProduct($product_id, $quantity = 1);
    public function removeProduct($product_id);
    public function quantity($product_id, $quantity);
    public function quantityIncrement($product_id);
    public function quantityDecrement($product_id);
    public function count(): int;
    public function total(): int;
}
