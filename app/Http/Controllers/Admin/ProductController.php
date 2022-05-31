<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends AdminController
{
    public function index(Request $request)
    {

        $categories = Category::with('translate')->main()->get()->sortBy(function($category) {
            return $category->translate->name;
        });

        return view('admin.products.index', [
            'categories' => $categories
        ]);
    }


    public function getProducts(Request $request): \Illuminate\Http\JsonResponse
    {
        $query = $request->all();
        $recordsTotal = Product::count();
        $recordsFiltered = $recordsTotal;

        // TODO Search by SKU first and union by name

        $products = [];
        if($query['search']['value'] == null) {
            $products = Product::with('translate', 'category.translate', 'mainImage', 'price')
                ->skip(intval($query['start']))
                ->limit(intval($query['length']))
                ->get();
        } else {
            $str = $query['search']['value'];
            $products = Product::with('translate', 'category.translate', 'mainImage', 'price')
                ->whereHas('translate', function ($query) use ($str) {
                    return $query->where('name', 'like', '%'.$str.'%');
                });

            $recordsFiltered = $products->count();

            $products = $products->skip(intval($query['start']))
            ->limit(intval($query['length']))
            ->get();
        }

        $response = [
            'draw' => intval($query['draw']),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $products->toArray()
        ];

        return response()->json($response, 200);
    }
}
