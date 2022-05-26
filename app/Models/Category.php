<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ref',
        'parent_ref',
        'image',
        'deleted_at',
    ];

    public function translate(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CategoryTranslate::class)->where('lang', app()->getLocale());
    }

    public function translates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CategoryTranslate::class);
    }
}
