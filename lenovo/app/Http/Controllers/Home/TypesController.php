<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//分类页控制器
class TypesController extends Controller
{
    public function index(){
        //加载页面
        return view("home.types");
    }
}
