<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//公共处理文件上传处理的控制器
class CommonController extends Controller
{

    public function upload(Request $request){
        if (Input::method()=='POST'){
            //判断文件是否正常
            dd($request);

        }else{
            return 'cuowu';
        }
    }










//    //获取用户上传的内容
//$file = $request->file('Filedata');
//
//    //判断目录是否存在
//$dir = $request->input('files');
//
//if (file_exists("./Uploads/{$dir}")){
//
//}else{
//    mkdir("./Uploads/{$dir}");
//}
//
//        //判断文件是否上传有效
//        if($file->isValid()){
//
//            //获取后缀
//            $ext = $file->getClientOriginalExtension();
//
//            //生成新的文件名
//            $newFile =time().rand().'.'.$ext;
//
//            //移动到指定目录
//            $request->file('Filedata')->move('./Uploads/'.$dir,$newFile);
//
//            echo $newFile;
//        }

//    //文件上传的方法
//    public function upload(Request $request){

//    }
}
