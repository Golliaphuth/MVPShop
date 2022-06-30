<?php

namespace App\View\Components\Front;

use App\Services\CartService;
use App\Services\ICartService;
use Illuminate\View\Component;

class QuickCart extends Component
{
    public $items;
    public $counter;
    public $total;

    public function __construct(ICartService $service)
    {
        $this->items = $service->all();
        $this->counter = count($this->items);
        foreach ($this->items as $item) {
            $this->total += $item['product']->retail * $item['quantity'];
        }
    }

    public function render()
    {
        return view('front.components.quick-cart', [
            'items' => $this->items,
            'counter' => $this->counter,
            'total' => $this->total,
        ]);
    }
}
