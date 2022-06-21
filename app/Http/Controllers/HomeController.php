<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\CatePost;
use App\Models\Post;
session_start();

class HomeController extends Controller
{
    public function index(){
        $product1 = DB::table('tbl_product')->where('product_status','0')
        ->orderBy('product_id','asc')->limit(6)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')
        ->orderBy('category_id','desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','0')
        ->orderBy('product_id','desc')->limit(8)->get();

        $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();

        $post = Post::with('cate_post')->orderBy('post_id', 'desc')->where('post_status', '0')->take(3)->get();
        return view('home')->with('category',$cate_product)->with('all_product',$all_product)
        ->with('product1',$product1)->with('category_post',$category_post)->with('post',$post);
    }

    public function search(Request $request){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $keywords = $request->keywords_submit;

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();

        $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
        return view('pages.product.search')->with('category',$cate_product)->with('search_product',$search_product)
        ->with('category_post',$category_post);
    }
    public function wishlist(){
        $product = DB::table('tbl_product')->where('product_status','0')
        ->orderBy('product_id','desc')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
         return view('pages.likeproduct.like_product')->with('category',$cate_product)->with('product',$product)
         ->with('category_post',$category_post);
    }

    public function send_mail(){

    }

}
