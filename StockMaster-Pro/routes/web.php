<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');



Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin|manager'])
    ->group(function () {
        Route::get('dashboard', App\Livewire\Pages\Admin\Dashboard::class)->name('dashboard');
        Route::get('products', App\Livewire\Pages\Admin\Products::class)->name('products');
        Route::get('categories', App\Livewire\Pages\Admin\Categories::class)->name('categories');
        Route::view('profile', 'livewire.pages.admin.profile')
            ->middleware(['auth'])
            ->name('profile');
});

Route::prefix('Seller')
    ->name('Seller.')
    ->middleware(['auth', 'role:sales'])
    ->group(function () {
        Route::get('dashboard', App\Livewire\Pages\Seller\dashboard::class)->name('dashboard');
        Route::view('profile', 'livewire.pages.Seller.profile')
            ->middleware(['auth'])
            ->name('profile');
    });
    


require __DIR__.'/auth.php';
