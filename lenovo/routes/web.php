<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//后台路由
//登入页面
Route::get('admin/login','Admin\LoginController@index');
//后台的验证码
Route::get('admin/yzm','Admin\LoginController@yzm');
//登入的处理操作
Route::post('admin/check','Admin\LoginController@check');
//清楚缓存
Route::get('admin/flush','Admin\indexController@flush');
//文件上传处理路由     没有应用到的路由
Route::any('admin/shangchuang','Admin\CommonController@upload');


Route::group(['namespace'=>'admin','prefix'=>'admin','middleware'=>'adminLogin'],function(){
//后台首页路由
    Route::get('/', 'IndexController@index');
//后台退出路由
    Route::get('admin/logout','AdminController@logout');
//后台管理员管理
    Route::resource('admin','AdminController');
//后台管理员状态修改的路由
    Route::post('admin/ajaxStatu','AdminController@ajaxStatu');
//后台用户管理
    Route::resource('user', 'UserController');
//后台分类管理
    Route::resource('types','TypesController');
//后台订单管理
    Route::resource('orders',"OrdersController@index");
//后台的系统管理   代做********************************
    //系统管理
    Route::resource("sys/config","ConfigController");
    //轮播图管理
    Route::resource("sys/slider","SliderController");
    //广告管理
    Route::resource("sys/ads","AdsController");
    //分类广告管理
    Route::resource("sys/types","TypesAdsController");
    //*****************************************************
//后台商品管理
    Route::resource('goods','GoodsController');
});


//前台路由
   //主页
Route::get('/','Home\IndexController@index');
   //分类页面
Route::get('/types/{id}','Home\TypesController@index');
   //商品详情页面
Route::get('/goods/{id}','Home\GoodsController@index');





