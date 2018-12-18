<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function PHPSTORM_META\elementType;
use Illuminate\Contracts\Encryption\DecryptException;

//后台管理员控制器
class AdminController extends Controller
{
    //管理者首页
    public function index(){

        //总数据
        $tot = \DB::table('admin')->count();
        //分页
        $admin = \DB::table('admin')->paginate(5);
        //加载页面
        return view("admin.admin.index")->with('data',$admin)->with('tot',$tot);

    }
    //添加页面
//    public function create(){
//        return view('admin.admin.add');
//
//    }
    //插入操作
    public function store(Request $request){
        // 直接把字符串数组化

        parse_str($_POST['str'],$arr);

        // 表单验证的规则

        $rules=[
            'name' => 'required|unique:admin|between:6,12',
            'pass' => 'required|same:repass|between:6,12',

        ];


        // 表单验证的提示信息

        $message=[

            "name.required"=>"请输入用户名",
            "pass.required"=>"请输入密码",
            "name.unique"=>"用户名已存在",
            "pass.same"=>"两次密码不一致",
            "pass.between"=>"密码长度不在6-12位之间",
            "name.between"=>"用户名长度不在6-12位之间",

        ];

        // 使用laravel的表单验证
        $validator = \Validator::make($arr,$rules,$message);

        // 开始验证
        if ($validator->passes()) {

        // 验证通过添加数据库

            unset($arr['repass']);
            //下面注销的为加密语句
            $arr['pass']=\Crypt::encrypt($arr['pass']);
            $arr['time']=time();

            // 插入数据库

            if (\DB::table("admin")->insert($arr)) {
                return 1;
            }else{
                return 0;
            }

        }else{
            // 具体查看laravel的核心类
            return $validator->getMessageBag()->getMessages();
        }
        // 直接把字符串数组化

//        parse_str($_POST['str'],$arr);
//
//        // 移除repass
//        unset($arr['repass']);
//
//        $arr['time']=time();
//
//        // 插入数据库
//
//        if (\DB::table('admin')->insert($arr)) {
//            # code...
//            echo "1";
//        }else{
//            echo "0";
//        }
//        //直接把字符串数组化
//        parse_str($_POST['str'],$arr);
//        //表单验证的规则
//        $rules = [
//            'name' =>'required|unique:admin|betweem:6,12',
//            'pass' =>'required|same:repass|between:6,12',
//        ];
//        //表单验证的提示消息
//        $message =[
//            'name.required' =>"请输入用户名",
//            'pass.required' =>"请输入密码",
//            'name.unique'=>"用户名已存在",
//            'pass.same' =>"两次密码不一致",
//            'pass.between'=>"密码长度不在6——12之间",
//            'name.between'=>"用户名长度不在6——12之间",
//
//        ];
//
//        //使用larval的表单验证
//        $validator = \validator::make($arr,$rules,$message);
//        //开始验证
//        if ($validator->passes()){
//
//            //验证通过添加数据库
//            unset($arr['repass']);
//            $arr['time']=time();
//            //插入数据库
//            if (\DB::insert($arr)){
//                return 1;
//
//            }else{
//                return 0;
//            }
//
//        }else{
//            return $validator->getMessageBag()->getMessages();
//        }



    }
    //修改页面 get
    public function edit($id){

        //查询数据库
        $data = \DB::table("admin")->find($id);

        //解密
        $data->pass=\Crypt::decrypt($data->pass);

        //分配数据
        return view('admin.admin.edit')->with("data",$data);
    }
    //更新操作 put
    public function update(Request $request){

        // 直接把字符串数组化

        parse_str($_POST['str'],$arr);

        // 表单验证的规则

        $rules=[
            'pass' => 'required|same:repass|between:6,12',

        ];


        // 表单验证的提示信息

        $message=[

            "pass.required"=>"请输入密码",
            "pass.same"=>"两次密码不一致",
            "pass.between"=>"密码长度不在6-12位之间",

        ];

        // 使用laravel的表单验证
        $validator = \Validator::make($arr,$rules,$message);

        // 开始验证

        if ($validator->passes()) {

            // 验证通过添加数据库

            unset($arr['repass']);

            $arr['pass']=\Crypt::encrypt($arr['pass']);


            // 插入数据库

            if (\DB::update("update admin set status= $arr[status] ,pass='$arr[pass]' where id=$arr[id]")) {
                return 1;
            }else{
                return 0;
            }

        }else{
            // 具体查看laravel的核心类
            return $validator->getMessageBag()->getMessages();
        }

    }
    //删除操作
    public function destroy($id){

        //删除数据
        if (\DB::table("admin")->delete($id)){
            return 1;
        }else{
            return 0;
        }
    }
    //修改状态的方法
    public function ajaxStatu(Request $request){
        //剔除数据
//        $arr = $request->except('_token');
////        if (\DB::table('admin')->where("id","=","$arr[id]")->update(['status'=>$arr[status]])){
//        if (\DB::update("update admin set status = $arr[status] where id = $arr[id]")){
//            return 1;
//        }else{
//            return 0;
//       }
        // 剔除数据

        $arr=$request->except('_token');

        if (\DB::update("update admin set status= $arr[status] where id=$arr[id]")) {
            # code...
            return 1;
        }else{
            return 0;
        }
    }

    public function logout(Request $request){
        $request->session()->flush();

        return redirect('admin/login');
    }
}



//|        | POST      | admin/admin              | admin.store   | App\Http\Controllers\admin\AdminController@store   | web
//|
//|        | GET|HEAD  | admin/admin/create       | admin.create  | App\Http\Controllers\admin\AdminController@create  | web
//|
//|        | PUT|PATCH | admin/admin/{admin}      | admin.update  | App\Http\Controllers\admin\AdminController@update  | web
//|
//|        | GET|HEAD  | admin/admin/{admin}      | admin.show    | App\Http\Controllers\admin\AdminController@show    | web
//|
//|        | DELETE    | admin/admin/{admin}      | admin.destroy | App\Http\Controllers\admin\AdminController@destroy | web
//|
//|        | GET|HEAD  | admin/admin/{admin}/edit | admin.edit    | App\Http\Controllers\admin\AdminController@edit    | web
//|
//|        | GET|HEAD  | admin/user               | user.index    | App\Http\Controllers\admin\UserController@index    | web


//
//|        | GET|HEAD  | /                        |               | App\Http\Controllers\Home\IndexController@index      | web            |
//|        | GET|HEAD  | admin                    |               | App\Http\Controllers\admin\IndexController@index     | web,adminLogin |
//|        | GET|HEAD  | admin/admin              | admin.index   | App\Http\Controllers\admin\AdminController@index     | web,adminLogin |
//|        | POST      | admin/admin              | admin.store   | App\Http\Controllers\admin\AdminController@store     | web,adminLogin |
//|        | POST      | admin/admin/ajaxStatu    |               | App\Http\Controllers\admin\AdminController@ajaxStatu | web,adminLogin |
//|        | GET|HEAD  | admin/admin/create       | admin.create  | App\Http\Controllers\admin\AdminController@create    | web,adminLogin |
//|        | DELETE    | admin/admin/{admin}      | admin.destroy | App\Http\Controllers\admin\AdminController@destroy   | web,adminLogin |
//|        | PUT|PATCH | admin/admin/{admin}      | admin.update  | App\Http\Controllers\admin\AdminController@update    | web,adminLogin |
//|        | GET|HEAD  | admin/admin/{admin}      | admin.show    | App\Http\Controllers\admin\AdminController@show      | web,adminLogin |
//|        | GET|HEAD  | admin/admin/{admin}/edit | admin.edit    | App\Http\Controllers\admin\AdminController@edit      | web,adminLogin |
//|        | GET|HEAD  | admin/login              |               | App\Http\Controllers\Admin\LoginController@index     | web            |
//|        | GET|HEAD  | admin/user               | user.index    | App\Http\Controllers\admin\UserController@index      | web,adminLogin |
//|        | POST      | admin/user               | user.store    | App\Http\Controllers\admin\UserController@store      | web,adminLogin |
//|        | GET|HEAD  | admin/user/create        | user.create   | App\Http\Controllers\admin\UserController@create     | web,adminLogin |
//|        | GET|HEAD  | admin/user/{user}        | user.show     | App\Http\Controllers\admin\UserController@show       | web,adminLogin |
//|        | PUT|PATCH | admin/user/{user}        | user.update   | App\Http\Controllers\admin\UserController@update     | web,adminLogin |
//|        | DELETE    | admin/user/{user}        | user.destroy  | App\Http\Controllers\admin\UserController@destroy    | web,adminLogin |
//|        | GET|HEAD  | admin/user/{user}/edit   | user.edit     | App\Http\Controllers\admin\UserController@edit       | web,adminLogin |
//|        | GET|HEAD  | admin/yzm                |               | App\Http\Controllers\Admin\LoginController@yzm       | web            |
//|        | GET|HEAD  | api/user                 |               | Closure                                             | api,auth:api   |
//|        | GET|HEAD  | goods/{id}               |               | App\Http\Controllers\Home\GoodsController@index      | web            |
//|        | GET|HEAD  | types/{id}               |               | App\Http\Controllers\Home\TypesController@index      | web            |
//+--------+-----------+--------------------------+---------------+------------------------------------------------------+----------------+


