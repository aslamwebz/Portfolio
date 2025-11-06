<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function show($id)
    {
        $restaurant = Restaurant::with(['products.categories'])->findOrFail($id);

        // Group products by category
        $menuCategories = [];
        foreach ($restaurant->products as $product) {
            foreach ($product->categories as $category) {
                if (! isset($menuCategories[$category->id])) {
                    $menuCategories[$category->id] = [
                        'id' => $category->id,
                        'name' => $category->name,
                        'items' => [],
                    ];
                }
                $menuCategories[$category->id]['items'][] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'image' => $product->image_path,
                ];
            }
        }

        return response()->json([
            'restaurant' => [
                'id' => $restaurant->id,
                'name' => $restaurant->name,
                'image' => $restaurant->image_path,
                'rating' => $restaurant->rating,
                'cuisine' => $restaurant->cuisine,
                'deliveryTime' => $restaurant->delivery_time,
            ],
            'menuCategories' => array_values($menuCategories),
        ]);
    }
}
