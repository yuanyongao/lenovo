<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdsController extends Controller
{

    //广告管理
    public function index(){
        return view("admin.sys.ads.index");
    }
}
