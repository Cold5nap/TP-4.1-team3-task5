<?php

use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminMaterialController;
use App\Http\Controllers\Admin\AdminBackCallController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\SpaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//admins routes
Route::/*middleware(['role:admin'])->*/prefix('adm')->group(function () {
//запустить сервер проверить добавление материала, изменить добавить название  pivot

//    Route::resource('product',AdminProductController::class);
//    Route::resource('category',AdminCategoryController::class);
//    Route::resource('material',AdminMaterialController::class);
//    Route::resource('order',AdminOrderController::class);
//    Route::resource('back_call',AdminBackCallController::class);
//    Route::resource('user',AdminUserController::class);
//    Route::resource('contact',AdminContactController::class);
//
    Route::get('{any}',[SpaController::class,'adminIndex'])->where('any','.*');
});

//Route::get('/adm/{}',[SpaController::class,'adminIndex']);
//
//users routes
//Route::get('/', [HomeController::class,'index']);
//Route::get('/about', [HomeController::class,'about']);
//Route::resource('shopping-cart',ShoppingCartController::class);
//Route::resource('favorite_product',FavoriteProductController::class);
//Route::resource('order',OrderController::class);
//Route::resource('category',CategoryController::class);
//Route::resource('contact',ContactController::class);
//
Auth::routes();

