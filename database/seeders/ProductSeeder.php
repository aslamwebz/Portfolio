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
        DB::table('products')->insert([
            [
                'title' => 'Apple iPhone 13',
                'price' => 999.99,
                'description' => 'The latest iPhone with A15 Bionic chip, 6.1-inch display, and advanced dual-camera system.',
                'image_name' => 'iphone_13.jpg',
                'image_path' => 'images/products/iphone_13.jpg',
                'stock' => 50,
            ],
            [
                'title' => 'Samsung Galaxy S21',
                'price' => 849.99,
                'description' => 'The Samsung Galaxy S21 features a 6.2-inch display, Exynos 2100, and a triple-camera setup.',
                'image_name' => 'galaxy_s21.jpg',
                'image_path' => 'images/products/galaxy_s21.jpg',
                'stock' => 75,
            ],
            [
                'title' => 'Sony WH-1000XM4',
                'price' => 349.99,
                'description' => 'Industry-leading noise cancelling headphones with premium sound quality and long battery life.',
                'image_name' => 'sony_wh_1000xm4.jpg',
                'image_path' => 'images/products/sony_wh_1000xm4.jpg',
                'stock' => 120,
            ],
            [
                'title' => 'Dell XPS 13',
                'price' => 1199.99,
                'description' => 'Compact and powerful ultrabook with a 13.4-inch display, Intel Core i7, and 16GB RAM.',
                'image_name' => 'dell_xps_13.jpg',
                'image_path' => 'images/products/dell_xps_13.jpg',
                'stock' => 30,
            ],
            [
                'title' => 'Apple Watch Series 7',
                'price' => 399.99,
                'description' => 'The newest Apple Watch with a larger display, new health features, and faster charging.',
                'image_name' => 'apple_watch_series_7.jpg',
                'image_path' => 'images/products/apple_watch_series_7.jpg',
                'stock' => 90,
            ],
        ]);
    }
}
