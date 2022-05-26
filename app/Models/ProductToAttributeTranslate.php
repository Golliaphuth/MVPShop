<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductToAttributeTranslate extends Model
{
    use HasFactory;

    public $table = 'product_to_attribute_translates';

    public $timestamps = false;

    protected $fillable = [
        'product_to_attribute_id',
        'lang',
        'value',
    ];

    public function productAttribute(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductToAttribute::class);
    }
}
