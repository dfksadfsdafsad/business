<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = [
        'slug',
        'locale',
        'title',
        'meta',
        'draft_content',
        'published_content',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'meta' => 'array',
            'draft_content' => 'array',
            'published_content' => 'array',
            'published_at' => 'datetime',
        ];
    }
}
