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
use App\Models\StoreSetting;

Route::get('/', fn () => response()->file(public_path('vertex.html')))->name('home');

Route::get('/site-header-config', function () {
    $menu = json_decode((string) StoreSetting::get('header_menu', ''), true);
    $default = [
        ['label' => 'Origin', 'url' => '#origin'],
        ['label' => 'Learn how', 'url' => '#learn'],
        ['label' => 'Core Vertex', 'url' => '#core'],
        ['label' => 'Prices', 'url' => '#prices'],
        ['label' => 'Support', 'url' => '#support'],
    ];

    return response()->json([
        'site_name' => StoreSetting::get('site_name', 'VERTEX'),
        'logo_url' => StoreSetting::get('logo_url', ''),
        'menu' => is_array($menu) && $menu ? array_values($menu) : $default,
        'floating_images' => json_decode((string) StoreSetting::get('floating_images', '[]'), true) ?: [],
    ]);
})->name('site.header.config');
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
        Route::post('/settings/slider-image', [AdminController::class, 'sliderImageUpload'])->name('settings.slider-image');
        Route::post('/settings/floating-image', [AdminController::class, 'floatingImageUpload'])->name('settings.floating-image');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::post('/users/{user}/credit', [AdminController::class, 'manualCredit'])->name('users.credit');
        Route::get('/products', [AdminController::class, 'products'])->name('products');
        Route::get('/products/create', [AdminController::class, 'productCreate'])->name('products.create');
        Route::post('/products', [AdminController::class, 'productStore'])->name('products.store');
        Route::get('/products/{product}/edit', [AdminController::class, 'productEdit'])->name('products.edit');
        Route::put('/products/{product}', [AdminController::class, 'productUpdate'])->name('products.update');
        Route::post('/products/{product}/media', [AdminController::class, 'productMediaUpdate'])->name('products.media.update');
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
