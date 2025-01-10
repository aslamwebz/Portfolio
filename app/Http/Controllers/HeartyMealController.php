<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HMCategories;
use App\Models\Product;
use Illuminate\Http\Request;

class HeartyMealController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function indexByCategory(string $category)
    {
        $products = Product::where('category', $category)->get();
        return response()->json($products);
    }

    public function getCategories(){
        $categories = HMCategories::all();
        return response()->json($categories);
    }

    public function getCategory(string $categoryid){
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
