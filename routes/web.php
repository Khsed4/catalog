<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanySettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\SocialShareButtonsController;



Auth::routes();

// Admin-only routes (requires authentication and admin role)
Route::middleware(['auth', 'admin'])->group(function () {

    // Product Management Routes
    Route::get('/products', [ProductController::class, 'products']);
    Route::post('/store-product', [ProductController::class, 'storeProducts']);
    Route::get('/delete-prodcut/{id}', [ProductController::class, 'deleteProduct']);
    Route::post('/remove-product', [ProductController::class, 'removeProduct']);
    Route::get('/edit-product/{id}', [ProductController::class, 'editproduct']);
    Route::put('/update-product', [ProductController::class, 'updateProduct']);
    Route::get('/toggle-product/{id}', [ProductController::class, 'toggleProduct']);

    // Category Management Routes
    Route::get('/categories', [CategoryController::class, 'showCategories']);
    Route::post('/store-category', [CategoryController::class, 'storeCategory']);
    Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory']);
    Route::post('/remove-category', [CategoryController::class, 'removeCategory']);
    Route::get('/edit-category/{id}', [CategoryController::class, 'editCategory']);
    Route::put('/update-category', [CategoryController::class, 'update']);

    // Catalogue Management Routes
    Route::get('/catalogues', [CatalogueController::class, 'showCatalogues']);
    Route::post('/store-catalogue', [CatalogueController::class, 'storeCatalogue']);
    Route::get('/delete-catalogue/{id}', [CatalogueController::class, 'deleteCatalogue']);
    Route::post('/remove-catalogue', [CatalogueController::class, 'removeCatalogue']);
    Route::get('/edit-catalogue/{id}', [CatalogueController::class, 'editCatalogue']);
    Route::put('/update-catalogue', [CatalogueController::class, 'updateCatalogue']);

    // Company Settings Routes
    Route::get('/company-settings', [CompanySettingController::class, 'index']);
    Route::post('/company-settings', [CompanySettingController::class, 'store']);

    // User Management Routes
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/store-user', [UserController::class, 'store']);
    Route::get('/edit-user/{id}', [UserController::class, 'edit']);
    Route::put('/update-user', [UserController::class, 'update']);
    Route::get('/delete-user/{id}', [UserController::class, 'delete']);
    Route::post('/remove-user', [UserController::class, 'destroy']);
});


    Route::get('/', [ProductController::class, 'home']);
    Route::get('/search-prodcut', [ProductController::class, 'searchProduct']);
    Route::get('/export-product', [ProductController::class, 'exportProduct']);
    Route::get('/filter-category', [ProductController::class, 'filterCategory']);
    Route::get('/carpets', [ProductController::class, 'carpets']);
    Route::get('/share-product', [SocialShareButtonsController::class, 'ShareWidget']);
    Route::get('/newproducts', [SocialShareButtonsController::class, 'showShare']);

