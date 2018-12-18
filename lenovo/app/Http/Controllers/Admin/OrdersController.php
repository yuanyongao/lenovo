<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//后台订单管理控制器
class OrdersController extends Controller
{
    public function index(){
        return view("admin.orders.index");
    }
}
