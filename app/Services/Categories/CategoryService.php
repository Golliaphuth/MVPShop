<?php

namespace App\Services\Categories;

use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public $breadcrumbs;

    public function syncImage(Category $category)
    {
        $response = Http::get($category->link);
        if($response->successful()) {
            $filename = md5($category->link).'.jpg';
            Storage::disk('categories')->put($filename, $response->body());
        } else {
            $filename = 'no-image.jpg';
        }
        $category->filename = $filename;
        $category->save();
    }

    public function breadcrumbs(Category $category): string
    {
        $this->breadcrumbs .= ' > ' . $category->translate->name;
        if($category->parent_id) {
            $this->parent($category);
        }
        return $this->breadcrumbs;
    }

    private function parent(Category $category) {
        if($category->parent_id) {
            if($category->parent->parent_id) {
                $this->breadcrumbs =  ' > ' . $category->parent->translate->name . $this->breadcrumbs;
                $this->parent($category->parent);
            } else {
                $this->breadcrumbs =  $category->parent->translate->name . $this->breadcrumbs;
            }
        }
    }
}

