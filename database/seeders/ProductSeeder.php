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
     *
     * @return void
     * @throws \JsonException
     */
    public function run(): void
    {
        $jsonPath = resource_path('js/Pages/HeartyMeal/Components/restaurants.json');

        if (!file_exists($jsonPath)) {
            throw new RuntimeException('Restaurants JSON file not found');
        }

        $jsonContent = file_get_contents($jsonPath);

        if ($jsonContent === false) {
            throw new RuntimeException('Failed to read restaurants JSON file');
        }

        /** @var array{restaurants?: array<array{name?: mixed, menu?: array<array{items?: array<array{name?: mixed, price?: mixed, description?: mixed, image?: mixed}>}>}>} $data */
        $data = json_decode($jsonContent, true, 512, JSON_THROW_ON_ERROR);

        if (!isset($data['restaurants']) || !is_array($data['restaurants'])) {
            return;
        }

        foreach ($data['restaurants'] as $restaurant) {
            if (!is_array($restaurant) || !isset($restaurant['name']) || !is_string($restaurant['name'])) {
                continue;
            }

            $restaurantId = DB::table('restaurants')
                ->where('name', $restaurant['name'])
                ->value('id');

            if (!is_numeric($restaurantId)) {
                continue;
            }

            if (!isset($restaurant['menu']) || !is_array($restaurant['menu'])) {
                continue;
            }

            $menu = $restaurant['menu'];
            $menuItems = is_array($menu) ? $menu : [];
            $this->processRestaurantMenu((int)$restaurantId, $menuItems);
        }
    }

    /**
     * Process the restaurant menu and create products.
     *
     * @param int $restaurantId
     * @param array<int, array{items?: array<int, array{name?: mixed, price?: mixed, description?: mixed, image?: mixed}>}> $menu
     * @return void
     */
    private function processRestaurantMenu(int $restaurantId, array $menu): void
    {
        foreach ($menu as $category) {
            if (!is_array($category) || !isset($category['items']) || !is_array($category['items'])) {
                continue;
            }

            foreach ($category['items'] as $item) {
                if (!is_array($item) || 
                    !isset($item['name'], $item['price'], $item['description'], $item['image']) ||
                    !is_string($item['name']) ||
                    !is_numeric($item['price']) ||
                    !is_string($item['description']) ||
                    !is_string($item['image'])) {
                    continue;
                }

                $name = $item['name'];
                $price = (float)$item['price'];
                $description = $item['description'];
                $image = $item['image'];

                $this->createProduct($restaurantId, $name, $price, $description, $image);
            }
        }
    }

    /**
     * Create a product and its relationship with the restaurant.
     *
     * @param int $restaurantId
     * @param string $name
     * @param float $price
     * @param string $description
     * @param string $image
     * @return void
     */
    private function createProduct(int $restaurantId, string $name, float $price, string $description, string $image): void
    {
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

        DB::table('restaurant_products')->insert([
            'restaurant_id' => $restaurantId,
            'product_id' => $productId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
