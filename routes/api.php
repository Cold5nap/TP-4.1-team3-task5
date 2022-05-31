<?php

use App\Http\Controllers\api\admin\AdminCategoryController;
use App\Http\Controllers\api\admin\AdminMaterialController;
use App\Http\Controllers\api\admin\AdminProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::/*middleware(['role:admin'])->*/prefix('adm')->group(function () {
    Route::Apiresources([
        'categories'=>AdminCategoryController::class,
    ]);
    Route::resources([
        'materials'=>AdminMaterialController::class,
        'products'=>AdminProductController::class,
    ]);
});


Route::get('/category',[CategoryController::class,'index']);
Route::get('/product',[ProductController::class,'index']);
Route::get('/product/{id}',[ProductController::class,'show']);
Route::get('/material',[MaterialController::class,'index']);
Route::post('/order',[OrderController::class,'makeCustomOrder']);


