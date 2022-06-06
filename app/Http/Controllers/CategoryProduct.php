<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\CatePost;
session_start();

class CategoryProduct extends Controller
{

    public function AuthLoginCheck(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){
        $this->AuthLoginCheck();
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->AuthLoginCheck();
        $all_category_product=DB::table('tbl_category_product')->get();
        $manager_category_product=view('admin.all_category_product')
        ->with('all_category_product',$all_category_product);
        return view('layouts.admin_layout')->with('admin.all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request){
        $this->AuthLoginCheck();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm thành công');
        return Redirect::to('/add-category-product');

    }
    public function unactive_category_product($category_product_id){
        $this->AuthLoginCheck();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)
        ->update(['category_status'=>1]);
        Session::put('message','Không kích hoạt danh mục sản phẩm ');
        return Redirect::to('all-category-product');

    }
    public function active_category_product($category_product_id){
        $this->AuthLoginCheck();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)
        ->update(['category_status'=>0]);
        Session::put('message',' Đã kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLoginCheck();
        $edit_category_product=DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product=view('admin.edit_category_product')
        ->with('edit_category_product',$edit_category_product);
        return view('layouts.admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }
    public function update_category_product(Request $request, $category_product_id){
        $this->AuthLoginCheck();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)-> update($data);
        Session::put('message',' Cập nhập danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AuthLoginCheck();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)-> delete();
        Session::put('message',' Xoá danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    //end admin page
    public function show_category_home($category_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')
        ->orderBy('category_id','desc')->get();
        $category_by_id = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->where('tbl_product.category_id',$category_id)->get();
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
        return view('pages.category.show_category')->with('category',$cate_product)
        ->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('category_post',$category_post);
    }

}
