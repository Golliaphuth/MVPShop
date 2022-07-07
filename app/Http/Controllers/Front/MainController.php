<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;

class MainController extends Controller
{
    public $data = [];

    public function __construct() {
        $this->data['categories'] = Category::with('translate')->main()->orderBy('sort', 'ASC')->get();
        $this->data['newArrivals'] = [];
    }
}
