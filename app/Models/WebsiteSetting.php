<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function allAsKeyValue(): array
    {
        return static::query()->pluck('value', 'key')->toArray();
    }
}
