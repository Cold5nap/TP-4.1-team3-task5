<?php

use App\Http\Controllers\api\admin\AdminCategoryController;
use App\Http\Controllers\api\admin\AdminMaterialController;
use App\Http\Controllers\api\admin\AdminProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::Apiresources([
    'categories'=>AdminCategoryController::class,
]);

Route::resources([
    'materials'=>AdminMaterialController::class,
    'products'=>AdminProductController::class,
]);


