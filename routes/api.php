<?php

use App\Http\Controllers\HeartyMealController;
use App\Http\Controllers\PdfController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/resume/download', [PdfController::class, 'download']);

// Categories
Route::get('/hearty-meal/categories', [HeartyMealController::class, 'getCategories']);
