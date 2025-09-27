<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Auto generate slug from name
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($portfolio) {
            if (empty($portfolio->slug)) {
                $portfolio->slug = Str::slug($portfolio->name);
            }
        });

        static::updating(function ($portfolio) {
            if ($portfolio->isDirty('name') && empty($portfolio->getOriginal('slug'))) {
                $portfolio->slug = Str::slug($portfolio->name);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
