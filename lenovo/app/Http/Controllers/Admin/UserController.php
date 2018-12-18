<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //管理者首页
    public function index(){
        //加载页面
        return view("admin.user.index");
    }
    //添加页面
    public function create(){
        return view('admin.user.add');

    }
    //插入操作
    public function store(){

    }
    //修改页面 get
    public function edit(){
        return view('admin.user.edit');

    }
    //更新操作 put
    public function update(){

    }
    //删除操作
    public function destroy(){

    }

}