<?php

use App\Http\Controllers\DonutController;
use App\Http\Controllers\FrappeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;  // ← Add this line
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Homepage (Welcome Page)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('homepage'); // ✅ name the route so we can redirect to it after logout

/*
|--------------------------------------------------------------------------
| Donuts and Frappes
|--------------------------------------------------------------------------
*/
Route::resource('donuts', DonutController::class);
Route::get('donuts/{donut}/confirm-delete', [DonutController::class, 'showDeleteConfirmation'])->name('donuts.confirm-delete');

Route::resource('frappes', FrappeController::class);
Route::get('frappes/{frappe}/confirm-delete', [FrappeController::class, 'showDeleteConfirmation'])->name('frappes.confirm-delete');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::resource('users', UserController::class);
    
    // Shop routes
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    
    // Cart management (optional - if you want server-side cart handling)
    Route::post('/cart/add', [ShopController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [ShopController::class, 'getCart'])->name('cart.get');
    Route::delete('/cart/clear', [ShopController::class, 'clearCart'])->name('cart.clear');
    Route::post('/checkout', [ShopController::class, 'checkout'])->name('checkout');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
// show login form (if not already registered)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

# override POST /login to use custom logic
Route::post('/login', [AuthController::class, 'login'])->name('login');

# optional: logout route (if you don't already have one)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\ProfileController;

Route::middleware('auth')->get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::middleware('auth')->group(function () {
    // show profile (if you already have it, keep existing)
    // Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

    // edit / update
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});