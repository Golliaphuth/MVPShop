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
        'parent_id',
        'domain',
        'slug',
        'ref',
        'link',
        'filename',
        'protected',
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

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('children');
    }

    public function scopeMain($query)
    {
        return $query->whereNull('parent_id');
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(self::class, 'id', 'parent_id')->with('parent');
    }

    public function getBreadcrumbsAttribute(): \Illuminate\Support\Collection
    {
        $breadcrumbs = collect([]);
        $category = $this;
        while ($category->parent) {
            $breadcrumbs->push($category->parent);
            $category = $category->parent;
        }
        return $breadcrumbs->reverse();
    }
}
