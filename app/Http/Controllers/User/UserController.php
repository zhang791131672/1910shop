<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //前台用户注册
    public function reg(){
        return view('user.reg');
    }
    //后台用户注册
    public function regDo(Request $request){
        dd($request->all());
    }
    //前台用户登录
    public function login(){
        return view('user.login');
    }
    //后台用户登录
    public function loginDo(){

    }
}
