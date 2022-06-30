<?php

namespace App\Console\Commands\Import\SANDI;

use App\Events\ImportEvent;
use App\Jobs\Import\SANDI\ImportImageCategory;
use App\Jobs\Import\SANDI\ImportImages;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryTranslate;
use App\Models\ImportConfig;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductToAttribute;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class ImportCommand extends Command
{
    protected $signature = 'import:sandi';
    protected $description = 'Import products from SANDI+';

    public $domain = 'SANDI';
    public $brands = [];
    public $categories = [];
    public $attributes = [];
    public $products = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        set_time_limit(600);

        Redis::set('import:state', true);
        Log::info('Import started at: ' . Carbon::now()->format('Y-m-d H:i:s'));

        event(new ImportEvent([
            'state' => 'start',
        ]));

        $response = Http::get(env('SANDI'));
        $json = $response->json();

        $this->brands = $json['brands'];
        $this->categories = $json['categories'];
        $this->attributes = $json['attributes'];
        $this->products = $json['products'];

        $config = ImportConfig::where('domain', 'SANDI')->get()->pluck('value', 'option')->toArray();

        /** Import Brands */
        if(isset($config['brands']) and $config['brands'] == 1) {
            $start = Carbon::now();
            DB::beginTransaction();
            try {
                $count = count($this->brands);
                $step = 1;
                foreach ($this->brands as $ref => $brand) {
                    $brand['domain'] = $this->domain;
                    $brand['deleted_at'] = null;
                    $brand['slug'] = Str::slug($brand['name']);
                    Brand::withTrashed()->updateOrCreate(['ref' => $ref], $brand);
                    event(new ImportEvent([
                        'label' => 'Бренды',
                        'item' => 'brands',
                        'state' => 'progress',
                        'step' => $step,
                        'steps' => $count,
                    ]));
                    $step++;
                }
                Log::info('Import brands: ', [
                    'started_at' => $start->format('Y-m-d H:i:s'),
                    'finished_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Import brands: ', [
                    'message' => $e->getMessage(),
                    'at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
            DB::commit();
            event(new ImportEvent([
                'label' => 'Бренды',
                'item' => 'brands',
                'state' => 'finish',
            ]));
        }

        /** Import Categories */
        if(isset($config['categories']) and $config['categories'] == 1) {
            $start = Carbon::now();
            $category_keys = [];
            DB::beginTransaction();
            try {
                $count = count($this->categories);
                $step = 1;
                foreach ($this->categories as $ref => $category) {
                    $category['domain'] = $this->domain;
                    $category['ref'] = $ref;
                    $category['parent_id'] = (array_key_exists($category['parent_ref'], $category_keys )) ? $category_keys[$category['parent_ref']] : null;
                    $category['deleted_at'] = null;
                    $category['link'] = $category['image'];
                    $category['slug'] = (isset($category['name']['uk'])) ? Str::slug($category['name']['uk']) : Str::slug($category['name']['ru']);
                    $model = Category::withTrashed()->updateOrCreate(['ref' => $ref], $category);
                    $category_keys[$ref] = $model->id;
                    $model->translates()->delete();
                    $pattern = '/([0-9]+)\. /';
                    foreach ($category['name'] as $lang => $name) {
                        $name = preg_replace($pattern, '', $name);
                        CategoryTranslate::create([
                            'category_id' => $model->id,
                            'lang' => $lang,
                            'name' => $name,
                        ]);
                    }
                    event(new ImportEvent([
                        'label' => 'Категории',
                        'item' => 'categories',
                        'state' => 'progress',
                        'step' => $step,
                        'steps' => $count,
                    ]));
                    $step++;

                    /** IMAGES DOWNLOADING */
                    ImportImageCategory::dispatch($model)->onQueue('import_images');
                }

                Log::info('Import categories: ', [
                    'started_at' => $start->format('Y-m-d H:i:s'),
                    'finished_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Import categories: ', [
                    'message' => $e->getMessage(),
                    'at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
            DB::commit();
            event(new ImportEvent([
                'label' => 'Категории',
                'item' => 'categories',
                'state' => 'finish',
            ]));
        }

        /** Import Attributes */
        if(isset($config['attributes']) and $config['attributes'] == 1) {
            $start = Carbon::now();
            DB::beginTransaction();
            try {
                $count = count($this->attributes);
                $step = 1;
                foreach ($this->attributes as $ref => $attr) {
                    $attribute = ProductAttribute::withTrashed()->updateOrCreate(['ref' => $ref], ['deleted_at' => null]);
                    $attribute->translates()->delete();
                    $attributeTranslates = [];
                    foreach ($attr as $lang => $name) {
                        $attributeTranslates[] = ['lang' => $lang, 'name' => $name];
                    }
                    $attribute->translates()->createMany($attributeTranslates);
                    event(new ImportEvent([
                        'label' => 'Атрибуты товаров',
                        'item' => 'attributes',
                        'state' => 'progress',
                        'step' => $step,
                        'steps' => $count,
                    ]));
                    $step++;
                }
                Log::info('Import attributes: ', [
                    'started_at' => $start->format('Y-m-d H:i:s'),
                    'finished_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Import attributes: ', [
                    'message' => $e->getMessage(),
                    'at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
            DB::commit();
            event(new ImportEvent([
                'label' => 'Атрибуты товаров',
                'item' => 'attributes',
                'state' => 'finish',
            ]));
        }

        $brands = Brand::withTrashed()->get()->pluck('id', 'ref')->toArray();
        $categories = Category::withTrashed()->get()->pluck('id', 'ref')->toArray();
        $attributes = ProductAttribute::withTrashed()->get()->pluck('id', 'ref')->toArray();

        /** Import Products */
        if(isset($config['products']) and $config['products'] == 1) {
            $start = Carbon::now();
            DB::beginTransaction();
            try {
                $count = count($this->products);
                $step = 1;
                foreach ($this->products as $sku => $p) {

                    /** CHECK BALANCE */
                    $balanceCount = collect($p['main']['balances'])->except('213')->sum();

                    if ($balanceCount < 3) {
                        event(new ImportEvent([
                            'label' => 'Товары',
                            'item' => 'products',
                            'state' => 'progress',
                            'step' => $step,
                            'steps' => $count,
                        ]));
                        $step++;
                        continue;
                    }

                    /** MAIN */
                    $p['main']['slug'] = (isset($p['main']['name']['uk'])) ? Str::slug($p['main']['name']['uk'] . '-' . $p['main']['vendorCode']) : Str::slug($p['main']['name']['ru'] . '-' . $p['main']['vendorCode']);
                    $p['main']['brand_ref'] = $p['main']['brand'];
                    $p['main']['category_ref'] = $p['main']['category'];

                    $p['main']['brand_id'] = (isset($brands[$p['main']['brand']])) ? $brands[$p['main']['brand']] : null;
                    $p['main']['category_id'] = (isset($categories[$p['main']['category']])) ? $categories[$p['main']['category']] : null;

                    $p['main']['deleted_at'] = null;
                    $p['main']['balance'] = $balanceCount;

                    $p['main']['retail'] = $p['main']['prices']['retail']['current'];
                    $p['main']['purchase'] = $p['main']['prices']['purchase']['cash']['current'];

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
                        if(isset($attributes[$ref])) {
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
                    }

                    /** IMAGES */
                    $product->load('images');
                    $product->images()->updateOrCreate(['order' => 0], [
                        'link' => $p['images']['main'], 'order' => 0, 'main' => 1, 'filename' => md5($p['images']['main']).'.jpg'
                    ]);
                    foreach ($p['images']['additional'] as $order => $img) {
                        $product->images()->updateOrCreate(['order' => $order], [
                            'link' => $img, 'order' => $order, 'main' => 0, 'filename' => md5($img).'.jpg'
                        ]);
                    }

                    /** IMAGES DOWNLOADING */
                    ImportImages::dispatch($product)->onQueue('import_images');

                    event(new ImportEvent([
                        'label' => 'Товары',
                        'item' => 'products',
                        'state' => 'progress',
                        'step' => $step,
                        'steps' => $count,
                    ]));

                    $step++;
                }

                Log::info('Import products: ', [
                    'started_at' => $start->format('Y-m-d H:i:s'),
                    'finished_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Import products: ', [
                    'message' => $e->getMessage(),
                    'at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
            DB::commit();
            event(new ImportEvent([
                'label' => 'Товары',
                'item' => 'products',
                'state' => 'finish',
            ]));
        }

        $date = Carbon::now()->subHours(2);

        Brand::where('updated_at', '<', $date->format('Y-m-d H:i:s'))->delete();
        Category::where('updated_at', '<', $date->format('Y-m-d H:i:s'))->delete();
        ProductAttribute::where('updated_at', '<', $date->format('Y-m-d H:i:s'))->delete();
        Product::where('updated_at', '<', $date->format('Y-m-d H:i:s'))->delete();

        Redis::set('import:state', false);

        event(new ImportEvent([ 'state' => 'success' ]));

        Log::info('Import finish at: ' . Carbon::now()->format('Y-m-d H:i:s'));

        return 0;
    }
}
