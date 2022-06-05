@extends('layouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thông tin website
                </header>
                <div class="panel-body">
                    <?php

                        use Illuminate\Support\Facades\Session;

                            $message = Session::get('message');
                        if($message){
                            echo '<b style="color:red">'.$message.'</b>';
                        Session::put('message',null);
                     }
                    ?>
                    <div class="position-center">
                        @foreach($contact as $key => $val)
                        <form role="form" action="{{URL::to('/update-info/'.$val->info_id)}}" method="post">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa chỉ</label>
                            <textarea style="resize: none;" rows="5" name="info_contact" class="form-control" placeholder="Thông tin liên hệ" required>
                            {{$val->info_contact}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số điện thoại </label>
                            <textarea style="resize: none;" name="info_phone" class="form-control" placeholder="Thông tin liên hệ" required>
                                {{$val->info_phone}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Giờ mở cửa</label>
                            <textarea style="resize: none;" name="info_time" class="form-control" placeholder="Thông tin liên hệ" required>
                                {{$val->info_time}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <textarea style="resize: none;" name="info_email" class="form-control" placeholder="Thông tin liên hệ" required>
                                {{$val->info_email}}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Bản đồ</label>
                                <textarea style="resize: none;" rows="5" name="info_map" class="form-control"  placeholder="Thông tin liên hệ" required>
                                    {{$val->info_map}}</textarea>
                            </div>
                        </div>


                        <button type="submit" name="add_info" class="btn btn-info">Cập nhập thông tin</button>
                    </form>
                    @endforeach
                    </div>
                </div>
            </section>

    </div>



@stop();
