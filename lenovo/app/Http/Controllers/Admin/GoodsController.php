<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


//商品管理
class GoodsController extends Controller
{
    //商品首页
    public function index(){

        //分页
        $admin = \DB::table('goods')->paginate(5);

        //加载页面
        return view("admin.goods.index")->with('data',$admin);
    }
    public function create(){

        //查询分类
        $data = \DB::select("select types.*,concat(path,id) p from types order by p");

        //数据处理
        foreach($data as $k => $v){
            $arr = explode(',',$v->path);

            $size = count($arr);

            $v->size = $size -2;

            $v->html = str_repeat('|----',$size-2).$v->name;

        }

//        dd($data);
//
//        exit;

        //加载添加页面
        return view("admin.goods.add")->with("data",$data);
    }

    //商品插入操作
    public function store(Request $request){


        //判断文件是否正常 并将图片储存
        //判断文件是否正常
        if ($request->hasFile('img') && $request->file('img')->isValid()){
            //文件名
            $path=md5(time().rand(100000,99999)).'.'.$request->file('img')->getClientOriginalExtension();
            $request->file('img')->move('./Uploads/goods',$path);
        }else{
            return view("admin.goods.index");
        }

        //判断多文件是否正常 并将图片储存
        if ($request->hasFile('imgs') && $request->file('imgs')->isValid()){
            //文件名
            $path1 = $request->file('imgs')->getClientOriginalName();
            $request->file('imgs')->move('./Uploads/goods',$path1);
        }else{
            return view("admin.goods.index");
        }
        $arr  = $request ->except("_token","imgs","img");
        $arr['img'] = $path;

        if ($id=\DB::table('goods')->insertGetId($arr)){
            unset($arr['img']);
            $arr['img'] = $path1;
            $brr = array();
            $brr['gid'] = $id;
            $brr['img'] = $arr['img'];
            \DB::table('goodsimg')->insert($brr);
            return redirect('admin/goods');
        }else{
            return back();
        }

    }
}
