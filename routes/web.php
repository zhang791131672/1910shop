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
Route::get('/http','TestController@http');
Route::get('/test/hello','TestController@hello');
Route::get('/goods/detail','Goods\GoodsController@detail');
//商品信息
Route::get('/api/goods/info','Goods\GoodsController@goodsInfo');

//mvc模式
Route::group(['namespace'=>'User'],function(){
    //前台用户注册
    Route::get('user/reg','UserController@reg');
    //后台用户注册
    Route::post('user/reg','UserController@regDo');
    //前台用户登录
    Route::get('user/login','UserController@login');
    //后台用户登录
    Route::post('user/login','UserController@loginDo');
    //个人中心
    Route::get('user/center','UserController@center');
});

//接口
Route::group(['namespace'=>'Api'],function(){
    //注册接口
    Route::post('/api/user/reg','UserController@regDo');
    //登录接口
    Route::post('/api/user/login','UserController@loginDo');
    //个人中心接口
    Route::get('/api/user/center','UserController@center');
});
