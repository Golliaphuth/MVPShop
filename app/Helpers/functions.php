<?php

use App\Models\Category;

if(!function_exists('category_render')) {

    function category_select_render(Category $category, $level, $selected_id = null) {

        $space = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);

        $selected = ($category->id == $selected_id) ? " selected" : "";

        echo "<option value='{$category->id}'{$selected}>{$space}{$category->translate->name}</option>" . PHP_EOL;

        if($category->children->count() > 0) {
            $level++;
            foreach($category->children as $child) {
                category_select_render($child, $level, $selected_id);
            }
        }

    }

}
