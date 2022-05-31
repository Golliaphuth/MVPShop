<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends AdminController
{
    public function index(Request $request)
    {

        $categories = Category::with('childs')->whereNull('parent_ref')->get();

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }
}
