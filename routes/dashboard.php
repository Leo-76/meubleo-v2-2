<?php

use Illuminate\Support\Facades\Route;
use Meubleo\Platform\Http\Screens\DashboardScreen;
use Meubleo\Platform\Http\Screens\ProductListScreen;
use Meubleo\Platform\Http\Screens\ProductEditScreen;

// ─── Dashboard ────────────────────────────────────────────────────────────────
Route::screen('/', DashboardScreen::class)
    ->name('meubleo.admin.dashboard');

// ─── Products ─────────────────────────────────────────────────────────────────
Route::screen('/products', ProductListScreen::class)
    ->name('meubleo.admin.products');

Route::screen('/products/create', ProductEditScreen::class)
    ->name('meubleo.admin.products.create');

Route::screen('/products/{product}/edit', ProductEditScreen::class)
    ->name('meubleo.admin.products.edit');
