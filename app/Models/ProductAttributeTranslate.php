<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeTranslate extends Model
{
    use HasFactory;

    public $table = 'product_attribute_translates';

    public $timestamps = false;

    protected $fillable = [
        'product_attribute_id',
        'lang',
        'name',
    ];

    public function attribute(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class);
    }
}
