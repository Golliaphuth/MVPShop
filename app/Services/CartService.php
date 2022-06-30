<?php

namespace App\Services;

use App\Events\CartEvent;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class CartService implements ICartService
{
    protected $uuid;

    public function __construct() {
        $this->uuid = request()->cookie('uuid-shop');
    }

    public function all()
    {
        $cache = Cache::get("{$this->uuid}.cart", []);
        $items = [];
        foreach ($cache as $id => $item) {
            $items[$id] = [
                'product' => Product::find($id),
                'quantity' => $item['quantity']
            ];
        }
        return $items;
    }

    public function addProduct($product_id, $quantity = 1)
    {
        $cart = Cache::get("{$this->uuid}.cart", []);
        $cart[$product_id] = [
            'product_id' => $product_id,
            'quantity' => $quantity
        ];
        Cache::put("{$this->uuid}.cart", $cart);
        event(new CartEvent($this->count()));
    }

    public function removeProduct($product_id)
    {
        $cart = Cache::get("{$this->uuid}.cart", []);
        unset($cart[$product_id]);
        Cache::put("{$this->uuid}.cart", $cart);
        event(new CartEvent($this->count()));
    }

    public function quantity($product_id, $quantity)
    {
        $cart = Cache::get("{$this->uuid}.cart", []);
        $cart[$product_id]['quantity'] = $quantity;
        Cache::put("{$this->uuid}.cart", $cart);
    }

    public function quantityIncrement($product_id)
    {
        $cart = Cache::get("{$this->uuid}.cart", []);
        $cart[$product_id]['quantity'] += 1;
        Cache::put("{$this->uuid}.cart", $cart);
    }

    public function quantityDecrement($product_id)
    {
        $cart = Cache::get("{$this->uuid}.cart", []);
        $cart[$product_id]['quantity'] = ($cart[$product_id]['quantity'] > 1) ? $cart[$product_id]['quantity'] - 1 : 1;
        Cache::put("{$this->uuid}.cart", $cart);
    }

    public function count(): int
    {
        return count(Cache::get("{$this->uuid}.cart", []));
    }

    public function total(): int
    {
        $total = 0;
        $cart = $this->all();
        foreach($cart as $item) {
            $total += round($item['quantity'] * $item['product']->retail);
        }
        return $total;
    }
}
