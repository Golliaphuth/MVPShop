<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'product_attributes';

    protected $fillable = [
        'ref',
        'deleted_at',
    ];

    public function translate(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductAttributeTranslate::class)->where('lang', app()->getLocale());
    }

    public function translates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductAttributeTranslate::class);
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
