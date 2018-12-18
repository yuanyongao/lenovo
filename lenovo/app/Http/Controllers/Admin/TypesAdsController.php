<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//分类广告
class TypesAdsController extends Controller
{
    //分类广告
    public function index(){
        return view("admin.sys.types.index");
    }

}
