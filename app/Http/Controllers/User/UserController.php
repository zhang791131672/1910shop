<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //用户注册
    public function reg(){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $pass1=$_POST['pass1'];
        $pass2=$_POST['pass2'];
        $arr=[
            'name'=>$name,
            'email'=>$email,
            'pass1'=>$pass1,
            'pass2'=>$pass2
        ];
        return json_encode($arr);
    }
}
