<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', App\Livewire\Pages\Admin\Dashboard::class)->name('dashboard');
    Route::get('products', App\Livewire\Pages\Admin\Products::class)->name('products');
    Route::get('categories', App\Livewire\Pages\Admin\Categories::class)->name('categories');

});
    
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
