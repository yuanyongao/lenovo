<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    //系统配置
    public function index(){
        return view("admin.sys.config.index");
    }
    //更新配置的方法
    public function store(Request $request){

        //接收文件
        $arr =  $request->except("_token");


        //判断logo 是否重复
        $oldlogoname=$request->input('oldlogoname');

        if ($oldlogoname== $request->input('img')){
            $arr =  $request->except("_token","img");
        }else{
            if (fopen("./Uploads/sys/$oldlogoname","w+")){
                unlink("./Uploads/sys/$oldlogoname");
            }
        }

        //判断文件是否正常 并将图片储存
        if ($request->hasFile('img') && $request->file('img')->isValid()){
            //文件名
            $path = $request->file('img')->getClientOriginalName();
            $request->file('img')->move('./Uploads/sys',$path);
        }else{
            return view("admin.sys.config.index");
        }
        //获取数据 剔除——token
        unset($arr['oldlogoname']);
        unset($arr['img']);
        $arr['logo'] = $path;
        $str1 = var_export($arr,true);
        //拼接字符串
        $str = "<?php   return  ".$str1."?>";

        //写入到指定文件
        file_put_contents('../config/web.php',$str);

        return back();

    }
}
