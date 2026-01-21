<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'content',
        'seo_title',
        'seo_description'
    ];

    protected $casts = [
        'content' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
