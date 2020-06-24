<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Model\UserModel;
use Illuminate\Support\Facades\Cookie;
class UserController extends Controller
{
    //前台用户注册
    public function reg(){
        return view('user.reg');
    }
    //后台用户注册
    public function regDo(Request $request){
        $user_name=$request->post('user_name');
        $user_email=$request->post('user_email');
        $password1=$request->post('password1');
        $password2=$request->post('password2');
        if($password1!=$password2){
            echo "两次输入的密码不一致";die;
        }else{
            if(!(strlen($password1)>6)){
                echo "密码长度必须大于6个字符长度";die;
            }else{
                $user_name_info=UserModel::where('user_name',$user_name)->first();
                if($user_name_info){
                    echo "用户名已存在";die;
                }else{
                    $user_email_info=UserModel::where('user_email',$user_email)->first();
                    if($user_email_info){
                        echo "邮箱已存在";die;
                    }else {
                        $password1=password_hash($password1,PASSWORD_BCRYPT);
                        $user_model=new UserModel();
                        $user_model->reg_time=time();
                        $user_model->user_name=$user_name;
                        $user_model->user_email=$user_email;
                        $user_model->password=$password1;
                        if($user_model->save()){
                            header('refresh:2,url=/user/login');
                            echo "注册成功";die;
                        }else{
                            header('refresh:2,url=/user/reg');
                            echo "注册失败";die;
                        }
                    }
            }
      }
   }
}
    //前台用户登录
    public function login(){
        return view('user.login');
    }
    //后台用户登录
    public function loginDo(Request $request){
        $user_name=$request->post('user_name');
        $password=$request->post('password');
        $user_name_info=UserModel::where('user_name',$user_name)->first();
        if(!$user_name_info){
            echo "没有该用户";
        }else{
            $res=password_verify($password,$user_name_info->password);
            if($res){
//                setcookie('user_id',$user_name_info->user_id,time()+3600);
//                setcookie('user_name',$user_name_info->user_name,time()+3600);
                Cookie::queue('user_id',$user_name_info->user_id,3600);
                Cookie::queue('user_name',$user_name_info->user_name,3600);
                header('refresh:2,url=/user/center');
                echo "登录成功";
            }else{
                header('refresh:2,url=/user/login');
                echo "登录失败";
            }
        }
    }
    //个人中心
    public function center(){
//        echo "<pre>";print_r($_COOKIE);echo "</pre>";die;
//        原生
//        if(isset($_COOKIE['user_id'])&&isset($_COOKIE['user_name'])){
//            return view('user.center');
//        }else{
//            header('refresh:2,url=/user/login');
//        }
//      laravel框架使用
        if(Cookie::has('user_id')&&Cookie::has('user_name')){
            $user_id=Cookie::get('user_id');
            $user_info=UserModel::where('user_id',$user_id)->first();
            return view('user.center',['user_info'=>$user_info]);
        }else{
            header('refresh:2,url=/user/login');
        }
    }
}
