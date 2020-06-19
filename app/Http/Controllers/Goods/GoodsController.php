<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
    //
    public function detail(){
        $goods_id=$_GET['id'];
//        $goods_info=GoodsModel::where('goods_id',$goods_id)->first();
        $goods_info=GoodsModel::where('goods_id',$goods_id)->first();
        echo "<pre>";var_dump($goods_info);echo "</pre>";
       // dd($goods_info);
    }
    public function redis(){
        $key='name1';
        $value=Redis::get($key);
        echo $key.':'.$value;
    }
}
