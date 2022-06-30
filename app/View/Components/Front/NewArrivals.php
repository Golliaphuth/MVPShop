<?php

namespace App\View\Components\Front;

use App\Models\Product;
use Illuminate\View\Component;

class NewArrivals extends Component
{
    public $products;

    public function __construct()
    {
        $this->products = Product::latest()->take(16)->get();
    }

    public function render()
    {
        return view('front.components.new-arrivals', [
            'products' => $this->products
        ]);
    }
}
