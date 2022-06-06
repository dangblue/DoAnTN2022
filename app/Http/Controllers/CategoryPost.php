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

class CategoryPost extends Controller
{
    public function AuthLoginCheck(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_category_post(){
        $this->AuthLoginCheck();
        return view('admin.category_post.add_category_post');
    }

    public function all_category_post(){
        $this->AuthLoginCheck();

        $category_post = CatePost::orderBy('cate_post_id', 'desc')->paginate(6);

        return view('admin.category_post.list_category_post')->with(compact('category_post'));
    }
    public function save_category_post(Request $request){
        $this->AuthLoginCheck();
        $data = $request->all();
        $category_post = new CatePost();
        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];
        $category_post->save();

        Session::put('message','Thêm thành công');
        return redirect()->back();

    }
    public function edit_category_post($category_post_id){
        $this->AuthLoginCheck();
        $category_post = CatePost::find($category_post_id);
        return view('admin.category_post.edit_category_post')->with(compact('category_post'));
    }
    public function update_category_post(Request $request, $cate_id){
        $this->AuthLoginCheck();

        $data = $request->all();
        $category_post = CatePost::find($cate_id);
        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];
        $category_post->save();

        Session::put('message','Cập nhập thành công');
        return redirect('/all-category-post');

    }
    public function delete_category_post($cate_id){
        $this->AuthLoginCheck();
        $category_post = CatePost::find($cate_id);
        $category_post->delete();

        Session::put('message','Xóa thành công');
        return redirect()->back();

    }
    //end admin page

     //public function show_blog(){
        //$category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
        //$cate_product = DB::table('tbl_category_product')->where('category_status','0')
        //->orderBy('category_id','desc')->get();
        //$post = Post::with('cate_post')->where('post_status', '0')->get();
        //return view('pages.blog.blog')->with(compact('category_post'))->with('category',$cate_product)
        //->with('post',$post);
    //}

}
