<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HMCategories;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;

class HeartyMealController extends Controller
{
    public function index()
    {
        $categories = DB::table('hmcategories')
            ->select('id', 'name', 'slug', 'icon')
            ->get()
            ->map(function ($category) {
                $category->icon = json_decode($category->icon)->url;
                return $category;
            });

        $restaurants = DB::table('restaurants')
            ->select('restaurants.*')
            ->join('restaurant_categories', 'restaurants.id', '=', 'restaurant_categories.restaurant_id')
            ->join('hmcategories', 'restaurant_categories.category_id', '=', 'hmcategories.id')
            ->distinct()
            ->get()
            ->map(function ($restaurant) {
                return [
                    'id' => $restaurant->id,
                    'name' => $restaurant->name,
                    'slug' => $restaurant->slug,
                    'image' => $restaurant->image,
                    'rating' => 4.5, // Default value or from your data
                    'deliveryTime' => 30, // Default value or from your data
                    'minOrder' => 15, // Default value or from your data
                    'distance' => 2.5, // Default value or from your data
                    'cuisine' => ['Various'], // Default value or from your data
                    'categories' => DB::table('restaurant_categories')
                        ->join('hmcategories', 'restaurant_categories.category_id', '=', 'hmcategories.id')
                        ->where('restaurant_id', $restaurant->id)
                        ->pluck('hmcategories.slug')
                        ->toArray()
                ];
            });

        return Inertia::render('HeartyMeal/Components/Dashboard', [
            'initialCategories' => $categories,
            'initialRestaurants' => $restaurants
        ]);
    }

    public function getRestaurant($id)
    {
        $restaurant = DB::table('restaurants')
            ->where('restaurants.id', $id)
            ->first();

        if (!$restaurant) {
            abort(404);
        }

        $categories = DB::table('restaurant_categories')
            ->join('hmcategories', 'restaurant_categories.category_id', '=', 'hmcategories.id')
            ->where('restaurant_id', $id)
            ->pluck('hmcategories.name')
            ->toArray();

        $products = DB::table('products')
            ->join('restaurant_products', 'products.id', '=', 'restaurant_products.product_id')
            ->where('restaurant_products.restaurant_id', $id)
            ->select('products.*')
            ->get();

        $restaurantData = [
            'id' => $restaurant->id,
            'name' => $restaurant->name,
            'image' => $restaurant->image,
            'rating' => 4.5, // Default value or from your data
            'categories' => $categories,
            'deliveryTime' => 30, // Default value or from your data
        ];

        return Inertia::render('HeartyMeal/Components/Restaurant', [
            'restaurant' => $restaurantData,
            'products' => $products
        ]);
    }

    public function indexByCategory(string $category)
    {
        $products = Product::where('category', $category)->get();
        return response()->json($products);
    }

    public function getCategories()
    {
        $categories = HMCategories::all();
        return response()->json($categories);
    }

    public function getCategory(string $categoryid)
    {
        $category = HMCategories::find($categoryid);
        return response()->json($category);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
