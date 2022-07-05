<?php

namespace App\Services\Cart;

use App\Events\CartEvent;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CartDatabaseService implements ICartService
{

    protected $uuid;

    public function __construct()
    {
        $this->uuid = (request()->hasCookie('uuid-cart')) ? Crypt::decrypt($_COOKIE['uuid-cart'], false) : null;
    }

    public function all()
    {
        $cart = Cart::with('items')->where('uuid', $this->uuid)->first();
        return ($cart) ? $cart : new Cart();
    }

    public function allByCustomer(Customer $customer)
    {
        return $customer->cart;
    }

    public function addProduct($product_id, $quantity = 1): void
    {
        $cart = Cart::firstOrCreate([
            'uuid' => $this->uuid,
            'customer_id' => (Auth::guard('web')->check()) ? Auth::guard('web')->user()->id : null
        ]);

        $item = $cart->items->where('product_id', $product_id)->first();
        if($item) {
            $this->quantityIncrement($product_id);
        } else {
            $cart->items()->create([
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
        }
        event(new CartEvent($this->count()));
    }

    public function removeProduct($product_id)
    {
        $cart = Cart::with('items')->where('uuid', $this->uuid)->first();
        $cart->items->where('product_id', $product_id)->first()->delete();
        event(new CartEvent($this->count()));
    }

    public function quantity($product_id, $quantity)
    {
        $cart = Cart::with('items')->where('uuid', $this->uuid)->first();
        $cart->items->where('product_id', $product_id)->update([
            'quantity' => $quantity
        ]);
        event(new CartEvent($this->count()));
    }

    public function quantityIncrement($product_id)
    {
        $cart = Cart::with('items')->where('uuid', $this->uuid)->first();
        $cart->items->where('product_id', $product_id)->first()->increment('quantity');
    }

    public function quantityDecrement($product_id)
    {
        $cart = Cart::with('items')->where('uuid', $this->uuid)->first();
        $item = $cart->items->where('product_id', $product_id)->first();
        if($item->quantity > 1) {
            $item->decrement('quantity');
        }
    }

    public function count(): int
    {
        $cart = Cart::with('items')->where('uuid', $this->uuid)->first();
        return ($cart) ? $cart->items->count() : 0;
    }

    public function total(): int
    {
        $cart = Cart::with('items', 'items.product')->where('uuid', $this->uuid)->first();
        $total = 0;
        if ($cart) {
            foreach ($cart->items as $item) {
                $total += $item->quantity * $item->product->retail;
            }
        }
        return $total;
    }

    public function setCartCustomer()
    {
        Cart::updateOrCreate([
            'uuid' => $this->uuid
        ], [
            'customer_id' => Auth::guard('web')->user()->id
        ]);
    }
}
