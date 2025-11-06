<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\HMCategories;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

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
                        ->toArray(),
                ];
            });

        return Inertia::render('HeartyMeal/Index', [
            'restaurants' => $restaurants,
            'categories' => $categories,
        ]);
    }

    public function restaurant($id)
    {
        $restaurant = DB::table('restaurants')
            ->where('restaurants.id', $id)
            ->first();

        if (! $restaurant) {
            return redirect('/hearty-meal')->with('error', 'Restaurant not found');
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
            'cuisine' => $categories,
            'deliveryTime' => 30, // Default value or from your data
        ];

        return Inertia::render('HeartyMeal/Restaurant', [
            'id' => $id,
            'restaurant' => $restaurantData,
            'products' => $products,
        ]);
    }

    public function checkout()
    {
        return Inertia::render('HeartyMeal/Checkout');
    }

    public function orders()
    {
        return Inertia::render('HeartyMeal/Orders');
    }

    public function delivery($id)
    {
        return Inertia::render('HeartyMeal/Delivery', [
            'id' => $id,
        ]);
    }

    // API endpoint to get restaurant data
    public function getRestaurant($id)
    {
        $restaurant = DB::table('restaurants')
            ->where('restaurants.id', $id)
            ->first();

        if (! $restaurant) {
            return response()->json(['error' => 'Restaurant not found'], 404);
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
            'cuisine' => $categories,
            'deliveryTime' => 30, // Default value or from your data
        ];

        // Check if this is an API request
        if (request()->expectsJson() || request()->ajax()) {
            // Group products by category for API response
            $menuCategories = [];
            $groupedProducts = [];

            foreach ($products as $product) {
                $category = $product->category ?? 'Other';
                if (! isset($groupedProducts[$category])) {
                    $groupedProducts[$category] = [];
                }
                $groupedProducts[$category][] = $product;
            }

            foreach ($groupedProducts as $category => $items) {
                $menuCategories[] = [
                    'name' => $category,
                    'items' => $items,
                ];
            }

            return response()->json([
                'restaurant' => $restaurantData,
                'menuCategories' => $menuCategories,
            ]);
        }

        // For regular page visits, return Inertia response
        return Inertia::render('HeartyMeal/Restaurant', [
            'id' => $id,
            'restaurant' => $restaurantData,
            'products' => $products,
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

    public function search(Request $request)
    {
        $query = $request->input('q');

        if (! $query) {
            return response()->json([
                'restaurants' => [],
                'categories' => [],
            ]);
        }

        // Get restaurants that match the query
        $restaurants = DB::table('restaurants')
            ->select('restaurants.*')
            ->where('restaurants.name', 'like', "%{$query}%")
            ->orWhere('restaurants.description', 'like', "%{$query}%")
            ->distinct()
            ->limit(5)
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
                ];
            });

        // Get categories that match the query
        $categories = DB::table('hmcategories')
            ->select('id', 'name', 'slug', 'icon')
            ->where('name', 'like', "%{$query}%")
            ->limit(3)
            ->get()
            ->map(function ($category) {
                $category->icon = json_decode($category->icon)->url;

                return $category;
            });

        return response()->json([
            'restaurants' => $restaurants,
            'categories' => $categories,
        ]);
    }
}
