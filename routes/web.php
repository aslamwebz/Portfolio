<?php

declare(strict_types=1);

use App\Http\Controllers\AIController;
use App\Http\Controllers\HeartyMealController;
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

// Redirect /register to login page
Route::get('/register', function () {
    return redirect()->route('login');
});

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

// Products
Route::get('/hearty-meal', [HeartyMealController::class, 'index'])->name('hearty-meal.index');
Route::get('/hearty-meal/restaurant/{id}', [HeartyMealController::class, 'restaurant'])->name('hearty-meal.restaurant');

Route::get('/hearty-meal/checkout', function () {
    return Inertia::render('HeartyMeal/Components/Checkout');
});

Route::get('/hearty-meal/orders', function () {
    return Inertia::render('HeartyMeal/Components/Orders');
});

Route::get('/hearty-meal/delivery/{orderId}', function ($orderId) {
    return Inertia::render('HeartyMeal/Components/DeliveryTracking', [
        'orderId' => $orderId,
    ]);
});

Route::get('/ai', function () {
    return Inertia::render('AI/Dashboard');
})->name('ai');

Route::post('/ai/chat', [AIController::class, 'chat'])->name('ai.chat');

Route::get('/ai/rate-limit', [AIController::class, 'checkRateLimit'])->name('ai.rateLimit');

Route::get('/ai/conversations', [AIController::class, 'getConversations'])->name('ai.conversations');

Route::post('/ai/conversations', [AIController::class, 'saveConversation'])->name('ai.saveConversation');

Route::post('/ai/generate-image', [AIController::class, 'generateImage'])->name('ai.generateImage');

Route::post('/ai/emoji-generator', [AIController::class, 'emojiGenerator']);

Route::post('/ai/color-palette', [AIController::class, 'colorPalette'])->name('ai.colorPalette');

Route::post('/ai/name-generator', [AIController::class, 'nameGenerator'])->name('ai.nameGenerator');
Route::post('/ai/check-domains', [AIController::class, 'checkDomains'])->name('ai.checkDomains');

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/api/restaurants/{id}', [HeartyMealController::class, 'getRestaurant'])->name('api.restaurants.show');

Route::get('/api/search', [HeartyMealController::class, 'search']);

require __DIR__.'/auth.php';
