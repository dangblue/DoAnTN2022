<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Faker\Provider\ar_EG\Company;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class CouponController extends Controller
{
    public function AuthLoginCheck(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function insert_coupon(){
        $this->AuthLoginCheck();
        return view('admin.coupon.insert_coupon');
    }
    public function delete_coupon($coupon_id){
        $this->AuthLoginCheck();
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Session::put('message','Xóa mã giảm giá thành công.');
        return Redirect::to('list-coupon');
    }

    public function list_coupon(){
        $this->AuthLoginCheck();
        $coupon = Coupon::orderby('coupon_id','desc')->paginate(10);
        return view('admin.coupon.list_coupon')->with(compact('coupon'));
    }
    public function insert_coupon_code(Request $request){
        $this->AuthLoginCheck();
        $data = $request->all();

        $coupon = new Coupon;

        $coupon ->coupon_name = $data['coupon_name'];
        $coupon ->coupon_code = $data['coupon_code'];
        $coupon ->coupon_time = $data['coupon_time'];
        $coupon ->coupon_number = $data['coupon_number'];
        $coupon ->coupon_condition = $data['coupon_condition'];
        $coupon ->save();
        Session::put('message','Thêm mã giảm giá thành công.');
        return Redirect::to('insert-coupon');

    }
    public function unset_coupon(){

        $coupon = Session::get('coupon');
        if($coupon == true){
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã giảm giá thành công.');
        }
    }

}
