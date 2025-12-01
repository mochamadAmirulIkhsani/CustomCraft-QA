<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{
    protected $fillable = [
        'name',
        'position',
        'description',
        'photo',
        'social_links',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'social_links' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Scope to get only active team members
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order team members by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'asc');
    }

    /**
     * Boot method to handle file cleanup
     */
    protected static function boot()
    {
        parent::boot();

        // Clean up old photo when updating
        static::updating(function ($team) {
            $original = $team->getOriginal('photo');
            $new = $team->photo;
            
            // If photo is being changed and old file exists, delete it
            if ($original && $original !== $new && Storage::disk('public')->exists($original)) {
                Storage::disk('public')->delete($original);
            }
        });

        // Clean up photo when deleting
        static::deleting(function ($team) {
            if ($team->photo && Storage::disk('public')->exists($team->photo)) {
                Storage::disk('public')->delete($team->photo);
            }
        });
    }
}
