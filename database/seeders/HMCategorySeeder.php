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
                'icon' => ['url' => 'indian.png'],
            ],
            [
                'name' => 'Salad',
                'slug' => 'salad',
                'icon' => ['url' => 'salad.png'],
            ],
            [
                'name' => 'Pizza',
                'slug' => 'pizza',
                'icon' => ['url' => 'pizza.png'],
            ],
            [
                'name' => 'BBQ',
                'slug' => 'bbq',
                'icon' => ['url' => 'bbq.png'],
            ],
            [
                'name' => 'Sandwitch',
                'slug' => 'sandwitch',
                'icon' => ['url' => 'sandwitch.png'],
            ],
            [
                'name' => 'Meat',
                'slug' => 'meat',
                'icon' => ['url' => 'meat.png'],
            ],
            [
                'name' => 'Noodles',
                'slug' => 'noodles',
                'icon' => ['url' => 'noodles.png'],
            ],
            [
                'name' => 'Sea Food',
                'slug' => 'sea-food',
                'icon' => ['url' => 'seafood.png'],
            ],
            [
                'name' => 'Sea Food',
                'slug' => 'sea-food',
                'icon' => ['url' => 'seafood.png'],
            ],
            [
                'name' => 'Sri Lankan',
                'slug' => 'sri-lankan',
                'icon' => ['url' => 'srilankan.png'],
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\HMCategories::create($category);
        }
    }
}
