<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::any('/wechat', 'WeixinController@serve');

Route::any('/wechat/broadcast', 'WeixinController@broadcast');

Route::any('/wechat/user', 'WeixinController@user');

Route::any('/wechat/userList', 'WeixinController@userList');

Route::any('/wechat/addMenus', 'WeixinController@addMenus');

//Route::get('weixin/{id}', 'WeixinController@show');
