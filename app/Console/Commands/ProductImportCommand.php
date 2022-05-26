<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryTranslate;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductToAttribute;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductImportCommand extends Command
{

    protected $signature = 'product:import {--debug}';
    protected $description = 'Import products from B2B';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $debug = $this->option('debug');

        $start = Carbon::now();

        $this->info('Download json'); echo PHP_EOL;

        $json = '{}';

        if($debug) {
            try {
                $json = json_decode(Storage::get('public/json.txt'), true);
            } catch(\Exception $e) {
                $this->error($e->getMessage()); return 0;
            }
        } else {
            $response = Http::get('https://b2b-sandi.com.ua/export/view/c2f48b8ccee7e93c4902132271a25236-3982-1652309498/json');
            $json = $response->json();
        }

        // TODO Download images ???

        // BRANDS
        $brands = [];
        $this->newLine(2);
        $this->info('Brands');
        $barBrands = $this->output->createProgressBar(count($json['brands'])); echo PHP_EOL;
        $barBrands->start();
        DB::beginTransaction();
        try {
            Brand::query()->delete();
            if(isset($json['brands'])) {
                foreach($json['brands'] as $ref => $brand) {
                    $brand['deleted_at'] = null;
                    $b = Brand::withTrashed()->updateOrCreate(['ref' => $ref], $brand);
                    $brands[$b->ref] = $b->id;
                    $barBrands->advance();
                }
            }
        } catch(\Exception $e) {
            DB::rollBack();
            $this->error($e->getMessage());
        }
        DB::commit();
        $barBrands->finish();

        // CATEGORIES
        $categories = [];
        $this->newLine(2);
        $this->info('Categories');
        $barsCategories = $this->output->createProgressBar(count($json['categories'])); echo PHP_EOL;
        $barsCategories->start();
        DB::beginTransaction();
        try {
            Category::query()->delete();
            if(isset($json['categories'])) {
                foreach($json['categories'] as $ref => $cat) {
                    $cat['deleted_at'] = null;
                    $category = Category::withTrashed()->updateOrCreate(['ref' => $ref], $cat);
                    $categories[$category->ref] = $category->id;
                    $category->translates()->delete();
                    $pattern = '/([0-9]+)\. /';
                    foreach($cat['name'] as $lang => $name) {
                        $name = preg_replace($pattern, '', $name);
                        CategoryTranslate::create([
                            'category_id' => $category->id,
                            'lang' => $lang,
                            'name' => $name,
                        ]);
                    }
                    $barsCategories->advance();
                }
            }
        } catch(\Exception $e) {
            DB::rollBack();
            $this->error($e->getMessage());
        }
        DB::commit();
        $barsCategories->finish();

        // ATTRIBUTES
        $attributes = [];
        $this->newLine(2);
        $this->info('Attributes');
        $barAttributes = $this->output->createProgressBar(count($json['attributes'])); echo PHP_EOL;
        $barAttributes->start();
        DB::beginTransaction();
        try {
            ProductAttribute::query()->delete();
            foreach ($json['attributes'] as $ref => $attr) {
                $attribute = ProductAttribute::withTrashed()->updateOrCreate(['ref' => $ref], ['deleted_at' => null]);
                $attributes[$attribute->ref] = $attribute->id;
                $attribute->translates()->delete();
                $attributeTranslates = [];
                foreach ($attr as $lang => $name) {
                    $attributeTranslates[] = ['lang' => $lang, 'name' => $name];
                }
                $attribute->translates()->createMany($attributeTranslates);
                $barAttributes->advance();
            }
        } catch(\Exception $e) {
            DB::rollBack();
            $this->error($e->getMessage());
        }
        DB::commit();
        $barAttributes->finish();

        // PRODUCTS
        $this->newLine(2);
        $this->info('Products');
        $barsProducts = $this->output->createProgressBar(count($json['products'])); echo PHP_EOL;
        $barsProducts->start();
        DB::beginTransaction();
        try {
            Product::query()->delete();
            if (isset($json['products'])) {
                foreach ($json['products'] as $sku => $p) {
                    /** CHECK BALANCE */
                    $balanceCount = collect($p['main']['balances'])->except('213')->sum();
                    if ($balanceCount < 3) continue;
                    /** MAIN */
                    $p['main']['slug'] = (isset($p['main']['name']['ru'])) ? Str::slug($p['main']['name']['ru'] . '-' . $p['main']['vendorCode']) : (isset($p['main']['name']['uk'])) ? Str::slug($p['main']['name']['uk'] . '-' . $p['main']['vendorCode']) : Str::uuid();
                    $p['main']['brand_id'] = $brands[$p['main']['brand']];
                    $p['main']['brand_ref'] = $p['main']['brand'];
                    $p['main']['category_id'] = $categories[$p['main']['category']];
                    $p['main']['category_ref'] = $p['main']['category'];
                    $p['main']['balance'] = $balanceCount;
                    $p['main']['deleted_at'] = null;
                    $product = Product::withTrashed()->updateOrCreate([
                        'sku' => $sku
                    ], $p['main']);
                    /** TRANSLATES */
                    $product->translates()->delete();
                    foreach ($p['main']['name'] as $lang => $name) {
                        $translate = [
                            'lang' => $lang,
                            'name' => $name,
                            'description' => (isset($p['main']['description'][$lang])) ? $p['main']['description'][$lang] : null,
                        ];
                        $product->translates()->create($translate);
                    }
                    /** ATTRIBUTES */
                    $product->attributes()->delete();
                    foreach ($p['attributes'] as $ref => $attr) {
                        $attribute = ProductToAttribute::create([
                            'product_id' => $product->id,
                            'product_attribute_id' => $attributes[$ref],
                        ]);
                        $attribute->translate()->delete();
                        foreach ($attr as $lang => $value) {
                            $attribute->translate()->create([
                                'lang' => $lang,
                                'value' => $value,
                            ]);
                        }
                    }
                    /** PRICES */
                    if (isset($p['main']['prices']) and $p['main']['prices']['retail']['current']) {
                        $price = [
                            'retail' => $p['main']['prices']['retail']['current'],
                            'retail_old' => $p['main']['prices']['retail']['old'] ?? null,
                            'purchase' => $p['main']['prices']['purchase']['cash']['current'] ?? null,
                            'purchase_old' => $p['main']['prices']['purchase']['cash']['old'] ?? null,
                        ];
                        $product->price()->delete();
                        $product->price()->create($price);
                    }
                    /** IMAGES */
                    $images = [
                        ['link' => $p['images']['main'], 'order' => 0, 'main' => 1]
                    ];
                    foreach ($p['images']['additional'] as $order => $img) {
                        $images[] = ['link' => $img, 'order' => $order];
                    }
                    $product->images()->createMany($images);
                    /** BALANCES */


                    $barsProducts->advance();
                }
            }
        } catch(\Exception $e) {
            DB::rollBack();
            $this->error($e->getMessage());
        }
        DB::commit();
        $barsProducts->finish();

        $finish = Carbon::now();
        $this->newLine(2); $this->info('Done in ' . $start->diff($finish)->format('%i:%s'));

        return 0;
    }
}
