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
use Carbon\Carbon;
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
    public function all_post(){
        $this->AuthLoginCheck();
        $all_post= Post::with('cate_post')->orderBy('post_id')->get();

        return view('admin.post.list_post')->with((compact('all_post')));
    }
    public function save_post(Request $request){
        $this->AuthLoginCheck();
        $data = $request->all();
        $post = new Post();

        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_author = $data['post_author'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];
        $post->created_at = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
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
    public function delete_post($post_id){
        $this->AuthLoginCheck();
        $post = Post::find($post_id);
        $post_image = $post->post_image;

        if($post_image){
            $path = 'public/uploads/post/'.$post_image;
            unlink($path);
        }

        $post->delete();

        Session::put('message','Xóa thành công');
        return redirect()->back();

    }
    public function edit_post($post_id){
        $this->AuthLoginCheck();
        $post = Post::find($post_id);
        $cate_post = CatePost::orderBy('cate_post_id')->get();
        return view('admin.post.edit_post')->with(compact('post','cate_post'));
    }
    public function update_post(Request $request ,$post_id){
        $this->AuthLoginCheck();
        $data = $request->all();
        $post = Post::find($post_id);

        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_author = $data['post_author'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];
        $post->created_at = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $get_image = $request->file('post_image');

       if($get_image){
            //Xoa anh cu
            $post_image_old = $post->post_image;
            $path = 'public/uploads/post/'.$post_image_old;
            unlink($path);
            //Cap nhat anh moi
            $get_name_image=$get_image->getClientOriginalName(); // lay ten cua hinh anh
            $name_image=current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);

            $post->post_image = $new_image;
        }
        else{


        }
        $post->save();
        Session::put('message','Cập nhật bài viết thành công');
        return redirect()->back();
    }
    //end admin page
    public function blog(Request $request, $post_slug){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')
        ->orderBy('category_id','desc')->get();
        $catepost = CatePost::where('cate_post_slug', $post_slug)->take(1)->get();

        foreach($catepost as $key => $cate){
            $meta_desc = $cate->cate_post_desc;
            $meta_keywords = $cate->cate_post_slug;
            $meta_title = $cate->cate_post_name;
            $cate_id = $cate->cate_post_id;
            $url_canonical = $request->url();
        }
        $post = Post::with('cate_post')->where('post_status', '0')->where('cate_post_id', $cate_id)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
        $all_post = DB::table('tbl_posts')->where('post_status','0')
        ->orderBy('post_id','desc')->limit(3)->get();

        return view('pages.blog.blog')->with('category_post',$category_post)
        ->with('category',$cate_product)->with('post',$post)->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)->with('all_post',$all_post);
    }
    public function blog_details(Request $request, $post_slug){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')
        ->orderBy('category_id','desc')->get();
        //$catepost = CatePost::where('cate_post_slug', $post_slug)->take(1)->get();
        $post = Post::with('cate_post')->where('post_status', '0')->where('post_slug', $post_slug)->get();
        foreach($post as $key => $p){
            $meta_desc = $p->post_meta_desc;
            $meta_keywords = $p->post_meta_keywords;
            $meta_title = $p->post_title;
            $cate_id = $p->cate_post_id;
            $url_canonical = $request->url();
            $cate_post_id = $p->cate_post_id;
            $created = $p->created_at;
            $author = $p->post_author;
        }
        $related = Post::with('cate_post')->where('post_status', '0')->where('cate_post_id', $cate_post_id)
        ->whereNotIn('post_slug', [$post_slug])->take(5)->get();


        $all_post = DB::table('tbl_posts')->where('post_status','0')
        ->orderBy('post_id','desc')->limit(3)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();

        return view('pages.blog.blog_details')->with('category_post',$category_post)
        ->with('category',$cate_product)->with('post',$post)->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)->with('related',$related)->with('all_post',$all_post)
        ->with('created',$created)->with('author',$author);
    }
}
