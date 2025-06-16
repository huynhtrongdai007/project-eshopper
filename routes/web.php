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

Route::get('/','HomeController@index')->name('/');


Route::get('home','HomeController@index')->name('home');

Route::get('login','HomeController@login')->name('login');
Route::post('logincustomer','CustomerController@loginCustomer')->name('logincustomer');

Route::post('register','CustomerController@registerCustomer')->name('register');
Route::get('logout','CustomerController@logout')->name('logout');

Route::get('cart','HomeController@cart')->name('cart');

Route::get('checkout','HomeController@checkout')->name('checkout');

Route::get('contact','HomeController@contact')->name('contact-us');
Route::post('addContact','CustomerController@addContact')->name('addContact');

Route::get('/category/{slug}/{id}','HomeController@category')->name('category');

Route::get('/brand/{slug}/{id}','HomeController@brand')->name('brand');

Route::get('product-details/{slug}/{id}','ProductDetailController@productDetails')->name('product-details');
Route::get('tags/{id}','ProductDetailController@productTags')->name('tags');
Route::post('/storeReview','ProductDetailController@storeReview')->name('storeReview');
Route::post('/display_review','ProductDetailController@displayReview');

Route::get('/search','HomeController@search')->name('search');
/*--------------------------------- phần blog------------------------------------------*/
Route::get('/list-post','PostController@postList')->name('list-post');
Route::get('/post-detail/{slug}/{id}','PostController@postDetail')->name('post-detail');
Route::get('/post-tags/{id}','PostController@postTags')->name('post-tags');
/*--------------------------------- phần Cart------------------------------------------*/
Route::get('AddCart/{id}','CartController@AddCart');
Route::get('product-details/{slug}/AddCart/{id}','CartController@AddCart')->name('AddCart');
Route::get('Delete-Cart/{id}','CartController@DeleteItemCart')->name('DeleteCart');
Route::get('Save-Item-List-Cart/{id}/{quantity}','CartController@SaveItemCart')->name('SaveItemCart');
Route::post('Save-All','CartController@SaveAllItemCart')->name('SaveItemCart');
/*--------------------------------- phần Checkout------------------------------------------*/
Route::post('storecheckout','CheckoutController@storeCheckOut');
/*--------------------------------- phần Comment------------------------------------------*/

Route::post('/add_comment','PostController@add_comment');
Route::post('/load-comment','PostController@displayCommemnt');
Route::post('/load-respones','PostController@displayRespones');
/*--------------------------------- phần WishList------------------------------------------*/
Route::post('/add-with-list','WishlistController@addWishList');
Route::get('list-wishlist','HomeController@wishlist')->name('list-wishlist');
Route::post('/get-with-list','WishlistController@getWishList');
Route::post('/delete-wishlist','WishlistController@deleteWishlist')->name('delete-wishlist');

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
        Route::get('update-status-active/{id}','CategoryController@StatusActive');
        Route::get('update-status-untive/{id}','CategoryController@StatusUntive');
    });

    Route::prefix('brand')->name('brand.')->group(function() {
        Route::get('index','BrandController@index')->name('index');
        Route::get('create','BrandController@create')->name('create');
        Route::post('store','BrandController@store')->name('store');
        Route::get('edit/{id}','BrandController@edit')->name('edit');
        Route::post('update/{id}','BrandController@update')->name('update');
        Route::get('destroy/{id}','BrandController@destroy')->name('destroy');
        Route::get('update-status-active/{id}','BrandController@StatusActive');
        Route::get('update-status-untive/{id}','BrandController@StatusUntive');
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
        Route::get('update-status-active/{id}','SlideController@StatusActive');
        Route::get('update-status-untive/{id}','SlideController@StatusUntive');
    });

    Route::prefix('product')->name('product.')->group(function() {
        Route::get('index','ProductController@index')->name('index');
        Route::get('create','ProductController@create')->name('create');
        Route::post('store','ProductController@store')->name('store');
        Route::get('edit/{id}','ProductController@edit')->name('edit');
        Route::post('update/{id}','ProductController@update')->name('update');
        Route::get('destroy/{id}','ProductController@destroy')->name('destroy');
        Route::get('update-status-active/{id}','ProductController@StatusActive');
        Route::get('update-status-untive/{id}','ProductController@StatusUntive');
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

    Route::prefix('customer')->name('customer.')->group(function() {
        Route::get('index','CustomerController@index')->name('index');
        Route::get('destroy/{id}','CustomerController@destroy')->name('destroy');

    });

    Route::prefix('contact')->name('contact.')->group(function() {
        Route::get('index','ContactController@index')->name('index');
        Route::get('destroy/{id}','ContactController@destroy')->name('destroy');
    });

    Route::prefix('order')->name('order.')->group(function() {
        Route::get('index','OrderController@index')->name('index');
        Route::get('show/{id}','OrderController@show')->name('show');
        Route::get('print_order/{id}','OrderController@print_order')->name('print_order');
        Route::get('destroy/{id}','OrderController@destroy')->name('destroy');
        Route::get('confirm-order/{id}','OrderController@confirm_order')->name('confirm');

    });
    Route::prefix('post')->name('post.')->group(function() {
        Route::get('index','PostController@index')->name('index');
        Route::get('create','PostController@create')->name('create');
        Route::post('store','PostController@store')->name('store');
        Route::get('edit/{id}','PostController@edit')->name('edit');
        Route::post('update/{id}','PostController@update')->name('update');
        Route::get('destroy/{id}','PostController@destroy')->name('destroy');
    });
    Route::prefix('vendor')->name('vendor.')->group(function() {
        Route::get('index','VendorController@index')->name('index');
        Route::get('create','VendorController@create')->name('create');
        Route::post('store','VendorController@store')->name('store');
        Route::get('edit/{id}','VendorController@edit')->name('edit');
        Route::post('update/{id}','VendorController@update')->name('update');
        Route::get('destroy/{id}','VendorController@destroy')->name('destroy');
    });
    Route::prefix('warehouse')->name('warehouse.')->group(function() {
        Route::get('index','WarehouseController@index')->name('index');
        Route::get('create','WarehouseController@create')->name('create');
        Route::post('store','WarehouseController@store')->name('store');
        Route::get('edit/{id}','WarehouseController@edit')->name('edit');
        Route::post('update/{id}','WarehouseController@update')->name('update');
        Route::get('destroy/{id}','WarehouseController@destroy')->name('destroy');
        Route::get('stock_out_view','WarehouseController@stock_out_view')->name('stock_out_view');
        Route::get('stock_out_detail_view/{id}','WarehouseController@stock_out_detail_view')->name('stock_out_detail_view');
    });
 });
});


