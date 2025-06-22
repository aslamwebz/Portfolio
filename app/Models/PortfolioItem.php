<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortfolioItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'link',
        'image',
        'github',
        'technologies',
        'category',
    ];

    protected $casts = [
        'technologies' => 'array',
    ];

    public function getImageAttribute(?string $value): ?string
    {
        if (!$value) {
            return null;
        }

        // If it's already a full URL, return it as is.
        if (str_starts_with($value, 'http')) {
            return $value;
        }

        // For seeded data, return the relative path. The browser will handle it.
        if (str_starts_with($value, '/img/')) {
            return $value;
        }

        // For files uploaded via Filament, create a URL relative to the public storage.
        return asset('storage/' . $value);
    }
}
