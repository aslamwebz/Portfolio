<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

// Products
Route::get('/hearty-meal', function () {
    return Inertia::render('HeartyMeal/Index');
})->name('heartyMeal');

Route::get('/hearty-meal/restaurant/{id}', function ($id) {
    return Inertia::render('HeartyMeal/Restaurant', [
        'id' => $id
    ]);
})->name('restaurant');

Route::get('/hearty-meal/checkout', function () {
    return Inertia::render('HeartyMeal/Components/Checkout');
});

Route::get('/hearty-meal/orders', function () {
    return Inertia::render('HeartyMeal/Components/Orders');
});

Route::get('/hearty-meal/delivery/{orderId}', function ($orderId) {
    return Inertia::render('HeartyMeal/Components/DeliveryTracking', [
        'orderId' => $orderId
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



});

require __DIR__ . '/auth.php';
