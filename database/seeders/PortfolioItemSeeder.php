<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PortfolioItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('portfolio_items')->delete();

        $projects = [
            [
                'title' => 'Hearty Meal',
                'description' => 'An innovative food ordering platform that connects local restaurants with hungry customers. Features include real-time order tracking, customizable menus, and a seamless checkout process.',
                'link' => '/hearty-meal',
                'image' => '/img/hm-main.png',
                'github' => 'https://github.com/aslamwebz/Portfolio/tree/main/resources/js/Pages/HeartyMeal',
                'technologies' => ['php', 'laravel', 'vue', 'tailwind'],
                'category' => 'Vue',
            ],
            [
                'title' => 'Developer Portfolio',
                'description' => 'My personal portfolio website built with modern technologies to showcase my projects and skills in an interactive way.',
                'link' => '/',
                'image' => '/img/portfolio-main.png',
                'github' => 'https://github.com/aslamwebz/portfolio',
                'technologies' => ['php', 'laravel', 'vue', 'tailwind'],
                'category' => 'Vue',
            ],
            [
                'title' => 'AI Projects',
                'description' => 'A collection of AI projects using Python and Crew AI that use AI to enhance functionality and user experiences.',
                'link' => null,
                'image' => '/img/ai-main.png',
                'github' => 'https://github.com/aslamwebz/ai',
                'technologies' => ['python', 'crewai', 'Ollama', 'openai', 'streamlit'],
                'category' => 'AI',
            ],
            [
                'title' => 'AI Laravel Projects',
                'description' => 'A collection of Laravel projects that use AI to enhance functionality and user experiences.',
                'link' => '/ai',
                'image' => '/img/ai-main.png',
                'github' => 'https://github.com/aslamwebz/Portfolio/blob/dev/app/Http/Controllers/AIController.php',
                'technologies' => ['laravel', 'vue', 'openai', 'tailwind'],
                'category' => 'AI',
            ],
        ];

        foreach ($projects as $project) {
            PortfolioItem::create($project);
        }
    }
}
