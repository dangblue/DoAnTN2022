<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class CheckoutController extends Controller
{
    public function AuthLoginCheck(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function login_checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')
        ->orderBy('category_id','desc')->get();
        return view('pages.checkout.login_checkout')->with('category',$cate_product);
    }
    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);

        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);

        return Redirect::to('/checkout');


    }
    public function checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')
        ->orderBy('category_id','desc')->get();
        return view('pages.checkout.show_checkout')->with('category',$cate_product);
    }
    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes;
        $data['shipping_address'] = $request->shipping_address;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);

        //insert payment_method
        $data1 = array();
        $data1['payment_method'] = $request->payment_option;
        $data1['payment_status'] = 'Đang chờ xử lý';
        $payment_id =DB::table('tbl_payment')->insertGetId($data1);

        //insert order
        $total =0;
        foreach(Session::get('cart') as $key => $cart){
                $subtotal = $cart['product_price']*$cart['product_qty'];
                $total+=$subtotal;
        }
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = $total;
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order_details
        foreach($content = Session::get('cart') as $key => $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content['product_id'];
            $order_d_data['product_name'] = $v_content['product_name'];
            $order_d_data['product_price'] = $v_content['product_price'];
            $order_d_data['product_sales_quantity'] = $v_content['product_qty'];
            $result = DB::table('tbl_order_details')->insert($order_d_data);

        }

        Session::forget('cart');

        if($data1['payment_method']==1){
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
            $request->session()->forget('cart');
           return view('pages.checkout.payment')->with('category',$cate_product);

        }elseif($data1['payment_method']==2){
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
            $request->session()->forget('cart');
           return view('pages.checkout.payment')->with('category',$cate_product);
        }
    }

    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')->where('customer_email',$email)
        ->where('customer_password',$password)->first();
        if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/checkout');
        }else{
            return Redirect::to('/login-checkout');
        }

    }
    public function manage_order(){
        $this->AuthLoginCheck();
        $all_order=DB::table('tbl_order')
        ->join('tbl_customers','tbl_customers.customer_id','=','tbl_order.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderBy('tbl_order.order_id','desc')->get();
        $manager_order=view('admin.manage_order')->with('all_order',$all_order);
        return view('layouts.admin_layout')->with('admin.manage_order',$manager_order);
    }
    public function view_order($orderId){
        $this->AuthLoginCheck();

        $order_by_Id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_customers.customer_id','=','tbl_order.customer_id')
        ->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')
        ->join('tbl_order_details','tbl_order_details.order_id','=','tbl_order.order_id')
        ->select('tbl_order.*','tbl_order_details.*','tbl_customers.*','tbl_shipping.*')
        ->where('tbl_order.order_id',$orderId)->get();
        $manager_order_by_Id = view('admin.view_order')->with('order_by_Id',$order_by_Id);
        return view('layouts.admin_layout')->with('admin.view_order',$manager_order_by_Id);

    }

}
