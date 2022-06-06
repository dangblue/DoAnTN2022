<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Contact;
use App\Models\CatePost;
session_start();

class ContactController extends Controller
{
    public function contact(Request $request){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')
        ->orderBy('category_id','desc')->get();
        $contact = Contact::where('info_id',1)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
        return view('pages.contact.contact')->with('category',$cate_product)->with('contact',$contact)
        ->with('category_post',$category_post);
    }
    public function information(){
        $contact = Contact::where('info_id',1)->get();
        return view('admin.information.add_information')->with(compact('contact'));
    }
    public function update_info(Request $request, $info_id){
        $data = $request->all();
        $contact = Contact::find($info_id);
        $contact->info_contact = $data['info_contact'];
        $contact->info_map = $data['info_map'];
        $contact->info_phone = $data['info_phone'];
        $contact->info_time = $data['info_time'];
        $contact->info_email = $data['info_email'];
        $contact->save();
        return redirect()->back()->with('message','Cập nhập thành công');

    }
    public function save_info(Request $request){
        $data = $request->all();
        $contact = new Contact();
        $contact->info_contact = $data['info_contact'];
        $contact->info_map = $data['info_map'];
        $contact->info_phone = $data['info_phone'];
        $contact->info_time = $data['info_time'];
        $contact->info_email = $data['info_email'];
        $contact->save();
        return redirect()->back()->with('message','Cập nhập thành công');
    }
}
