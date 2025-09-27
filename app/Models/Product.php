<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'no_whatsapp',
        'image',
        'image2',
        'image3',
        'image4',
    ];

    /**
     * Boot method to handle file cleanup
     */
    protected static function boot()
    {
        parent::boot();

        // Clean up old files when updating
        static::updating(function ($product) {
            $imageFields = ['image', 'image2', 'image3', 'image4'];
            
            foreach ($imageFields as $field) {
                $original = $product->getOriginal($field);
                $new = $product->{$field};
                
                // If image field is being changed and old file exists, delete it
                if ($original && $original !== $new && Storage::disk('public')->exists($original)) {
                    Storage::disk('public')->delete($original);
                }
            }
        });

        // Clean up all files when deleting
        static::deleting(function ($product) {
            $imageFields = ['image', 'image2', 'image3', 'image4'];
            
            foreach ($imageFields as $field) {
                if ($product->{$field} && Storage::disk('public')->exists($product->{$field})) {
                    Storage::disk('public')->delete($product->{$field});
                }
            }
        });
    }

    /**
     * Relasi ke Portfolio
     */
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
