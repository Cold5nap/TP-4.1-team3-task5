<?php

use App\Http\Controllers\api\admin\AdminCategoryController;
use App\Http\Controllers\api\admin\AdminMaterialController;
use App\Http\Controllers\api\admin\AdminProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

