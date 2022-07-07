<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Cart extends Model
{
    use HasFactory, Prunable;

    public $timestamps = false;

    protected $fillable = [
        'uuid',
        'customer_id',
    ];

    protected $with = [
        'items'
    ];

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subMonth());
    }

    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
