<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends MainController
{

    public function index(Request $request, $slug)
    {
        $this->data['category'] = Category::where('slug', $slug)->first();
        $categories = collect($this->data['category']->children)->pluck('id')->toArray();
        $categories[] = $this->data['category']->id;

        $query = Product::query()->with(['images'])->whereIn('category_id', $categories);

        $this->data['products_price_min'] = $query->min('retail');
        $this->data['products_price_max'] = $query->max('retail');

        $where = [];
        if($request->has('price_min')) {
            $where[] = ['retail', '>=', $request->get('price_min')];
            $this->data['priceMin'] = $request->get('price_min');
        }
        if($request->has('price_max')) {
            $where[] = ['retail', '<=', $request->get('price_max')];
            $this->data['priceMax'] = $request->get('price_max');
        }
        if(count($where) > 0) {
            $query->where($where);
        }

        if($request->has('sort')) {
            switch($request->get('sort')) {
                case 'newest':
                    $query->orderBy('created_at', 'DESC');
                    $this->data['currentSort'] = 'newest';
                    break;
                case "popularity":
                    $query->orderBy('sold', 'DESC');
                    $this->data['currentSort'] = 'popularity';
                    break;
                case 'price_low':
                    $query->orderBy('retail', 'ASC');
                    $this->data['currentSort'] = 'price_low';
                    break;
                case 'price_high':
                    $query->orderBy('retail', 'DESC');
                    $this->data['currentSort'] = 'price_high';
                    break;
            }
        } else {
            $query->orderBy('created_at', 'DESC');
            $this->data['currentSort'] = 'newest';
        }

        if($request->ajax()) {
            $this->data['products'] = $query->cursorPaginate(config('products.products_paginate'));
            $html = '';
            foreach($this->data['products'] as $product) {
                $html .= '<div class="products-list__item">';
                $html .= view('front.products.templates.product-vertical', ['product' => $product])->render();
                $html .= '</div>';
            }
            return response()->json([
                'body' => $html,
                'pagination' => $this->data['products']->links('front.components.cursor-pagination')->toHtml()
            ], 200);
        }

        $this->data['products_total'] = $query->count();


        $this->data['products'] = $query->cursorPaginate(config('products.products_paginate'));

        return view('front.categories.index', $this->data);
    }
}
