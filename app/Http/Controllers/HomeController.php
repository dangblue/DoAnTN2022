<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class HomeController extends Controller
{
    public function index(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')
        ->orderBy('category_id','desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','0')
        ->orderBy('product_id','desc')->limit(4)->get();


        return view('home')->with('category',$cate_product)->with('all_product',$all_product);
    }


}
