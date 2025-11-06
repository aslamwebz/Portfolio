<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

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
 *
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory;

    /** @var array<int, string> */
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
     * @return BelongsTo<User, self>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The products that belong to the order.
     *
     * @return BelongsToMany<Product>
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
     *
     * @return OrderFactory<self>
     */
    protected static function newFactory(): Factory
    {
        return OrderFactory::new();
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
