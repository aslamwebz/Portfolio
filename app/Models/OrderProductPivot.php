<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

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
