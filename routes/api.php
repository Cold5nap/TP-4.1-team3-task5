<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\api\admin\AdminProductController;
use App\Http\Controllers\api\admin\AdminCategoryController;
use App\Http\Controllers\api\admin\AdminMaterialController;

Route::middleware(['role:admin'])->prefix('adm')->group(function () {
    Route::Apiresources([
        'categories' => AdminCategoryController::class,
    ]);
    Route::resources([
        'materials' => AdminMaterialController::class,
        'products' => AdminProductController::class,
    ]);
});
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');


Route::get('/category', [CategoryController::class, 'index']);
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/material', [MaterialController::class, 'index']);
Route::get('/product_by_id', [ProductController::class, 'getByIds']);
Route::post('/order/material', [OrderController::class, 'makeCustomOrder']);
Route::post('/order/product', [OrderController::class, 'makeProductOrder']);
Route::post('/order', [OrderController::class, 'index']);
Route::post('/order/code', [OrderController::class, 'sendCodeOnEmail']);
