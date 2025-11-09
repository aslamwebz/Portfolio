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
    public function index(): \Inertia\Response
    {
        $categories = DB::table('hmcategories')
            ->select('id', 'name', 'slug', 'icon')
            ->get()
            ->map(function ($category) {
                $iconValue = $category->icon ?? '';
                $iconData = is_string($iconValue) ? json_decode($iconValue, true) : null;
                $category->icon = is_array($iconData) && isset($iconData['url']) && is_string($iconData['url'])
                    ? $iconData['url']
                    : null;

                return $category;
            });

        $restaurants = DB::table('restaurants')
            ->select('restaurants.*')
            ->join('restaurant_categories', 'restaurants.id', '=', 'restaurant_categories.restaurant_id')
            ->join('hmcategories', 'restaurant_categories.category_id', '=', 'hmcategories.id')
            ->distinct()
            ->get()
            ->map(function ($restaurant) {
                $restaurantId = $restaurant->id ?? 0;

                return [
                    'id' => $restaurant->id ?? null,
                    'name' => $restaurant->name ?? null,
                    'slug' => $restaurant->slug ?? null,
                    'image' => $restaurant->image ?? null,
                    'rating' => 4.5,  // Default value or from your data
                    'deliveryTime' => 30,  // Default value or from your data
                    'minOrder' => 15,  // Default value or from your data
                    'distance' => 2.5,  // Default value or from your data
                    'cuisine' => ['Various'],  // Default value or from your data
                    'categories' => DB::table('restaurant_categories')
                        ->join('hmcategories', 'restaurant_categories.category_id', '=', 'hmcategories.id')
                        ->where('restaurant_id', is_numeric($restaurantId) ? (int) $restaurantId : 0)
                        ->pluck('hmcategories.slug')
                        ->toArray(),
                ];
            });

        return Inertia::render('HeartyMeal/Index', [
            'restaurants' => $restaurants,
            'categories' => $categories,
        ]);
    }

    public function restaurant(int $id): \Illuminate\Http\RedirectResponse|\Inertia\Response
    {
        /** @var object{id?: int, name?: string, image?: string}|null $restaurant */
        $restaurant = DB::table('restaurants')
            ->where('restaurants.id', $id)
            ->first();

        if ($restaurant === null || ! isset($restaurant->id, $restaurant->name)) {
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
            'id' => (int) $restaurant->id,
            'name' => (string) $restaurant->name,
            'image' => $restaurant->image ?? '',
            'rating' => 4.5,  // Default value or from your data
            'cuisine' => is_array($categories) ? $categories : [],
            'deliveryTime' => 30,  // Default value or from your data
        ];

        return Inertia::render('HeartyMeal/Restaurant', [
            'id' => $id,
            'restaurant' => $restaurantData,
            'products' => $products,
        ]);
    }

    public function checkout(): \Inertia\Response
    {
        return Inertia::render('HeartyMeal/Checkout');
    }

    public function orders(): \Inertia\Response
    {
        return Inertia::render('HeartyMeal/Orders');
    }

    public function delivery(int $id): \Inertia\Response
    {
        return Inertia::render('HeartyMeal/Delivery', [
            'id' => $id,
        ]);
    }

    // API endpoint to get restaurant data
    public function getRestaurant(int $id): \Illuminate\Http\JsonResponse|\Inertia\Response
    {
        /** @var object{id?: int, name?: string, image?: string}|null $restaurant */
        $restaurant = DB::table('restaurants')
            ->where('restaurants.id', $id)
            ->first();

        if ($restaurant === null || ! isset($restaurant->id, $restaurant->name)) {
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
            'id' => (int) $restaurant->id,
            'name' => (string) $restaurant->name,
            'image' => $restaurant->image ?? '',
            'rating' => 4.5,  // Default value or from your data
            'cuisine' => is_array($categories) ? $categories : [],
            'deliveryTime' => 30,  // Default value or from your data
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

    public function indexByCategory(string $category): \Illuminate\Http\JsonResponse
    {
        $products = Product::where('category', $category)->get();

        /** @var \Illuminate\Database\Eloquent\Collection<int, Product> $products */
        return response()->json($products);
    }

    public function getCategories(): \Illuminate\Http\JsonResponse
    {
        /** @var \Illuminate\Database\Eloquent\Collection<int, HMCategories> $categories */
        $categories = HMCategories::all();

        return response()->json($categories);
    }

    public function getCategory(string $categoryid): \Illuminate\Http\JsonResponse
    {
        /** @var HMCategories|null $category */
        $category = HMCategories::find($categoryid);

        return response()->json($category);
    }

    public function create(): void
    {
        //
    }

    public function store(Request $request): void
    {
        //
    }

    public function show(string $id): void
    {
        //
    }

    public function edit(string $id): void
    {
        //
    }

    public function update(Request $request, string $id): void
    {
        //
    }

    public function destroy(string $id): void
    {
        //
    }

    public function search(Request $request): \Illuminate\Http\JsonResponse
    {
        $query = $request->input('q');
        $queryStr = is_string($query) ? $query : '';

        if (! $queryStr) {
            return response()->json([
                'restaurants' => [],
                'categories' => [],
            ]);
        }

        // Get restaurants that match the query
        $restaurants = DB::table('restaurants')
            ->select('restaurants.*')
            ->where('restaurants.name', 'like', '%'.$queryStr.'%')
            ->orWhere('restaurants.description', 'like', '%'.$queryStr.'%')
            ->distinct()
            ->limit(5)
            ->get()
            ->map(function ($restaurant) {
                return [
                    'id' => $restaurant->id ?? null,
                    'name' => $restaurant->name ?? null,
                    'slug' => $restaurant->slug ?? null,
                    'image' => $restaurant->image ?? null,
                    'rating' => 4.5,  // Default value or from your data
                    'deliveryTime' => 30,  // Default value or from your data
                    'minOrder' => 15,  // Default value or from your data
                    'distance' => 2.5,  // Default value or from your data
                    'cuisine' => ['Various'],  // Default value or from your data
                ];
            });

        // Get categories that match the query
        $categories = DB::table('hmcategories')
            ->select('id', 'name', 'slug', 'icon')
            ->where('name', 'like', '%'.$queryStr.'%')
            ->limit(3)
            ->get()
            ->map(function ($category) {
                $iconValue = $category->icon ?? '';
                $iconData = is_string($iconValue) ? json_decode($iconValue, true) : null;
                $category->icon = is_array($iconData) ? $iconData['url'] ?? null : null;

                return $category;
            });

        return response()->json([
            'restaurants' => $restaurants,
            'categories' => $categories,
        ]);
    }
}
