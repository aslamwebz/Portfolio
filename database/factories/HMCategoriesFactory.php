<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\HMCategories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HMCategories>
 */
class HMCategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'icon' => json_encode(['url' => 'img/HeartyMeal/Categories/default.png']),
        ];
    }
}
