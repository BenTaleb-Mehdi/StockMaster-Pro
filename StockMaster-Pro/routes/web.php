<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Admin\StockHistory;
use App\Livewire\Pages\Admin\Products;
use App\Livewire\Pages\Admin\Categories;
use App\Livewire\Pages\Admin\Dashboard;
use App\Livewire\Pages\Admin\Profile;
use App\Livewire\Pages\Admin\SupplierManager;
Route::view('/', 'welcome');



Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin|manager'])
    ->group(function () {
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('products', Products::class)->name('products');
        Route::get('categories', Categories::class)->name('categories');
        Route::view('profile', 'livewire.pages.admin.profile')
            ->middleware(['auth'])
            ->name('profile');
        Route::get('stock-history', StockHistory::class)->name('stock.history');
        Route::get('supplier-manager', SupplierManager::class)->name('manager.suppliers');
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
