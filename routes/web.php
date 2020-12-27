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

Route::get('/','HomeController@index');


Route::get('home','HomeController@index')->name('home');

Route::get('login','HomeController@login')->name('login');

Route::get('cart','HomeController@cart')->name('cart');

Route::get('checkout','HomeController@checkout')->name('checkout');

Route::get('contact','HomeController@contact')->name('contact-us');

Route::get('/category/{slug}/{id}','HomeController@category')->name('category');

Route::get('/brand/{slug}/{id}','HomeController@brand')->name('brand');

Route::get('product-details/{slug}/{id}','HomeController@productDetails')->name('product-details');

Route::get('/AddCart/{id}','CartController@AddCart')->name('AddCart');

Route::get('Delete-Cart/{id}','CartController@DeleteItemCart')->name('DeleteCart');
/*--------------------------------- phần Admin------------------------------------------*/


Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('login','UserController@login')->name('login');
    Route::post('progressLogin','UserController@progressLogin')->name('progressLogin');
    Route::get('logout','UserController@logout')->name('logout');
 
 Route::middleware('check_login')->group(function() {
     
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('category')->name('category.')->group(function() {
        Route::middleware('can:category-list')->group(function() {
            Route::get('index','CategoryController@index')->name('index');
        });
        Route::middleware('can:category-create')->group(function() {
           Route::get('create','CategoryController@create')->name('create');
        });
        Route::post('store','CategoryController@store')->name('store');
        Route::middleware('can:category-update')->group(function() {
             Route::get('edit/{id}','CategoryController@edit')->name('edit');
        });
        Route::post('update/{id}','CategoryController@update')->name('update');
        Route::middleware('can:category-delete')->group(function() {
             Route::get('destroy/{id}','CategoryController@destroy')->name('destroy');
        });
    });

    Route::prefix('brand')->name('brand.')->group(function() {
        Route::get('index','BrandController@index')->name('index');
        Route::get('create','BrandController@create')->name('create');
        Route::post('store','BrandController@store')->name('store');
        Route::get('edit/{id}','BrandController@edit')->name('edit');
        Route::post('update/{id}','BrandController@update')->name('update');
        Route::get('destroy/{id}','BrandController@destroy')->name('destroy');
    });

    Route::prefix('user')->name('user.')->group(function() {
        Route::get('index','UserController@index')->name('index');
        Route::get('create','UserController@create')->name('create');
        Route::post('store','UserController@store')->name('store');
        Route::get('edit/{id}','UserController@edit')->name('edit');
        Route::post('update/{id}','UserController@update')->name('update');
        Route::get('destroy/{id}','UserController@destroy')->name('destroy');
    });

    Route::prefix('slide')->name('slide.')->group(function() {
        Route::get('index','SlideController@index')->name('index');
        Route::get('create','SlideController@create')->name('create');
        Route::post('store','SlideController@store')->name('store');
        Route::get('edit/{id}','SlideController@edit')->name('edit');
        Route::post('update/{id}','SlideController@update')->name('update');
        Route::get('destroy/{id}','SlideController@destroy')->name('destroy');
    });

    Route::prefix('product')->name('product.')->group(function() {
        Route::get('index','ProductController@index')->name('index');
        Route::get('create','ProductController@create')->name('create');
        Route::post('store','ProductController@store')->name('store');
        Route::get('edit/{id}','ProductController@edit')->name('edit');
        Route::post('update/{id}','ProductController@update')->name('update');
        Route::get('destroy/{id}','ProductController@destroy')->name('destroy');
    });

    Route::prefix('setting')->name('setting.')->group(function() {
        Route::get('index','SettingController@index')->name('index');
        Route::get('create','SettingController@create')->name('create');
        Route::post('store','SettingController@store')->name('store');
        Route::get('edit/{id}','SettingController@edit')->name('edit');
        Route::post('update/{id}','SettingController@update')->name('update');
        Route::get('destroy/{id}','SettingController@destroy')->name('destroy');
    });

    Route::prefix('role')->name('role.')->group(function() {
        Route::get('index','RoleController@index')->name('index');
        Route::get('create','RoleController@create')->name('create');
        Route::post('store','RoleController@store')->name('store');
        Route::get('edit/{id}','RoleController@edit')->name('edit');
        Route::post('update/{id}','RoleController@update')->name('update');
        Route::get('destroy/{id}','RoleController@destroy')->name('destroy');
    });

    Route::prefix('permission')->name('permission.')->group(function() {
        Route::get('index','PermissionController@index')->name('index');
        Route::get('create','PermissionController@create')->name('create');
        Route::post('store','PermissionController@store')->name('store');
        Route::get('edit/{id}','PermissionController@edit')->name('edit');
        Route::post('update/{id}','PermissionController@update')->name('update');
        Route::get('destroy/{id}','PermissionController@destroy')->name('destroy');
    });

    Route::prefix('menu')->name('menu.')->group(function() {
        Route::get('index','MenuController@index')->name('index');
        Route::get('create','MenuController@create')->name('create');
        Route::post('store','MenuController@store')->name('store');
        Route::get('edit/{id}','MenuController@edit')->name('edit');
        Route::post('update/{id}','MenuController@update')->name('update');
        Route::get('destroy/{id}','MenuController@destroy')->name('destroy');
    });
 });

    
});


