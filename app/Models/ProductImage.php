<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'link',
        'order',
        'main',
        'filename',
    ];

    protected $appends = [
        'path',
        'url',
    ];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getPathAttribute(): string
    {
        return Storage::disk('products')->url($this->filename);
    }

    public function scopeMain($query)
    {
        return $query->where('main', 1);
    }

    public function getUrlAttribute(): string
    {
        return (Storage::disk('products')->exists($this->filename)) ? Storage::disk('products')->url($this->filename) : Storage::disk('defaults')->url('product.jpg');
    }
}
