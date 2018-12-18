<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypesController extends Controller
{
//    //数据格式化处理的方法
//    public function data($pid=0){
//        //数据库查询
//        $data = \DB::table("types")->where("pid",$pid)->get();
//
//        //查询下一级分类
//        foreach ($data as $k => $v){
//            $v->zi = $this->data($v->id);
//        }
////        return $data;
//    }


//       数据格式化
    public function data1($data,$pid=0){
        $newArr = array();
        //获取顶级分类
        foreach($data as $k => $v){
            if ($v->pid==$pid){  //选出一级分类
                $newArr[$v->id]=$v;
                $newArr[$v->id]->zi = $this->data1($data,$v->id);
            }
        }
        return $newArr;
    }
    //分类首页
    public function index(){
//        //一, 使用面向过程方式实现    淘汰
//            //遍历所有的顶级分类
//        $one = \DB::table("types")->where("pid",0)->get();
//
//            //遍历one的孩子
//        foreach ($one as $value){
//            $value->zi=\DB::table("types")->where("pid",$value->id)->get();
//        }
//            //遍历三级分类
//        foreach ($one as $value){
//            foreach ($value->zi as $v){
//                $v->zi=\DB::table("types")->where("pid",$v->id)->get();
//            }
//        }
        //二， 使用递归实现数据的一个格式化,需要每次循环需要把所有表循环 故淘汰
//        $data = $this->data();
        //三， 使用递归实现数据格式化
        $data = \DB::table("types")->get();
        $arr = $this->data1($data);
        //四  实现树形结构
        $data=\DB::select("select types.*,concat(path,id) p from types order by p");



        //查询所有数据
//        $data = \DB::table("types")->orderBy("sort",'desc')->get();
        //加载页面
        return view("admin.types.index")->with("data",$data);
    }
    //添加页面
    public function create(){
        return view('admin.types.add');
    }
    //插入操作
    public function store(Request $request){
        //处理数据 _token 剔除掉
        $data = $request->except("_token");


        //插入数据

        if(\DB::table("types")->insert($data)){
            //插入成功 跳转到展示页面
            return redirect('admin/types');
        }else{
            //插入失败 返回到上一个页面
            return back();
        }

    }
    //修改页面 get
    public function edit(){
        return view('admin.types.edit');
    }
    //更新操作 put
    public function update(){

    }
    //删除操作
    public function destroy($id){
        //删除数据
        if (\DB::table("types")->delete($id)){
            return 1;
        }else{
            return 0;
        }

    }
}
