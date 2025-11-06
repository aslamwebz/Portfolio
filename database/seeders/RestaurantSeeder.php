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
     */
    public function run(): void
    {
        $jsonContent = file_get_contents(resource_path('js/Pages/HeartyMeal/Components/restaurants.json'));

        if ($jsonContent === false) {
            throw new RuntimeException('Failed to load restaurants.json');
        }

        /** @var array{restaurants: array<array{name: string, image: string, categories: array<string>}>} $data */
        $data = json_decode($jsonContent, true, 512, JSON_THROW_ON_ERROR);

        if (! isset($data['restaurants']) || ! is_array($data['restaurants'])) {
            return;
        }

        foreach ($data['restaurants'] as $restaurant) {
            if (! is_array($restaurant) || ! isset($restaurant['name'], $restaurant['image'], $restaurant['categories'])) {
                continue;
            }

            $name = (string) $restaurant['name'];
            $image = (string) $restaurant['image'];
            $categories = is_array($restaurant['categories']) ? $restaurant['categories'] : [];

            // Insert restaurant
            $restaurantId = DB::table('restaurants')->insertGetId([
                'name' => $name,
                'about_us' => 'Welcome to '.$name,
                'slug' => Str::slug($name),
                'address' => '123 Food Street',
                'working_hours' => json_encode(['monday' => '9:00 AM - 10:00 PM']),
                'image' => $image,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert restaurant categories relationship
            foreach ($categories as $categorySlug) {
                if (! is_string($categorySlug)) {
                    continue;
                }

                $category = DB::table('hm_categories')
                    ->where('slug', $categorySlug)
                    ->first();

                if ($category !== null && isset($category->id)) {
                    DB::table('restaurant_categories')->insert([
                        'restaurant_id' => $restaurantId,
                        'category_id' => $category->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
