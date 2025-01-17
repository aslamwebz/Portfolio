<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HMCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Indian Food',
                'slug' => 'indian-food',
                'icon' => ['url' => 'img/HeartyMeal/indian.png'],
            ],
            [
                'name' => 'Salad',
                'slug' => 'salad',
                'icon' => ['url' => 'img/HeartyMeal/salad.png'],
            ],
            [
                'name' => 'Pizza',
                'slug' => 'pizza',
                'icon' => ['url' => 'img/HeartyMeal/pizza.png'],
            ],
            [
                'name' => 'BBQ',
                'slug' => 'bbq',
                'icon' => ['url' => 'img/HeartyMeal/bbq.jpg'],
            ],
            [
                'name' => 'Sandwitch',
                'slug' => 'sandwitch',
                'icon' => ['url' => 'img/HeartyMeal/sandwich.jpg'],
            ],
            [
                'name' => 'Meat',
                'slug' => 'meat',
                'icon' => ['url' => 'img/HeartyMeal/meat.png'],
            ],
            [
                'name' => 'Noodles',
                'slug' => 'noodles',
                'icon' => ['url' => 'img/HeartyMeal/noodles.png'],
            ],
            [
                'name' => 'Sea Food',
                'slug' => 'sea-food',
                'icon' => ['url' => 'img/HeartyMeal/seafood.png'],
            ],
            [
                'name' => 'Sri Lankan',
                'slug' => 'sri-lankan',
                'icon' => ['url' => 'img/HeartyMeal/srilankan.png'],
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\HMCategories::create($category);
        }
    }
}
