<?php

declare(strict_types=1);

use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\HeartyMealController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PortfolioItemController;
use Illuminate\Support\Facades\Route;

Route::get('/resume/download', [PdfController::class, 'download']);

// Categories
Route::get('/hearty-meal/categories', [HeartyMealController::class, 'getCategories']);

Route::get('/restaurants/{id}', [RestaurantController::class, 'show']);

Route::get('/portfolio-items', [PortfolioItemController::class, 'index']);
