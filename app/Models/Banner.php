<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    protected $fillable = [
        'image_path',
        'title',
        'url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot method to handle file cleanup
     */
    protected static function boot()
    {
        parent::boot();

        // Clean up old file when updating
        static::updating(function ($banner) {
            $original = $banner->getOriginal('image_path');
            $new = $banner->image_path;
            
            // If image is being changed and old file exists, delete it
            if ($original && $original !== $new && Storage::disk('public')->exists($original)) {
                Storage::disk('public')->delete($original);
            }
        });

        // Clean up file when deleting
        static::deleting(function ($banner) {
            if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
                Storage::disk('public')->delete($banner->image_path);
            }
        });
    }
}
