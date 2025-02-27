<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RestaurentSeeder extends Seeder
{
    public function run()
    {
        $restaurants = json_decode(file_get_contents(resource_path('js/Pages/HeartyMeal/Components/restaurants.json')), true)['restaurants'];

        foreach ($restaurants as $restaurant) {
            // Insert restaurant
            $restaurantId = DB::table('restaurents')->insertGetId([
                'name' => $restaurant['name'],
                'about us' => 'Welcome to ' . $restaurant['name'],
                'slug' => Str::slug($restaurant['name']),
                'address' => '123 Food Street',
                'working hours' => '9:00 AM - 10:00 PM',
                'image' => $restaurant['image'],
            ]);

            // Insert restaurant categories relationship
            foreach ($restaurant['categories'] as $categorySlug) {
                $category = DB::table('hmcategories')
                    ->where('slug', $categorySlug)
                    ->first();

                if ($category) {
                    DB::table('restaurent_categories')->insert([
                        'restaurent_id' => $restaurantId,
                        'category_id' => $category->id
                    ]);
                }
            }
        }
    }
}
