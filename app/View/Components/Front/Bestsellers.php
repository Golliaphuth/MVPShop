<?php

namespace App\View\Components\Front;

use App\Models\Product;
use Illuminate\View\Component;

class Bestsellers extends Component
{
    public $products;

    public function __construct()
    {
        $this->products = Product::take(7)->get();
    }

    public function render()
    {
        return view('front.components.bestsellers', [
            'productTop' => $this->products->shift(),
            'products' => $this->products
        ]);
    }
}
