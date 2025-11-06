<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = resource_path('js/Pages/HeartyMeal/Components/restaurants.json');

        if (! file_exists($jsonPath)) {
            throw new RuntimeException('Restaurants JSON file not found');
        }

        $jsonContent = file_get_contents($jsonPath);

        if ($jsonContent === false) {
            throw new RuntimeException('Failed to read restaurants JSON file');
        }

        /** @var array{restaurants: array<array{name: string, menu?: array<array{items?: array<array{name: string, price: float, description: string, image: string}>}>>} $data */
        $data = json_decode($jsonContent, true, 512, JSON_THROW_ON_ERROR);

        if (! isset($data['restaurants']) || ! is_array($data['restaurants'])) {
            return;
        }

        foreach ($data['restaurants'] as $restaurant) {
            if (! is_array($restaurant) || ! isset($restaurant['name'])) {
                continue;
            }

            $restaurantId = DB::table('restaurants')
                ->where('name', (string) $restaurant['name'])
                ->value('id');

            if (! is_numeric($restaurantId)) {
                continue;
            }

            if (! isset($restaurant['menu']) || ! is_array($restaurant['menu'])) {
                continue;
            }

            foreach ($restaurant['menu'] as $category) {
                if (! is_array($category) || ! isset($category['items']) || ! is_array($category['items'])) {
                    continue;
                }

                foreach ($category['items'] as $item) {
                    if (! is_array($item) || ! isset($item['name'], $item['price'], $item['description'], $item['image'])) {
                        continue;
                    }

                    $name = (string) $item['name'];
                    $price = (float) $item['price'];
                    $description = (string) $item['description'];
                    $image = (string) $item['image'];

                    // Insert product
                    $productId = DB::table('products')->insertGetId([
                        'title' => $name,
                        'slug' => Str::slug($name),
                        'price' => $price,
                        'description' => $description,
                        'image' => $image,
                        'stock' => 100, // Default stock value
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Create restaurant-product relationship
                    DB::table('restaurant_products')->insert([
                        'restaurant_id' => $restaurantId,
                        'product_id' => $productId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
