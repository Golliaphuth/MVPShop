<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImportConfig extends Model
{
    use HasFactory;

    public static $options = [
        'brands',
        'categories',
        'attributes',
        'products',
    ];

    protected $fillable = [
        'domain',
        'option',
        'value',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
