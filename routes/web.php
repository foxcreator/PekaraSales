<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Маршруты корзины: Все товары в корзине, добавление, удаление одного, сохранение в БД, очистка корзины.
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{product}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{product}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/clear-cart', [App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');



Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');
    Route::get('/product/create', [App\Http\Controllers\HomeController::class, 'create'])->name('create');
    Route::post('/product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('store');
    Route::post('/product/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('update');
    Route::post('/product/delete/{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('delete');
    Route::post('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('edit');

    Route::get('/products', [\App\Http\Controllers\HomeController::class, 'products'])->name('admin.products');
    Route::get('/products/edit/{id}', [\App\Http\Controllers\HomeController::class, 'edit'])->name('admin.edit');

    Route::get('/reports', [\App\Http\Controllers\HomeController::class, 'todayReport'])->name('admin.reports');
    Route::get('/reports/yesterday', [\App\Http\Controllers\HomeController::class, 'yesterdayReport'])->name('admin.reports.yesterday');
//    Route::get('/reports/monthly', [\App\Http\Controllers\HomeController::class, 'monthlyReport'])->name('admin.reports.monthly');
    Route::get('/reports/monthly', [\App\Http\Controllers\HomeController::class, 'calcMonthlyReport'])->name('admin.reports.calcmonthly');
});
