<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string|null $about_us
 * @property string $slug
 * @property string|null $address
 * @property string|null $phone
 * @property array<string, mixed>|null $working_hours
 * @property string|null $image
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Restaurant extends Model
{
    /** @use HasFactory<\Database\Factories\RestaurantFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'about_us',
        'slug',
        'address',
        'phone',
        'working_hours',
        'image',
    ];

    protected $casts = [
        'working_hours' => 'array',
    ];

    /**
     * @return BelongsToMany<Product, Restaurant>
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany<HMCategories, Restaurant>
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(HMCategories::class)
            ->withTimestamps();
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $restaurant): void {
            if (empty($restaurant->slug)) {
                $restaurant->slug = Str::slug($restaurant->name);
            }
        });
    }
}
