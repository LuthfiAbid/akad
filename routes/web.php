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

Route::group(['middleware' => 'revalidate'],function(){
    Auth::routes();
    Route::get('admin/home','AdminController@index');


});
Route::get('/back','AdminController@back');

Route::get('admin/login','AdminController@login');
Route::get('admin/login/loginPost','AdminController@loginPost');

Route::get('admin/logout','AdminController@logout');
Route::get('admin/home','AdminController@index');

//--------------------------------buyer------------------------------------//
Route::get('buyer/login','BuyerController@login');
Route::get('buyer/login/loginPostBuyer','BuyerController@loginPostBuyer');
Route::get('buyer/register','BuyerController@register');
Route::post('buyer/registerBuyer','BuyerController@saveRegisterBuyer');
Route::get('buyer/logout','BuyerController@logout');
Route::get('buyer/setting/{id_buyer}','BuyerController@setting');
Route::post('buyer/updateSettingBuyer','BuyerController@updateSettingBuyer');
Route::get('buyer/home','BuyerController@index');
//--------------------------------buyer------------------------------------//

//Stock
Route::get('admin/stock','AdminController@goodsStock');
Route::get('admin/stock/edit/{id}','AdminController@goodsStockEdit');
Route::put('admin/stock/editPost/{id}','AdminController@goodsStockUpdate');
Route::get('admin/stock/add','AdminController@goodsStockAdd');
Route::post('admin/stock/addPost','AdminController@goodsStockAddPost');

//User
Route::get('admin/dataUser','AdminController@dataUser');
Route::get('admin/dataUser/edit/{id}','AdminController@dataUserEdit');
Route::post('admin/dataUser/editPost','AdminController@editDataUserPost');
