<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//商品详情控制器
class GoodsController extends Controller
{
    //展示页面
    public function index(){
        return view("home.goods");
    }
}
