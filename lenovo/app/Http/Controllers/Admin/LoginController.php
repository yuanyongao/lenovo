<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use spec\Prophecy\Exception\Prediction\AggregateExceptionSpec;

//后台登入控制器
class LoginController extends Controller
{
    //加载页面
    public function index(){
        return view('admin.login');
    }
    //验证码
    public function yzm(){
        require_once('../resources/code/code.class.php');
        //实例化
        $code = new \code();
        //生成验证码
        $code->make();
    }
    //登入的验证操作
    public function check(Request $request){
        $name = $request->input('name');
        $password = $request->input('password');
        $ucode = $request->input('code');

        require_once('../resources/code/code.class.php');
        //实例化
        $code = new \code();
        //获取session
        $ocode = $code->get();
        //检测验证码
        if(strtoupper($ucode) ==$ocode){
            //检测密码
            $data = \DB::table('admin')->where([['name','=',"$name"],['status','=','0']])->first();
            if ($data){
                $opassword = \Crypt::decrypt($data->pass);
                if ($password == $opassword){
                    //声明数组
                    $arr = [];
                    $arr['lasttime'] = time();
                    $arr['count'] = ++$data->count;
                    //更新登入信息

                    \DB::table('admin')->where('id',$data->id)->update($arr);
                    //存session
                    session(['lenovoAdminUserInfo.id' => $data->id]);
                    session(['lenovoAdminUserInfo.name' => $data->name]);


                    //跳转到首页
                    return redirect('admin');
                }else{
//                    echo \Crypt::decrypt($data->pass);
//                    echo $password;
                    return back()->with("error",'密码错误');
                }

            }else{
                return back()->with("error",'用户名不存在');
            }
        }else{
            return back()->with("error",'验证码错误');
        }



    }
}
