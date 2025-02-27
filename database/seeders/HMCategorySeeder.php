<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HMCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'All',
                'slug' => 'all',
                'icon' => json_encode(['url' => 'https://img.icons8.com/color/96/000000/restaurant.png'])
            ],
            [
                'name' => 'Pizza',
                'slug' => 'pizza',
                'icon' => json_encode(['url' => 'https://img.icons8.com/color/96/000000/pizza.png'])
            ],
            [
                'name' => 'Burgers',
                'slug' => 'burgers',
                'icon' => json_encode(['url' => 'https://img.icons8.com/color/96/000000/hamburger.png'])
            ],
            [
                'name' => 'Asian',
                'slug' => 'asian',
                'icon' => json_encode(['url' => 'https://img.icons8.com/color/96/000000/sushi.png'])
            ],
            [
                'name' => 'Indian',
                'slug' => 'indian',
                'icon' => json_encode(['url' => 'https://img.icons8.com/color/96/000000/curry.png'])
            ],
            [
                'name' => 'Mexican',
                'slug' => 'mexican',
                'icon' => json_encode(['url' => 'https://img.icons8.com/color/96/000000/taco.png'])
            ],
            [
                'name' => 'Italian',
                'slug' => 'italian',
                'icon' => json_encode(['url' => 'https://img.icons8.com/color/96/000000/spaghetti.png'])
            ],
            [
                'name' => 'Healthy',
                'slug' => 'healthy',
                'icon' => json_encode(['url' => 'https://img.icons8.com/color/96/000000/salad.png'])
            ],
            [
                'name' => 'Desserts',
                'slug' => 'desserts',
                'icon' => json_encode(['url' => 'https://img.icons8.com/color/96/000000/cake.png'])
            ]
        ];

        DB::table('hmcategories')->insert($categories);
    }
}
