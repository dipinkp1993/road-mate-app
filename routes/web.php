<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::view('products/list', 'list-product')
    ->middleware(['auth', 'verified'])
    ->name('products.list');
Route::view('products/create', 'create-product')
    ->middleware(['auth', 'verified'])
    ->name('products.create');
Route::view('products/search', 'search-products')
    ->middleware(['auth', 'verified'])
    ->name('products.search');

require __DIR__.'/auth.php';
