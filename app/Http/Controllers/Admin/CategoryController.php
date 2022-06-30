<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends AdminController
{
    public function index(Request $request)
    {

        $categories = Category::with('children')->main()->get();
        $categories_all = Category::with('translate')->get()->sortBy('translate.name');

        return view('admin.categories.index', [
            'categories' => $categories,
            'categories_all' => $categories_all,
        ]);
    }
}
