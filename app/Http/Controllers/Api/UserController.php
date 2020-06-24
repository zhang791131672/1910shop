<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Model\UserModel;
use App\Model\TokenModel;
class UserController extends Controller
{
    /**
     * 注册接口
     **/
    public function regDo(Request $request){
        $user_name=$request->post('user_name');
        $user_email=$request->post('user_email');
        $password1=$request->post('password1');
        $password2=$request->post('password2');
        if($password1!=$password2){
            $response=[
                'error'=>50001,
                'msg'=>'两次输入的密码不一致'
            ];
            return $response;
        }else{
            if(!(strlen($password1)>6)){
                $response=[
                    'error'=>50002,
                    'msg'=>'密码长度必须大于6位'
                ];
                return $response;
            }else{
                $user_name_info=UserModel::where('user_name',$user_name)->first();
                if($user_name_info){
                    $response=[
                        'error'=>50003,
                        'msg'=>'用户名已存在'
                    ];
                    return $response;
                }else{
                    $user_email_info=UserModel::where('user_email',$user_email)->first();
                    if($user_email_info){
                        $response=[
                            'error'=>50004,
                            'msg'=>'邮箱已存在'
                        ];
                        return $response;
                    }else {
                        $password1=password_hash($password1,PASSWORD_BCRYPT);
                        $user_model=new UserModel();
                        $user_model->reg_time=time();
                        $user_model->user_name=$user_name;
                        $user_model->user_email=$user_email;
                        $user_model->password=$password1;
                        if($user_model->save()){
                            $response=[
                                'error'=>0,
                                'msg'=>'注册成功'
                            ];
                        }else{
                            $response=[
                                'error'=>50005,
                                'msg'=>'注册失败'
                            ];
                        }
                        return $response;
                    }
                }
            }
        }
    }
    /**
     * 登录接口
     **/
    public function loginDo(Request $request){
        $user_name=$request->post('user_name');
        $password=$request->post('password');
        $user_name_info=UserModel::where('user_name',$user_name)->first();
        if(!$user_name_info){
            $response=[
                'error'=>50006,
                'msg'=>'没有该用户'
            ];
            return $response;
        }else{
            $res=password_verify($password,$user_name_info->password);
            if($res){
                $str=$user_name_info->user_id.$user_name_info->user_name.time().uniqid();
                $token=md5($str);
                $token_model=new TokenModel();
                $token_model->user_id=$user_name_info->user_id;
                $token_model->token=$token;
                $token_model->save();
                    $response=[
                        'error'=>0,
                        'msg'=>'登录成功',
                        'token'=>$token,
                    ];
            }else{
                $response=[
                    'error'=>50007,
                    'msg'=>'登录失败,用户名与密码不匹配'
                ];
            }
            return $response;
        }
    }
    /**
     * 个人中心
     */
    public function center(Request $request){
        $token=$_GET['token'];
        $res=TokenModel::where('token',$token)->first();
        if($res){
            $user_id=$res->user_id;
            $user_info=UserModel::where('user_id',$user_id)->value('user_name');
            echo '欢迎'.$user_info.'来到个人中心';die;
        }else{
            $response=[
                'error'=>50008,
                'msg'=>'请登录'
            ];
        }
        return $response;
    }
}
