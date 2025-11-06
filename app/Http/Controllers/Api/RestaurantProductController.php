<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class RestaurantProductController extends Controller
{
    public function index(int $restaurantId): JsonResponse
    {
        $products = Product::where('restaurant_id', $restaurantId)->get();

        return response()->json($products);
    }
}
