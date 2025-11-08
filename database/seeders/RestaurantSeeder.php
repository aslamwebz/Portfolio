<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class RestaurantSeeder extends Seeder
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
        $jsonContent = file_get_contents($jsonPath);

        if ($jsonContent === false) {
            throw new RuntimeException('Failed to load restaurants.json');
        }

        /** 
         * @var array{restaurants: array<array{name: string, image: string, categories: array<string>}>} $data 
         */
        $data = json_decode($jsonContent, true, 512, JSON_THROW_ON_ERROR);

        foreach ($data['restaurants'] as $restaurant) {

            $name = $restaurant['name'];
            $image = $restaurant['image'];
            $categories = $restaurant['categories'];

            // Insert restaurant
            $restaurantId = (int) DB::table('restaurants')->insertGetId([
                'name' => $name,
                'about_us' => 'Welcome to ' . $name,
                'slug' => Str::slug($name),
                'address' => '123 Food Street',
                'working_hours' => json_encode(['monday' => '9:00 AM - 10:00 PM'], JSON_THROW_ON_ERROR),
                'image' => $image,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->createRestaurantCategories($restaurantId, $categories);
        }
    }

    /**
     * Create restaurant category relationships.
     *
     * @param int $restaurantId
     * @param array<string> $categorySlugs
     * @return void
     */
    private function createRestaurantCategories(int $restaurantId, array $categorySlugs): void
    {
        foreach ($categorySlugs as $categorySlug) {
            $category = DB::table('hm_categories')
                ->where('slug', $categorySlug)
                ->first(['id']);

            if ($category !== null && property_exists($category, 'id') && is_numeric($category->id)) {
                DB::table('restaurant_categories')->insert([
                    'restaurant_id' => $restaurantId,
                    'category_id' => (int) $category->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
