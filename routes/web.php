<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [\App\Http\Controllers\DashboardController::class, 'front_index'])->name('front_index');
Route::get('/product/{id}', [\App\Http\Controllers\DashboardController::class, 'single_product'])->name('front_single_product');
Route::post('/save_order', [\App\Http\Controllers\DashboardController::class, 'save_order'])->name('front.save_order');

Route::middleware(['auth:sanctum', 'verified'])->prefix('dashboard')->group(function () {

   Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', \App\Http\Livewire\Profile::class)->name('dashboard.profile');

    /* start   product type link */
    Route::get('type', \App\Http\Livewire\TypeLivewire::class)->name('dashboard.type');
    Route::get('/type/create', \App\Http\Livewire\TypeFormLivewire::class)->name('dashboard.type.create');
    Route::get('/type/{id}/edit', \App\Http\Livewire\TypeFormLivewire::class)->name('dashboard.type.edit');
    /* end    product type link */

    /* start   product  link */
    Route::get('product', \App\Http\Livewire\ProductLivewire::class)->name('dashboard.product');
    Route::get('/product/create', \App\Http\Livewire\ProductFormLivewire::class)->name('dashboard.product.create');
    Route::get('/product/{id}/edit', \App\Http\Livewire\ProductFormLivewire::class)->name('dashboard.product.edit');
    /* end    product  link */

    /* start   attributes  link */
    Route::get('attribute', \App\Http\Livewire\AttributeLivewire::class)->name('dashboard.attribute');
    Route::get('/attribute/create', \App\Http\Livewire\AttributeFormLivewire::class)->name('dashboard.attribute.create');
    Route::get('/attribute/{id}/edit', \App\Http\Livewire\AttributeFormLivewire::class)->name('dashboard.attribute.edit');
    /* end    attributes  link */





});



Route::get('/clear-cache-all', function() {
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');

});






