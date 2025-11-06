<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        if (! $value) {
            return null;
        }

        // If it's already a full URL, extract just the path
        if (str_starts_with($value, 'http')) {
            $parsed = parse_url($value);

            return $parsed['path'] ?? $value; // Return just the path part
        }

        // If it's already a relative path starting with /img/, return as is
        if (str_starts_with($value, '/img/')) {
            return $value;
        }

        // For files uploaded via Filament, return the path relative to public
        if (str_starts_with($value, 'img/')) {
            return '/'.$value; // Ensure leading slash
        }

        // For any other case, assume it's a path relative to storage
        return '/storage/'.mb_ltrim($value, '/');
    }
}
