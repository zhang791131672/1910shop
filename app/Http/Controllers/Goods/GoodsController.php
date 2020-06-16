<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
class GoodsController extends Controller
{
    //
    public function detail(){
        $goods_id=$_GET['id'];
//        $goods_info=GoodsModel::where('goods_id',$goods_id)->first();
        $goods_info=GoodsModel::where('goods_id',$goods_id)->first();
        dd($goods_info);
    }
}
