<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name("home");

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
