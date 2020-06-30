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

    public function www(){
        $url='http://api.1910.com/api/info';
        $key='1910';
        $data='hello';
        $sign=sha1($data.$key);
        $url=$url.'?data='.$data.'&sign='.$sign;
        $res=file_get_contents($url);
        echo $res;
    }

    public function postData(){
        $key='1910';
        $data=[
            'user_name'=>'zhangsan',
            'user_age'=>"18"
        ];
        $sign=json_encode($data).$key;
        $sign_data=[
            'data'=>$data,
            'sign'=>md5($sign),
        ];
        $url='http://api.1910.com/api/receivePost';
        //开启curl
        $ch=curl_init();
        //设置参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($sign_data));
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);


        $response=curl_exec($ch);

        $errno=curl_errno($ch);
        if($errno>0){
            var_dump(curl_error($ch));die;
        }
        curl_close($ch);
        var_dump($response);
    }

    public function encrypt(){
        $data='土豆土豆我是地瓜';
        $method='AES-256-CBC';
        $key='1910phpA';
        $iv='1234567898765432';
        $encrypt_data=openssl_encrypt($data,$method,$key,OPENSSL_RAW_DATA,$iv);
        $all_data=[
            'encrypt_data'=>$encrypt_data,
            'sign'=>sha1($encrypt_data.$key)
        ];
        $url='http://api.1910.com/api/decrypt';
        //开启curl
        $ch=curl_init();
        //设置参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$all_data);
        //执行curl
        $response=curl_exec($ch);
        $errno=curl_errno($ch);
        if($errno>0){
            echo curl_error($ch);die;
        }
        //关闭curl
        curl_close($ch);
        var_dump($response);
    }

    public function rsaEncrypt(){
        $key_sign='1910';
        $data='非对称加密';
        $key=file_get_contents(storage_path().'/keys/pub.key');
        $key=openssl_get_publickey($key);
        openssl_public_encrypt($data,$encrypt,$key);
        $sign=sha1($encrypt.$key_sign);
        $data=[
            'pub_encrypt'=>$encrypt,
            'sign'=>$sign
        ];
        $url='http://api.1910.com//api/rsa/decrypt';
        //开启curl
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //执行curl
        $response=curl_exec($ch);
        $errno=curl_errno($ch);
        if($errno>0){
            echo curl_error($ch);die;
        }
        //关闭curl
        curl_close($ch);
        var_dump($response);
    }
}
