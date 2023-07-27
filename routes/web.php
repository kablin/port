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
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::get('/availableproducts', [App\Http\Controllers\ProductController::class, 'available'])->name('available');

Route::post('/createproduct', [App\Http\Controllers\ProductController::class, 'createproduct'])->name('product.create');
Route::post('/getproduct/{product}', [App\Http\Controllers\ProductController::class, 'getproduct'])->name('product.get');
Route::post('/deleteproduct/{product}', [App\Http\Controllers\ProductController::class, 'deleteproduct'])->name('product.delete');
Route::post('/editproduct/{product}', [App\Http\Controllers\ProductController::class, 'editproduct'])->name('product.edit');
Route::post('/storeproduct/{product}', [App\Http\Controllers\ProductController::class, 'storeproduct'])->name('product.store');


});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
