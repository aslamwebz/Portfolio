<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\HMCategoriesFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property array<string, mixed>|null $icon
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class HMCategories extends Model
{
    /** @use HasFactory<\Database\Factories\HMCategoriesFactory> */
    use HasFactory;

    protected $table = 'hmcategories';

    protected $fillable = ['name', 'slug', 'icon'];

    protected $casts = [
        'icon' => 'array',
    ];

    /**
     * @return BelongsToMany<Restaurant, HMCategories>
     */
    public function restaurants(): BelongsToMany
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_categories', 'category_id', 'restaurant_id');
    }

    /**
     * @return BelongsToMany<Product, HMCategories>
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return HMCategoriesFactory::new();
    }
}
