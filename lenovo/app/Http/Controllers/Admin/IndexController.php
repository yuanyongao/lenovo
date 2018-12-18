<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//后台首页控制器
class IndexController extends Controller
{
    //后台首页
    public function index(){
        //加载页面
        return view("admin.index");
    }
    public function deldir($path){
        $arr = scandir($path);


        foreach ($arr as $k =>$v){
            if ($v != '.' &&$v !='..'){
                unlink($path.'/'.$v);
            }
        }
    }
    //清楚缓存
    public function flush(){
        $this->deldir("../storage/framework/views");
        $this->deldir("../storage/framework/cache");
        return back();
    }
}
