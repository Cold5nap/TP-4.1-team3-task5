<?php

use App\Http\Controllers\Admin\AdminCompositionController;
use App\Http\Controllers\Admin\AdminGoodsController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['role:admin'])->prefix('admin-panel')->group(function () {

    Route::get('/', [AdminHomeController::class,'index']);

    Route::prefix('price-calculation')->group(function (){
        Route::resource('goods',AdminGoodsController::class);
        Route::resource('composition',AdminCompositionController::class);
    });


});

Route::redirect('/', '/goods');

Route::get('/about', [HomeController::class,'about']);

Route::resource('shopping-cart',ShoppingCartController::class)->only([
    'index', 'store', 'destroy'
]);

Route::resource('contacts',ContactController::class)->only([
    'index', 'show', 'store', 'create'
]);

/*Route::resource('goods',GoodsController::class)->only([
    'index', 'show'
]);*/
Auth::routes();
