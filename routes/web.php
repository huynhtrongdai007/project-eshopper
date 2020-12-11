<?php

use Illuminate\Support\Facades\Route;

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


/*--------------------------------- phần Admin------------------------------------------*/


Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('category')->name('category.')->group(function() {
        Route::get('index','CategoryController@index')->name('index');
        Route::get('create','CategoryController@create')->name('create');
        Route::post('store','CategoryController@store')->name('store');
        Route::get('edit','CategoryController@edit')->name('edit');
        Route::post('update','CategoryController@update')->name('update');
        Route::post('destroy','CategoryController@destroy')->name('destroy');
    });
});


