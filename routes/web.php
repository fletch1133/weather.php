<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/account', 'AccountController@index')->name('account');

    Route::get('/favorites', 'FavoriteController@index')->name('favorites');
    Route::get('/favorites/add', 'FavoriteController@add')->name('favorites.add');
    Route::get('/favorites/remove/{id}', 'FavoriteController@remove')->name('favorites.remove');

    Route::get('/weather/{city}', 'WeatherController@show')->name('weather.show');
});


Route::get('/about', 'PageController@about')->name('about');
Route::get('/contact', 'PageController@contact')->name('contact');


Route::fallback(function () {
    return view('errors.404');
});