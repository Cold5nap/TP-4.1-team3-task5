<?php
use App\Http\Controllers\SpaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::/*middleware(['role:admin'])->*/prefix('adm')->group(function () {
    Route::get('{any}',[SpaController::class,'adminIndex'])->where('any','.*');
});
Route::get('{any}',[SpaController::class,'index'])->where('any','.*');

Auth::routes();

