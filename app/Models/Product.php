<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property float $price
 * @property string|null $image
 * @property int $stock
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @method static ProductFactory factory($count = null, $state = [])
 *
 */
class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
        'stock',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    /**
     * The restaurants that belong to the product.
     *
     * @return BelongsToMany<Restaurant, Product>
     */
    public function restaurants(): BelongsToMany
    {
        return $this->belongsToMany(
            Restaurant::class,
            'restaurant_products',
            'product_id',
            'restaurant_id'
        )->withTimestamps();
    }

    /**
     * The orders that belong to the product.
     *
     * @return BelongsToMany<Order, Product>
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(
            Order::class,
            'order_product',
            'product_id',
            'order_id'
        )->withPivot(['quantity', 'price'])
            ->using(OrderProductPivot::class)
            ->withTimestamps();
    }

    /**
     * The categories that belong to the product.
     *
     * @return BelongsToMany<HMCategories, Product>
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            HMCategories::class,
            'category_product',
            'product_id',
            'category_id'
        )->withTimestamps();
    }

    /**
     * The factory instance for the model.
     *
     * @return Factory<Product>
     */
    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $product): void {
            if (empty($product->slug) && ! empty($product->name)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
}

/**
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class OrderProductPivot extends Pivot
{
    /** @var array<string, string> */
    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];
}
