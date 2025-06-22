<?php

use App\Http\Controllers\HeartyMealController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioItemController;

Route::get('/resume/download', [PdfController::class, 'download']);

// Categories
Route::get('/hearty-meal/categories', [HeartyMealController::class, 'getCategories']);

Route::get('/restaurants/{id}', [RestaurantController::class, 'show']);

Route::get('/portfolio-items', [PortfolioItemController::class, 'index']);
