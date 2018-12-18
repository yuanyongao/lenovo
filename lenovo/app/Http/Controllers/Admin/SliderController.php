<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    //轮播图管理
    public function index(){
        //总数据
        $tot = \DB::table('slider')->count();
        //分页
        $admin = \DB::table('slider')->paginate(5);
        return view("admin.sys.slider.index")->with('data',$admin)->with('tot',$tot);
    }


    //新建处理方法
    public function store(Request $request){
        //判断文件是否正常
        if ($request->hasFile('img') && $request->file('img')->isValid()){
            //文件名
            $path=md5(time().rand(100000,999999)).'.'.$request->file('img')->getClientOriginalExtension();
            $request->file('img')->move('./Uploads/lun',$path);
        }

        //表单上传到数据库
        // 移除_token 和 图片
        $arr = $request->all();
        unset($arr['_token']);
        unset($arr['img']);

        //添加图片名称
        $arr['img'] = $path;

        if (\DB::table('slider')->insert($arr)){
            return 1;
        }else{
            return 0;
        }







    }
}
