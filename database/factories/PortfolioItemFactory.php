<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PortfolioItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PortfolioItem>
 */
class PortfolioItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'link' => $this->faker->url(),
            'image' => $this->faker->imageUrl(),
            'github' => $this->faker->url(),
            'technologies' => [],
            'category' => $this->faker->word(),
        ];
    }
}
