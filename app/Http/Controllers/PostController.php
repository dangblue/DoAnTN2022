<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use GuzzleHttp\Psr7\Message;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Post;
use App\Models\CatePost;
session_start();

class PostController extends Controller
{
    public function AuthLoginCheck(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_post(){
        $this->AuthLoginCheck();
        $cate_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        return view('admin.post.add_post')->with(compact('cate_post'));

    }
    public function all_product(){
        $this->AuthLoginCheck();
        $all_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
        ->orderBy('tbl_product.product_id','desc')->get();
        $manager_product=view('admin.all_product')
        ->with('all_product',$all_product);
        return view('layouts.admin_layout')->with('admin.all_product',$manager_product);
    }
    public function save_post(Request $request){
        $this->AuthLoginCheck();
        $data = $request->all();
        $post = new Post();

        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];

        $get_image = $request->file('post_image');

       if($get_image){
            $get_name_image=$get_image->getClientOriginalName(); // lay ten cua hinh anh
            $name_image=current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);

            $post->post_image = $new_image;

            $post->save();
        Session::put('message','Thêm thành công');
        return redirect()->back();
        }
        else{

            Session::put('message','Hãy chọn hình ảnh');
            return redirect()->back();
        }
    }
    public function unactive_product($product_id){
        $this->AuthLoginCheck();
        DB::table('tbl_product')->where('product_id',$product_id)
        ->update(['product_status'=>1]);
        Session::put('message','Không kích hoạt sản phẩm.');
        return Redirect::to('all-product');

    }
    public function active_product($product_id){
        $this->AuthLoginCheck();
        DB::table('tbl_product')->where('product_id',$product_id)
        ->update(['product_status'=>0]);
        Session::put('message','Kích hoạt sản phẩm thành công.');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        $this->AuthLoginCheck();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();

        $edit_product=DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product=view('admin.edit_product')
        ->with('edit_product',$edit_product)->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
        return view('layouts.admin_layout')->with('admin.edit_product',$manager_product);
    }
    public function update_product(Request $request, $product_id){
        $this->AuthLoginCheck();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message','Cập nhập thành công');
            return Redirect::to('/all-product');
        }

        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message','Cập nhập thành công');
        return Redirect::to('/all-product');
    }
    public function delete_product($product_id){
        $this->AuthLoginCheck();
        DB::table('tbl_product')->where('product_id',$product_id)-> delete();
        Session::put('message',' Xoá thành công');
        return Redirect::to('all-product');
    }
    //end admin page

}
