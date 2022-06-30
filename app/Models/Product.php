<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'products';

    protected $fillable = [
        'sku',
        'barcode',
        'vendorCode',
        'balance',
        'brand_id',
        'category_id',
        'slug',
        'brand_ref',
        'category_ref',
        'retail',
        'purchase',
        'protected',
        'new',
        'hot',
        'sale',
        'sold',
        'deleted_at',
    ];

    protected $with = [
        'mainImage'
    ];

    protected $appends = [
        'attributesShort',
        'attributesFull',
        'breadcrumbs',
    ];

    public function translates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductTranslate::class);
    }

    public function translate(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductTranslate::class)->where('lang', app()->getLocale());
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function mainImage(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductImage::class)->where('main', 1);
    }

    public function attributes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductToAttribute::class)->with('translate');
    }

    public function getAttributesShortAttribute(): \Illuminate\Support\Collection
    {
        $options = collect($this->hasMany(ProductToAttribute::class)
            ->with('translate', 'attribute', 'attribute.translate')
            ->get()
        )->keyBy('attribute.ref');

        $needed = config('sandi.short');
        $sorted = collect(array_replace($needed, $options->intersectByKeys($needed)->toArray()));
        foreach($sorted as $key => $s) {
            if(!is_array($s)) {
                $sorted->forget($key);
            }
        }
        return $sorted;
    }

    public function getAttributesFullAttribute(): \Illuminate\Support\Collection
    {
        $options = collect($this->hasMany(ProductToAttribute::class)
            ->with('translate', 'attribute', 'attribute.translate')
            ->get()
        )->keyBy('attribute.ref');

        $needed = config('sandi.full');
        $sorted = collect(array_replace($needed, $options->intersectByKeys($needed)->toArray()));
        foreach($sorted as $key => $s) {
            if(!is_array($s)) {
                $sorted->forget($key);
            }
        }
        return $sorted;
    }

    public function getBreadcrumbsAttribute(): \Illuminate\Support\Collection
    {
        $breadcrumbs = collect([]);
        $category = $this->category;
        while ($category->parent) {
            $breadcrumbs->push($category);
            $category = $category->parent;
        }
        $breadcrumbs->push($category);

        return $breadcrumbs->reverse();
    }
}
