<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurantsWithMenu = json_decode(file_get_contents(resource_path('js/Pages/HeartyMeal/Components/foods.json')), true)['restaurants'];

        foreach ($restaurantsWithMenu as $restaurant) {
            $restaurantId = DB::table('restaurants')
                ->where('name', $restaurant['name'])
                ->value('id');

            if (!$restaurantId) continue;

            foreach ($restaurant['menuCategories'] as $category) {
                foreach ($category['items'] as $item) {
                    // Insert product
                    $productId = DB::table('products')->insertGetId([
                        'title' => $item['name'],
                        'price' => $item['price'],
                        'description' => $item['description'],
                        'image_name' => $item['image'],
                        'image_path' => '/img/HeartyMeal/Foods/' . $item['image'],
                        'stock' => 100, // Default stock value
                    ]);

                    // Create restaurant-product relationship
                    DB::table('restaurant_products')->insert([
                        'restaurant_id' => $restaurantId,
                        'product_id' => $productId,
                    ]);
                }
            }
        }
    }
}
