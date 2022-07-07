<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends AdminController
{
    public function index(Request $request)
    {
        $categories = Category::main()->orderBy('sort', 'ASC')->get();

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    public function reload(Request $request): string
    {
        $categories = Category::main()->orderBy('sort', 'ASC')->get();
        return view('admin.categories.templates.category', ['categories' => $categories])->render();
    }

    public function edit(Request $request, Category $category, $new = false): \Illuminate\Http\JsonResponse
    {
        $content = view('admin.categories.templates.edit-form', [
            'categories' => Category::main()->get(),
            'current' => $category,
            'new' => $new
        ])->render();

        return response()->json($content, 200);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'parent_id' => 'required',
            'name' => 'required|array',
            'name.*' => 'required|string',
        ])->validate();

        $category = new Category();
        $category->fill($validator);
        $category->slug = Str::slug($validator['name']['uk']);
        $category->save();

        foreach ($validator['name'] as $lng => $name) {
            $category->translates()->create([
                'lang' => $lng,
                'name' => $name,
            ]);
        }

        return response()->json('ok', 200);
    }

    public function update(Request $request, Category $category): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|array',
            'name.*' => 'required|string',
            'parent_id' => 'required|integer',
        ])->validate();

        $category->parent_id = ($validator['parent_id']) ?: null;
        $category->save();
        foreach ($validator['name'] as $lng => $name) {
            $category->translates()->updateOrCreate([
                'lang' => $lng
            ], [
                'name' => $name
            ]);
        }

        return response()->json('ok', 200);
    }

    public function sort(Category $category, $vector): \Illuminate\Http\JsonResponse
    {
        DB::beginTransaction();
        try {
            switch($vector) {
                case "increment":
                    $category->increment('sort');
                    break;
                case "decrement":
                    if($category->sort > 0) $category->decrement('sort');
                    break;
            }

            $categories = [];
            if($category->parent) {
                $categories = $category->parent->children->except($category->id);
            } else {
                $categories = Category::main()->orderBy('sort', 'ASC')->get()->except($category->id);
            }

            $idx = 0;
            foreach($categories as $cat) {
                if($idx == $category->sort) $idx++;
                $cat->sort = $idx;
                $cat->save();
                $idx++;
            }

            DB::commit();
        } catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return response()->json('ok', 200);
    }
}
