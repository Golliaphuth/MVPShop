<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public $breadcrumbs;

    public function breadcrumbs(Category $category): string
    {
        $this->breadcrumbs .= ' > ' . $category->translate->name;
        if($category->parent_ref) {
            $this->parent($category);
        }
        return $this->breadcrumbs;
    }

    private function parent(Category $category) {
        if($category->parent_ref) {
            if($category->parent->parent_ref) {
                $this->breadcrumbs =  ' > ' . $category->parent->translate->name . $this->breadcrumbs;
                $this->parent($category->parent);
            } else {
                $this->breadcrumbs =  $category->parent->translate->name . $this->breadcrumbs;
            }
        }
    }
}

