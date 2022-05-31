<?php

namespace App\Models;

use App\Services\CategoryService;
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

    protected $appends = [
        'breadcrumbs'
    ];

    protected $with = [
        'translate'
    ];

    public function translate(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CategoryTranslate::class)->where('lang', app()->getLocale());
    }

    public function translates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CategoryTranslate::class);
    }

    public function childs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(self::class, 'parent_ref', 'ref')->with('childs');
    }

    public function scopeMain($query)
    {
        return $query->whereNull('parent_ref');
    }

    public function parent()
    {
        return $this->hasOne(self::class, 'ref', 'parent_ref')->with('parent');
    }

    public function getBreadcrumbsAttribute(): string
    {
        $service = new CategoryService();
        return $service->breadcrumbs($this);
    }
}
