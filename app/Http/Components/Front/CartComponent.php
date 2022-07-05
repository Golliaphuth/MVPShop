<?php

namespace App\Http\Components\Front;

use App\Services\Cart\CartDatabaseService;
use Livewire\Component;

class CartComponent extends Component
{
    private $service;

    protected $listeners = [
        'cartUpdated' => '$refresh'
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->service = new CartDatabaseService();
    }

    public function remove($product_id)
    {
        $this->service->removeProduct($product_id);
    }

    public function quantityAdd($product_id)
    {
        $this->service->quantityIncrement($product_id);
    }

    public function quantitySub($product_id)
    {
        $this->service->quantityDecrement($product_id);
    }

    public function quantity($product_id, $quantity)
    {
        $this->service->quantity($product_id, $quantity);
    }

    public function render()
    {
        return view('front.cart.cart-component', [
            'total' => $this->service->total(),
            'cart' => $this->service->all(),
        ]);
    }

}
