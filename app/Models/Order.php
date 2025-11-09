<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $user_id
 * @property float $total_amount
 * @property string $status
 * @property string $payment_status
 * @property array<string, mixed>|null $shipping_address
 * @property array<string, mixed>|null $billing_address
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @method static OrderFactory factory($count = null, $state = [])
 */
class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'payment_status',
        'shipping_address',
        'billing_address',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'shipping_address' => 'array',
        'billing_address' => 'array',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get the user that owns the order.
     *
     * @return BelongsTo<User, Order>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The products that belong to the order.
     *
     * @return BelongsToMany<Product, Order>
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'order_product',
            'order_id',
            'product_id'
        )->withPivot(['quantity', 'price'])
            ->using(OrderProductPivot::class)
            ->withTimestamps();
    }

    /**
     * The factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return OrderFactory::new();
    }
}
