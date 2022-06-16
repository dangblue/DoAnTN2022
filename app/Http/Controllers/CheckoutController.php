<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use Carbon\Carbon;
use App\Models\CatePost;
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
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
        return view('pages.checkout.login_checkout')->with('category',$cate_product)
        ->with('category_post',$category_post);
    }
    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['created_at'] = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);

        return Redirect::to('/');


    }
    public function checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')
        ->orderBy('category_id','desc')->get();
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
        return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('category_post',$category_post);
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
        $total_coupon=0;

        $cart1 = Session::get('cart');
        $cou1 = Session::get('coupon');
        if($cart1 == false){
            $cart1 = [];
        }
        if($cou1 == false){
            $cou1 = [];
        }
        foreach($cart1 as $key => $cart){
                $subtotal = $cart['product_price']*$cart['product_qty'];
                $total+=$subtotal;

        }
        foreach($cou1 as $key => $cou){
            if($cou['coupon_condition']==1){
                $total_coupon = ($total*$cou['coupon_number'])/100;
            }
            else{
                $total_coupon = $cou['coupon_number'];
            }

        }
        $money = $total-$total_coupon;

        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = $money;
        $order_data['order_status'] = 'Đang chờ xử lý';

        $order_data['created_at'] = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order_details

        foreach($cart1 as $key => $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content['product_id'];
            $order_d_data['product_name'] = $v_content['product_name'];
            $order_d_data['product_price'] = $v_content['product_price'];
            $order_d_data['product_sales_quantity'] = $v_content['product_qty'];
            $result = DB::table('tbl_order_details')->insert($order_d_data);

        }

        Session::forget('cart');
        Session::forget('coupon');

        if($data1['payment_method']=='trả bằng thẻ ghi nợ'){
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
            $request->session()->forget('cart');
            $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
           return view('pages.checkout.payment')->with('category',$cate_product)->with('category_post',$category_post);

        }elseif($data1['payment_method']=='trả tiền mặt'){
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
            $request->session()->forget('cart');
            $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
           return view('pages.checkout.payment')->with('category',$cate_product)->with('category_post',$category_post);

        }elseif($data1['payment_method']=='thanh toán VNPay'){
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
            $request->session()->forget('cart');
            $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
           return view('pages.checkout.payment')->with('category',$cate_product)->with('category_post',$category_post);
        }

         //VN pay
         $data2 = $request->all();
         $code_cart = rand(00,9999);
         $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
         $vnp_Returnurl = "http://localhost:81/do-an-tn/checkout";
             $vnp_TmnCode = "XXEBN14A";//Mã website tại VNPAY
             $vnp_HashSecret = "JGMDPHACTKZNTHVCQEAXEQUHSOWUUDGT"; //Chuỗi bí mật

             $vnp_TxnRef = $code_cart; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
             $vnp_OrderInfo = 'Thanh toán đơn hàng test';
             $vnp_OrderType = 'billpayment';
             $vnp_Amount = $money * 100;
             $vnp_Locale = 'vn';
             $vnp_BankCode = 'NCB';
             $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
 //Add Params of 2.0.1 Version
 //$vnp_ExpireDate = $_POST['txtexpire'];
 //Billing

         $inputData = array(
         "vnp_Version" => "2.1.0",
         "vnp_TmnCode" => $vnp_TmnCode,
         "vnp_Amount" => $vnp_Amount,
         "vnp_Command" => "pay",
         "vnp_CreateDate" => date('YmdHis'),
         "vnp_CurrCode" => "VND",
         "vnp_IpAddr" => $vnp_IpAddr,
         "vnp_Locale" => $vnp_Locale,
         "vnp_OrderInfo" => $vnp_OrderInfo,
         "vnp_OrderType" => $vnp_OrderType,
         "vnp_ReturnUrl" => $vnp_Returnurl,
         "vnp_TxnRef" => $vnp_TxnRef


         );

         if (isset($vnp_BankCode) && $vnp_BankCode != "") {
         $inputData['vnp_BankCode'] = $vnp_BankCode;
         }
         if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
         $inputData['vnp_Bill_State'] = $vnp_Bill_State;
         }

 //var_dump($inputData);
     ksort($inputData);
     $query = "";
     $i = 0;
     $hashdata = "";
     foreach ($inputData as $key => $value) {
     if ($i == 1) {
         $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
     } else {
         $hashdata .= urlencode($key) . "=" . urlencode($value);
         $i = 1;
     }
     $query .= urlencode($key) . "=" . urlencode($value) . '&';
     }

     $vnp_Url = $vnp_Url . "?" . $query;
     if (isset($vnp_HashSecret)) {
     $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
     $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
     }
     $returnData = array('code' => '00'
     , 'message' => 'success'
     , 'data' => $vnp_Url);
     if (isset($_POST['redirect'])) {
         header('Location: ' . $vnp_Url);
         die();
     } else {
         echo json_encode($returnData);
     }

     // vui lòng tham khảo thêm tại code demo

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
            return Redirect::to('/');
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
        $order_1 = DB::table('tbl_order')->
        join('tbl_customers','tbl_customers.customer_id','=','tbl_order.customer_id')
        ->select('tbl_order.*','tbl_customers.*')
        ->where('tbl_order.order_id',$orderId)->first();

        $order_2 = DB::table('tbl_shipping')
        ->join('tbl_order','tbl_shipping.shipping_id','=','tbl_order.shipping_id')
        ->select('tbl_order.*','tbl_shipping.*')
        ->where('tbl_order.order_id',$orderId)->first();

        $order_3 = DB::table('tbl_payment')
        ->join('tbl_order','tbl_payment.payment_id','=','tbl_order.payment_id')
        ->select('tbl_order.*','tbl_payment.*')
        ->where('tbl_order.order_id',$orderId)->first();

        $order_by_Id = DB::table('tbl_order')
        ->join('tbl_order_details','tbl_order_details.order_id','=','tbl_order.order_id')
        ->select('tbl_order.*','tbl_order_details.*')
        ->where('tbl_order.order_id',$orderId)->get();

        $manager_order_by_Id = view('admin.view_order')->with('order_by_Id',$order_by_Id)
        ->with('order_1',$order_1)->with('order_2',$order_2)->with('order_3',$order_3);
        return view('layouts.admin_layout')->with('admin.view_order',$manager_order_by_Id);

    }
    public function delete_order($orderId){
        $this->AuthLoginCheck();
        DB::table('tbl_order')->where('order_id',$orderId)-> delete();
        Session::put('message',' Xoá thành công');
        $all_order=DB::table('tbl_order')
        ->join('tbl_customers','tbl_customers.customer_id','=','tbl_order.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderBy('tbl_order.order_id','desc')->get();
        return Redirect::to('/manage-order');
    }

    public function forgot_password(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')
        ->orderBy('category_id','desc')->get();
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
        return view('pages.checkout.forget_pass')->with('category',$cate_product)->with('category_post',$category_post);
    }

    //public function vnpay_payment(Request $request){

    //}

}
