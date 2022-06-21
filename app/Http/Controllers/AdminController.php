<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Statistic;
use Carbon\Carbon;
session_start();

class AdminController extends Controller
{
    public function AuthLoginCheck(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function dashboard(){
        return view('admin_login');
    }

    public function show_dashboard(){
       $this->AuthLoginCheck();
        return view('admin.dashboard');
    }

    public function admin_dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = DB::table('tbl_admin')
        ->where('admin_email',$admin_email)
        ->where('admin_password',$admin_password)->first();
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Mật khẩu hoặc tài khoản không đúng');
            return Redirect::to('/admin');
        }
    }
    public function logout(){
        $this->AuthLoginCheck();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }

    public function manage_user(){
        $this->AuthLoginCheck();
        $all_user=DB::table('tbl_customers')
        ->orderBy('customer_id','desc')->paginate(10);
        //$manager_user=view('admin.user.manage_user')->with('all_user',$all_user);
        return view('admin.user.manage_user')->with('all_user',$all_user);
    }
    public function delete_user($customerId){
        $this->AuthLoginCheck();
        DB::table('tbl_customers')->where('customer_id',$customerId)-> delete();
        Session::put('message',' Xoá thành công');
        return Redirect::to('/manage-user');
    }

    public function filter_by_date(Request $request){
        $data = $request->all();

        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistic::whereBetween('order_date', [$from_date,$to_date])->orderBy('order_date','ASC')->get();
        foreach($get as $key => $val){

            $chart_data[] = array(

                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request){
        $data = $request->all();
        //echo $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if($data['dashboard_value']=='7ngay'){
            $get = Statistic::whereBetween('order_date',[$sub7days, $now])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangtruoc'){
            $get = Statistic::whereBetween('order_date',[$dau_thangtruoc, $cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangnay'){
            $get = Statistic::whereBetween('order_date',[$dauthangnay, $now])->orderBy('order_date','ASC')->get();
        }else{
            $get = Statistic::whereBetween('order_date',[$sub365days, $now])->orderBy('order_date','ASC')->get();
        }

        foreach($get as $key => $val){
            $chart_data[] = array(

                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
}
