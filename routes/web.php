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
Route::get('/', 'HomeController@index');


Route::get('/admin/login', 'AdminController@login')->name("admin.login");
Route::post('/admin/login','AdminController@postLogin')->name('admin.postLogin');
Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');

Route::resource('/admins','AdminController')->except(['login']);

//trang san pham
Route::get('/san-pham', 'HomeController@product')->name('sanpham');
Route::get('/san-pham/{slug}', 'HomeController@productDetail')->name('chitietsanpham');
Route::get('/san-pham-theo-hang/{slug}', 'HomeController@brands')->name('sanphamtheohang');
Route::get('/san-pham-theo-danh-muc/{slug}', 'HomeController@categories')->name('sanphamtheodanhmuc');


//trang tin tuc
Route::get('/tin-tuc', 'HomeController@article')->name('tintuc');
Route::get('/chi-tiet-tin-tuc/{slug}', 'HomeController@articleDetail')->name('chitiettintuc');

//trang lien he
Route::get('/lien-he', 'HomeController@contact')->name('lienhe');
Route::post('/lien-he', 'HomeController@postContact')->name('lien-he');



//gio hang
Route::get('/gio-hang', 'CartController@index')->name('giohang');
Route::get('/thanh-toan', 'CartController@orderDetail')->name('thanhtoan');
Route::post('/them-san-pham', 'CartController@addProduct')->name('themsanpham');
Route::get('/xoa-gio-hang', 'CartController@clearCart')->name('xoagiohang');
Route::get('/xoa-san-pham/{rowId}', 'CartController@removeProduct')->name('xoasanpham');


Route::group(['prefix' => 'admin', 'as' => 'admin.' , 'middleware' => 'checkLogin'],function (){
    Route::get('/', 'DashboardController@dashboard')->name('admin.dashboard');
    Route::resource('banner', 'BannerController');
    Route::post('admin/banner/stt','BannerController@changeStatus')->name('admin.banner.stt');
    Route::resource('category', 'CategoryController');
    Route::resource('brand', 'BrandController');
    Route::resource('article', 'ArticleController');
    Route::resource('product', 'ProductController');
    Route::post('admin/product/stt', 'ProductController@changeStatus')->name('admin.product.stt');
    Route::resource('products_detail', 'ProductDetailController');
    Route::resource('setting', 'SettingController');
    Route::get('admin/product_image/create/{id}', 'ProductImageController@create')->name('admin.product_image.create');
    Route::resource('product_image', 'ProductImageController')->except(['create']);
    Route::resource('coupon', 'CouponController');
    Route::resource('contact', 'ContactController');
    Route::resource('admin', 'AdminController');
    Route::resource('policy', 'PolicyController');


});



