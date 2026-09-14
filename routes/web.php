<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductFieldController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StoreController::class, 'home'])->name('home');
Route::get('/products/{product}', [StoreController::class, 'product'])->name('product.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware('guest')->group(function () {
    Route::get('/auth', [AuthController::class, 'showAuth'])->name('auth');
    Route::post('/auth', [AuthController::class, 'identify'])->name('auth.identify');
    Route::post('/auth/complete', [AuthController::class, 'completeRegistration'])->name('auth.complete');

    Route::redirect('/login', '/auth')->name('login');
    Route::redirect('/register', '/auth')->name('register');
});

Route::middleware('auth')->group(function () {
    Route::post('/products/{product}/purchase', [PurchaseController::class, 'store'])->name('product.purchase');

    Route::prefix('account')->name('account.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/transactions', [DashboardController::class, 'transactions'])->name('transactions');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
        Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
        Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
        Route::post('/tickets/{ticket}/reply', [TicketController::class, 'reply'])->name('tickets.reply');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::put('/settings', [AdminController::class, 'settingsUpdate'])->name('settings.update');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::post('/users/{user}/credit', [AdminController::class, 'manualCredit'])->name('users.credit');
        Route::get('/products', [AdminController::class, 'products'])->name('products');
        Route::get('/products/create', [AdminController::class, 'productCreate'])->name('products.create');
        Route::post('/products', [AdminController::class, 'productStore'])->name('products.store');
        Route::get('/products/{product}/edit', [AdminController::class, 'productEdit'])->name('products.edit');
        Route::put('/products/{product}', [AdminController::class, 'productUpdate'])->name('products.update');
        Route::post('/products/{product}/toggle', [AdminController::class, 'productToggle'])->name('products.toggle');
        Route::post('/products/{product}/fields', [AdminProductFieldController::class, 'store'])->name('products.fields.store');
        Route::delete('/product-fields/{field}', [AdminProductFieldController::class, 'destroy'])->name('products.fields.destroy');
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
        Route::post('/categories', [AdminController::class, 'categoryStore'])->name('categories.store');
        Route::get('/categories/{category}/edit', [AdminController::class, 'categoryEdit'])->name('categories.edit');
        Route::put('/categories/{category}', [AdminController::class, 'categoryUpdate'])->name('categories.update');
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        Route::put('/orders/{order}', [AdminController::class, 'orderUpdate'])->name('orders.update');
        Route::get('/tickets', [AdminController::class, 'tickets'])->name('tickets');
        Route::put('/tickets/{ticket}', [AdminController::class, 'ticketUpdate'])->name('tickets.update');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
