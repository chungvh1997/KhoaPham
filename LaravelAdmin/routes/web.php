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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', 'MyController@getLogin')->name('login');
Route::post('login', 'MyController@postLogin')->name('login');
Route::get('register', 'MyController@getRegister')->name('register');
Route::post('register', 'MyController@postRegister')->name('register');
Route::group(['middleware' => 'checkAdminLogin'], function () {
    Route::get('/', 'MyController@index')->name('home');
});

