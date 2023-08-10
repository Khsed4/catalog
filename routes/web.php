<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();
Route::get('/', [App\Http\Controllers\ProductController::class, 'products']);
Route::get('/out', [App\Http\Controllers\ProductController::class, 'outOfStock']);
Route::middleware('auth')->group(function(){
    Route::get('/admin_prodcuts', [App\Http\Controllers\ProductController::class, 'adminProducts'])->name('product.admin');
    Route::get('/admin_catalogues', [App\Http\Controllers\ProductController::class, 'adminCatalogues'])->name('catalogues.admin');
});

Route::get('/dinner', [App\Http\Controllers\ProductController::class, 'dinner']);
Route::get('/print', [App\Http\Controllers\ProductController::class, 'print_products']);
Route::get('/products', [App\Http\Controllers\ProductController::class, 'addProducts']);
Route::post('/products', [App\Http\Controllers\ProductController::class, 'StoreProduct'])->name('product.store');
Route::get('/home', [App\Http\Controllers\ProductController::class, 'home']);
?>
