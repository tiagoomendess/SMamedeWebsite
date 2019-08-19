<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sintetico', 'Web\TurfProjectController@index')->name('turfProjectLandingPage');

Route::domain('sintetico.' . config('custom.app_domain'))->group(function () {
    Route::get('/', 'Web\TurfProjectController@index')->name('turfProjectLandingPage');
});