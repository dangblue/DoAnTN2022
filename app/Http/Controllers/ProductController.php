<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use GuzzleHttp\Psr7\Message;
use App\Models\Product;
use App\Models\Gallery;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\CatePost;
use Illuminate\Support\Facades\File;
use App\Models\Rating;
use App\Models\Comment;
use phpDocumentor\Reflection\Types\Null_;

session_start();

class ProductController extends Controller
{
    public function AuthLoginCheck(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $this->AuthLoginCheck();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        $product = DB::table('tbl_product')->orderBy('product_id','desc')->get();

        return view('admin.add_product')->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product)->with('product',$product);

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
    public function save_product(Request $request){
        $this->AuthLoginCheck();
        $data = array();
        $data['product_name'] = $request->product_name; //Lấy giá trị từ input name="product_name"
        $data['product_tags'] = $request->product_tags;
        $data['product_price'] = $request->product_price;
        $data['product_weight'] = $request->product_weight;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');

        $path = 'public/uploads/product/';
        $path_gal = 'public/uploads/gallery/';
       if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            File::copy($path.$new_image,$path_gal.$new_image);
            $data['product_image'] = $new_image;

        }
        $pro_id= DB::table('tbl_product')->insertGetId($data);
        $gallery = new Gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();

        Session::put('message','Thêm thành công');
        return Redirect::to('/all-product');

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
        $data['product_tags'] = $request->product_tags;
        $data['product_price'] = $request->product_price;
        $data['product_weight'] = $request->product_weight;
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
    public function details_product($product_id, Request $request){
        //gallery
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')
        ->orderBy('category_id','desc')->get();
        $details_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_product.product_id',$product_id)->get();

        foreach($details_product as $key => $value){
            $category_id = $value -> category_id;
            $product_id = $value -> product_id;
            $url_canonical = $request->url();
        }

        $related_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
        //gallery
        $gallery = Gallery::where('product_id', $product_id)->get();
        //rating
        $rating = Rating::where('product_id', $product_id)->avg('rating');
        $rating = round($rating);

        return view('pages.product.show_details')->with('category',$cate_product)
        ->with('product_details',$details_product)->with('related',$related_product)
        ->with('category_post',$category_post)->with('gallery',$gallery)
        ->with('url_canonical',$url_canonical)->with('rating',$rating);
    }
    public function shop(){

        $product_show = DB::table('tbl_product')->where('product_status','0')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->orderBy('tbl_product.product_id','asc')->limit(6)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
       // $all_product = DB::table('tbl_product')->Paginate(6);
       $product_new = DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->limit(5)->get();
       $all_product = Product::orderBy('product_id','ASC')->Paginate(6);
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='kytu_za'){
                $all_product = Product::orderBy('product_name','DESC')->Paginate(6)->appends(request()->query());

            }elseif($sort_by=='kytu_az'){
                $all_product = Product::orderBy('product_name','ASC')->Paginate(6)->appends(request()->query());
            }elseif($sort_by=='tang_dan'){
                $all_product = Product::orderBy('product_price','ASC')->Paginate(6)->appends(request()->query());
            }elseif($sort_by=='giam_dan'){
                $all_product = Product::orderBy('product_price','DESC')->Paginate(6)->appends(request()->query());
            }
        }
        $pro_tag = Product::where('product_status','0')->take(5)->get();

        return view('pages.shop.show_shop')->with('category',$cate_product)->with('product',$all_product)
        ->with('product_show',$product_show)->with('category_post',$category_post)->with('product_new',$product_new)->with('pro_tag',$pro_tag);
    }
    public function tag(Request $request, $product_tag){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')
        ->orderBy('category_id','desc')->get();
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
        $tag = str_replace('-',' ',$product_tag);
        $pro_tag = Product::where('product_status','0')->where('product_name','LIKE','%'.$tag.'%')->
        orWhere('product_tags','LIKE','%'.$tag.'%')->get();


        return view('pages.product.tag')->with('category',$cate_product)->with('category_post',$category_post)
        ->with('product_tag',$product_tag)->with('pro_tag',$pro_tag);
    }

    public function insert_rating(Request $request){
        $data = $request->all(); //lấy tất cả dữ liệu trong form
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index']; //index la gia tri rating
        $rating->save();
        echo 'done';
    }
    public function list_comment(){
        $this->AuthLoginCheck();
        $comment = Comment::with('product')->where('comment_parent',NULL)->orderBy('comment_id','DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent','!=',NULL)->orderBy('comment_id','DESC')->get();
        return view('admin.comment.list_comment')->with(compact('comment'))->with(compact('comment_rep'));
    }

    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment_product_id = $product_id;
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_status = 1;
        $comment->comment_parent = NULL;
        $comment->save();

    }
    public function allow_comment(Request $request){
        $this->AuthLoginCheck();
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }

    public function reply_comment(Request $request){
        $this->AuthLoginCheck();
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent = $data['comment_id'];
        $comment->comment_status = 0;
        $comment->comment_name = 'Admin';
        $comment->save();
    }

    public function delete_comment($comment_id){
        $this->AuthLoginCheck();
        DB::table('tbl_comment')->where('comment_id',$comment_id)-> delete();
        Session::put('message',' Xoá thành công');
        return redirect()->back();
    }

    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id', $product_id)->where('comment_parent',NULL)->where('comment_status', 0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent','!=',NULL)->orderBy('comment_id','DESC')->get();
        $output = '';
        foreach($comment as $key => $comm){

            $output.= '

            <div class="row style_comment">
            <div class="col-md-2">
                <img width="60%" src="'.url('/public/frontend/img/avatar-icon-cm.jpg').'" class="img img-responsive img-thumbnail">
            </div>
            <div class="col-md-10">
                <p style="color: #7fad39;"><b>'.$comm->comment_name.'</b></p>
                <p style="color: #7fad39;"> Bình luận lúc: '.$comm->comment_date.'</p>
                <p>
                    '.$comm->comment.'
                </p>
            </div>
        </div>
        ';

            foreach($comment_rep as $key => $rep_comment){
            if($rep_comment->comment_parent == $comm ->comment_id){

            $output.= '<div class="row style_comment" style ="margin:5px 40px;">
            <div class="col-md-2">
                <img width="50%" src="'.url('/public/frontend/img/admin-icon.jpg').'" class="img img-responsive img-thumbnail">
            </div>
            <div class="col-md-10">
                <p style="color: #4682B4;"><b>Admin</b></p>
                <p style="color: #4682B4;"> Bình luận lúc: '.$rep_comment->comment_date.'</p>
                <p>
                '.$rep_comment->comment.'
                </p>
            </div>
        </div>';
            }
        }

    }
        echo $output;
    }

}
