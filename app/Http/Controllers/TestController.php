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
    //生成签名
    public function sign(){
        $key='1910';
        $data='hello';               //传输的数据
        $sign=sha1($data.$key);       //生成的签名
        $url='http://www.1910.com/secret?data='.$data.'&sign='.$sign;       //发送到服务端
        echo $url;
    }
    //解密签名
    public function secret(Request $request){
        $key='1910';
        $data=$request->get('data');    //接收发送过来的数据
        $sign=$request->get('sign');    //接收发送过来的签名
        echo $data,"<br/>",$sign;
        $local_sign=sha1($data.$key);         //加密数据
        if($local_sign==$sign){         //与原签名作比较
            echo "验签通过";
        }else{
            echo "验签失败";
        }
    }
}
