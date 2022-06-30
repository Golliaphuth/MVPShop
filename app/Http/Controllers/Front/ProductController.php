<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends MainController
{
    public function show(Request $request, $slug)
    {
        $this->data['product'] = Product::where('slug', $slug)->firstOrFail();
        return view('front.products.show',  $this->data);
    }

    public function quick(Request $request, $slug)
    {
        $this->data['product'] = Product::where('slug', $slug)->firstOrFail();
        return view('front.products.show-quick', $this->data);
    }
}
