<?php

namespace App\View\Components\Front;

use App\Services\Cart\ICartService;
use Illuminate\View\Component;

class QuickCart extends Component
{
    public $counter;

    public function __construct(ICartService $service)
    {
        $this->counter = $service->count();
    }

    public function render()
    {
        return view('front.cart.quick-cart', [
            'counter' => $this->counter,
        ]);
    }
}
