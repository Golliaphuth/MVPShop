<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductToAttribute extends Model
{
    use HasFactory;

    public $table = 'product_to_attributes';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'product_attribute_id',
    ];

    protected $with = [
        'translate'
    ];

    public function translate(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductToAttributeTranslate::class)->where('lang', app()->getLocale());
    }

    public function translates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductToAttributeTranslate::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id', 'id');
    }
}
