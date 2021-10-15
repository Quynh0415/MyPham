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

Route::get('/admin/login', 'AdminController@login')->name("admin.login");
Route::post('/admin/login','AdminController@postLogin')->name('admin.postLogin');
Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');

Route::resource('/admins','AdminController')->except(['login']);
Route::resource('banner', 'BannerController');
Route::resource('category', 'CategoryController');
Route::resource('article', 'ArticleController');
Route::resource('product', 'ProductController');
Route::resource('products_detail', 'ProductDetailController');
Route::resource('setting', 'SettingController');
Route::resource('product_image', 'ProductImageController');


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'checkLogin'],function (){
    Route::get('/', 'DashboardController@dashboard')->name('dashboard');


//    Route::resource('contact', 'ContactController');
//    Route::resource('coupon', 'CouponController');
//    Route::resource('order', 'OrderController');
//    Route::resource('order_detail', 'OrderDetailController');
//    Route::resource('policy', 'PolicyController');
//    Route::resource('product_detail', 'ProductDetailController');
//    Route::resource('product_image', 'ProductImageController');
//    Route::resource('sign_pro', 'SignProController');
//    Route::resource('trademark', 'TrademarkController');
//    Route::resource('user', 'UserController');

});


