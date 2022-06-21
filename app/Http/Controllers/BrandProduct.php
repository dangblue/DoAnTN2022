<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class BrandProduct extends Controller
{
    public function AuthLoginCheck(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_brand_product(){
        $this->AuthLoginCheck();
        return view('admin.add_brand_product');
    }
    public function all_brand_product(){
        $this->AuthLoginCheck();
        $all_brand_product=DB::table('tbl_brand')->paginate(20);
        $manager_brand_product=view('admin.all_brand_product')
        ->with('all_brand_product',$all_brand_product);
        return view('layouts.admin_layout')->with('admin.all_brand_product',$manager_brand_product);
    }
    public function save_brand_product(Request $request){
        $this->AuthLoginCheck();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

        DB::table('tbl_brand')->insert($data);
        Session::put('message','Thêm thành công');
        return Redirect::to('/add-brand-product');

    }
    public function unactive_brand_product($brand_product_id){
        $this->AuthLoginCheck();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)
        ->update(['brand_status'=>1]);
        Session::put('message','Không kích hoạt thương hiệu sản phẩm.');
        return Redirect::to('all-brand-product');

    }
    public function active_brand_product($brand_product_id){
        $this->AuthLoginCheck();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)
        ->update(['brand_status'=>0]);
        Session::put('message',' Đã kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
        $this->AuthLoginCheck();
        $edit_brand_product=DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $manager_brand_product=view('admin.edit_brand_product')
        ->with('edit_brand_product',$edit_brand_product);
        return view('layouts.admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }
    public function update_brand_product(Request $request, $brand_product_id){
        $this->AuthLoginCheck();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)-> update($data);
        Session::put('message',' Cập nhập thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        $this->AuthLoginCheck();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)-> delete();
        Session::put('message',' Xoá thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
}
