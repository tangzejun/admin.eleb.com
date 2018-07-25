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

//Route::get('/', function () {
//    return view('welcome');
//});

//商户分类
Route::resource('shop_categories','shop_categoryController');

//商户信息
Route::resource('shops','ShopController');
Route::get('/shop_status/{shop}','ShopController@status')->name('shops.status');
Route::get('/shop_disable/{shop}','ShopController@disable')->name('shops.disable');

//商户账号
Route::resource('shopusers','ShopUsersController');
Route::get('/shopusers_status/{shopuser}','ShopUsersController@status')->name('shopusers.status');
Route::get('/shopusers_reset/{shopuser}','ShopUsersController@reset')->name('shopusers.reset');
Route::post('/shopusers_resetSave','ShopUsersController@resetSave')->name('shopusers.resetSave');

//平台管理员
Route::resource('admins','AdminController');
Route::get('admins_editPassword','AdminController@editPassword')->name('admins.editPassword');
Route::post('admins_updatePassword','AdminController@updatePassword')->name('admins.updatePassword');

//登录
Route::get('login','SessionController@login')->name('login');
//验证
Route::post('login','SessionController@store')->name('login');
//注销
Route::delete('logout','SessionController@logout')->name('logout');
