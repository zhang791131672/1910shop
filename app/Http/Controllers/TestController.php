<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function hello(){
        echo __METHOD__;
        echo date('Y-m-d H:i:s');
    }
    //测试redis
    public function redis(){
        $key='name1';
        $value=Redis::get($key);
        echo $key.':'.$value;
    }
    public function http(){
        $data=[
            'name'=>'张三',
            'age'=>18
        ];
        return $data;
    }
}
