<?php

use Illuminate\Support\Facades\Route;
use Meubleo\Platform\Http\Controllers\ShopController;
use Meubleo\Platform\Http\Controllers\CartController;
use Meubleo\Platform\Http\Controllers\CheckoutController;
use Meubleo\Platform\Http\Controllers\OrderController;

// ─── Public shop ──────────────────────────────────────────────────────────────
Route::get('/',                         [ShopController::class, 'home'])->name('meubleo.home');
Route::get('/boutique',                 [ShopController::class, 'index'])->name('meubleo.products.index');
Route::get('/boutique/{slug}',          [ShopController::class, 'show'])->name('meubleo.products.show');

// ─── Cart ─────────────────────────────────────────────────────────────────────
Route::get('/panier',                   [CartController::class, 'index'])->name('meubleo.cart.index');
Route::post('/panier/ajouter',          [CartController::class, 'add'])->name('meubleo.cart.add');
Route::patch('/panier/{item}',          [CartController::class, 'update'])->name('meubleo.cart.update');
Route::delete('/panier/{item}',         [CartController::class, 'remove'])->name('meubleo.cart.remove');

// ─── Authenticated ────────────────────────────────────────────────────────────
Route::middleware(config('meubleo.middleware.public') + ['auth'])->group(function () {
    Route::get('/commande',             [CheckoutController::class, 'index'])->name('meubleo.checkout.index');
    Route::post('/commande',            [CheckoutController::class, 'process'])->name('meubleo.checkout.process');
    Route::get('/mes-commandes',        [OrderController::class, 'index'])->name('meubleo.orders.index');
    Route::get('/mes-commandes/{order}',[OrderController::class, 'show'])->name('meubleo.orders.show');
    Route::get('/mes-commandes/{order}/confirmation', [OrderController::class, 'confirmation'])
        ->name('meubleo.orders.confirmation');
});
