<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@showGoods')->name("home");
Route::get('/goods/{id}', 'App\Http\Controllers\HomeController@showOneGoods')->name("goods-one");
Route::post('/shopping_cart', 'App\Http\Controllers\HomeController@addToShoppingCart')->name("add-to-shopping-cart");

Route::get('/about', function () {
    return view('about');
})->name("about");

Route::get('/contact', function () {
    return view('contact');
})->name("contact");

Route::post('/contact/submit', 'App\Http\Controllers\ContactController@submit')->name('contact-form');
Route::get('/contact/all', 'App\Http\Controllers\ContactController@allData')->name('contact-data');/*для администраторов*/
Route::get('/contact/all/{id}', 'App\Http\Controllers\ContactController@showOneMessage')->name('contact-data-one');/*для администраторов*/


/*Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/
