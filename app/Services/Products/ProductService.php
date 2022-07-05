<?php

namespace App\Services\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ProductService
{

    public function syncImages(Product $product)
    {
        $product->load('images');
        foreach($product->images as $image) {
            $filename = md5($image->link).'.jpg';
            if ($image->filename == null and $image->filename != $filename) {
                $response = Http::get($image->link)->body();
                if($response->successful()) {
                    Storage::disk('products')->put($filename, $response->body());
                    $image->filename = $filename;
                }
                $image->save();
            }
        }
    }

    public function forceSyncImages(Product $product) {
        $product->load('images');
        foreach($product->images as $image) {
            $filename = md5($image->link).'.jpg';
            $data = Http::get($image->link)->body();
            Storage::disk('products')->put($filename, $data);
            $image->filename = $filename;
            $image->save();
        }
    }

}
