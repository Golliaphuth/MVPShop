<?php

namespace App\Services;

use App\Events\CartEvent;
use App\Models\Cart;
use App\Models\CartCustomer;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class CartDatabaseService implements ICartService
{

    protected $uuid;

    public function __construct()
    {
        $this->uuid = (request()->hasCookie('uuid-cart')) ? Crypt::decrypt($_COOKIE['uuid-cart'], false) : null;
    }

    public function all()
    {
        return Cart::where('uuid', $this->uuid)->get();
    }

    public function allByCustomer($customer_id)
    {
        return CartCustomer::where('customer_id', $customer_id)->first()->cart;
    }

    public function addProduct($product_id, $quantity = 1): void
    {
        Cart::create([
            'uuid' => $this->uuid,
            'product_id' => $product_id,
            'quantity' => $quantity,
        ]);
        event(new CartEvent($this->count()));
    }

    public function removeProduct($product_id)
    {
        Cart::where([
            ['uuid', $this->uuid],
            ['product_id', $product_id],
        ])->delete();
        event(new CartEvent($this->count()));
    }

    public function quantity($product_id, $quantity)
    {
        Cart::where([
            ['uuid', $this->uuid],
            ['product_id', $product_id],
        ])->update([
            'quantity' => $quantity
        ]);
    }

    public function quantityIncrement($product_id)
    {
        Cart::where([
            ['uuid', $this->uuid],
            ['product_id', $product_id],
        ])->increment('quantity');
    }

    public function quantityDecrement($product_id)
    {
        $item = Cart::where([
            ['uuid', $this->uuid],
            ['product_id', $product_id],
        ])->first();

        if ($item->quantity > 1) {
            $item->decrement('quantity');
        }
    }

    public function count(): int
    {
        return Cart::where('uuid', $this->uuid)->count();
    }

    public function total(): int
    {
        $items = Cart::where('uuid', $this->uuid)->get();
        $total = 0;
        foreach ($items as $item) {
            $total += $item->quantity * $item->product->retail;
        }
        return $total;
    }

    public function setCartCustomer()
    {
        CartCustomer::updateOrCreate([
            'uuid' => $this->uuid
        ], [
            'customer_id' => Auth::guard('web')->user()->id
        ]);
    }
}
