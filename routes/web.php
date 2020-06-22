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
Route::get('/info',function(){
   phpinfo();
});
Route::get('/test/redis','TestController@redis');
Route::get('/test/hello','TestController@hello');
Route::get('/goods/detail','Goods\GoodsController@detail');
//商品信息
Route::get('/api/goods/info','Goods\GoodsController@goodsInfo');
//前台用户注册
Route::get('user/reg','User\UserController@reg');
//后台用户注册
Route::post('user/regDo','User\UserController@regDo');
//前台用户登录
Route::get('user/login','User\UserController@login');
//后台用户登录
Route::post('user/loginDo','User\UserController@loginDo');