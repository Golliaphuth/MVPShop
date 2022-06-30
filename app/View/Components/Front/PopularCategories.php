<?php

namespace App\View\Components\Front;

use App\Models\Category;
use Illuminate\View\Component;

class PopularCategories extends Component
{

    public $categories;

    public function __construct()
    {
        $this->categories = Category::with('translate', 'children')->main()->inRandomOrder()->take(6)->get();
    }

    public function render()
    {
        return view('front.components.popular-categories', [
            'categories' => $this->categories
        ]);
    }
}
