<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends AdminController
{
    public function index(Request $request)
    {

        $products = Product::with('translate', 'images', 'price')->limit(10)->get();

        return view('admin.products.index', [
            'products' => $products
        ]);
    }
}
