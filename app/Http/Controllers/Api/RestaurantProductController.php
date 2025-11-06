<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class RestaurantProductController extends Controller
{
    public function index($restaurantId)
    {
        $products = Product::where('restaurant_id', $restaurantId)->get();

        return response()->json($products);
    }
}
