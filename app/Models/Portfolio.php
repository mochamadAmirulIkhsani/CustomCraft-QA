<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'product_id',
        'description',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Validation rules for portfolio image
     */
    public static function getImageValidationRules(): array
    {
        return [
            'image' => [
                'required',
                'image',
                'mimes:jpeg,jpg,png',
                'max:2048', // 2MB
                'dimensions:min_width=300,min_height=200,max_width=4000,max_height=4000'
            ]
        ];
    }

    // Auto generate slug from name and handle file cleanup
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($portfolio) {
            if (empty($portfolio->slug)) {
                $portfolio->slug = Str::slug($portfolio->name);
            }
        });

        static::updating(function ($portfolio) {
            // Handle slug generation
            if ($portfolio->isDirty('name') && empty($portfolio->getOriginal('slug'))) {
                $portfolio->slug = Str::slug($portfolio->name);
            }
            
            // Handle file cleanup when image is changed
            $original = $portfolio->getOriginal('image');
            $new = $portfolio->image;
            
            if ($original && $original !== $new && Storage::disk('public')->exists($original)) {
                Storage::disk('public')->delete($original);
            }
        });

        // Clean up file when deleting
        static::deleting(function ($portfolio) {
            if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
                Storage::disk('public')->delete($portfolio->image);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Relasi ke Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
