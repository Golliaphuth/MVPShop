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
        'deleted_at',
    ];

    public function translates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductTranslate::class);
    }

    public function translate(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductTranslate::class)->where('lang', app()->getLocale());
    }

    public function price(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductPrice::class);
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function attributes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductToAttribute::class);
    }
}
