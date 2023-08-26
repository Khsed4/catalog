<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CatalogeController;
use App\Http\Controllers\productController;
use App\Http\Controllers\SocialShareButtonsController;
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


Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/admin_prodcuts', [ProductController::class, 'adminProducts'])->name('product.admin');
    Route::get('/admin_catalogues', [ProductController::class, 'adminCatalogues'])->name('catalogues.admin');
    //Product Routes
    Route::get('/products', [ProductController::class, 'products']);
    Route::post('/store-product', [ProductController::class, 'storeProducts']);
    Route::get('/delete-prodcut/{id}', [productController::class, 'deleteProduct']);
    Route::post('/remove-product', [productController::class, 'removeProduct']);
    Route::get('/edit-product/{id}', [productController::class, 'editproduct']);
    Route::put('/update-product', [productController::class, 'updateProduct']);
    Route::get('/toggle-product/{id}', [productController::class, 'toggleProduct']);
    // Cataloge Routes
    Route::post('/add_cataloge', [CatalogeController::class, 'StoreCataloge'])->name('cataloge.store');
    Route::get('/edit-cataloge/{id}', [CatalogeController::class, 'editCatalog'])->name('editCataloge');
    Route::put('/update-cataloge', [CatalogeController::class, 'update']);
    Route::get('/delete-cataloge/{id}', [CatalogeController::class, 'deleteCatalog']);
    Route::get('/cataloges', [CatalogeController::class, 'showCataloges']);
    Route::post('/removedata', [CatalogeController::class, 'remove']);
    // End of Cataloge Routes
    // Route of Categories
    Route::get('/categories', [CategoryController::class, 'showCategories']);
    Route::post('/store-category', [CategoryController::class, 'storeCategory']);
    Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory']);
    Route::post('/remove-category', [CategoryController::class, 'removeCategory']);
    Route::get('/edit-category/{id}', [CategoryController::class, 'editCategory']);
    Route::put('/update-category', [CategoryController::class, 'update']);
});

// End of Category Routes
Route::get('/', [productController::class, 'home']);
Route::get('/share-product', [SocialShareButtonsController::class, 'ShareWidget']);
Route::get('/newproducts', [SocialShareButtonsController::class, 'showShare']);
Route::get('/search-prodcut', [productController::class, 'searchProduct']);
Route::get('/export-product', [productController::class, 'exportProduct']);
Route::get('/filter-category', [productController::class, 'filterCategory']);
