@extends('layouts.site')
@section('main')

<link rel="stylesheet" href="{{url('public/frontend')}}/css/main.css" type="text/css">

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{url('public/frontend')}}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Đăng nhập-Đăng ký</h2>
                    <div class="breadcrumb__option">
                        <a href="{{URL::to('/')}}">Trang chủ</a>

                        <span>Đăng nhập-Đăng ký</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập tài khoản</h2>
                    <form action="{{URL::to('/login-customer')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" data-validation="email" data-validation-error-msg=" Nhập tài khoản gmail"
                        name="email_account" placeholder="Địa chỉ email" />
                        <input type="password" data-validation="length" data-validation-length="min4" data-validation-error-msg="Nhập mật khẩu và phải có ít nhất 4 ký tự"
                        name="password_account" placeholder="Mật khẩu" />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Nhớ đăng nhập
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng ký</h2>
                    <form action="{{URL::to('/add-customer')}}" method="POST">
                        {{csrf_field()}}
                        <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Nhập tên người dùng"
                        name="customer_name" placeholder="Tên người dùng"/>
                        <input type="email" data-validation="email" data-validation-error-msg=" Nhập tài khoản gmail" name="customer_email" placeholder="Địa chỉ email"/>
                        <input type="password" data-validation="length" data-validation-length="min4" data-validation-error-msg="Nhập mật khẩu và phải có ít nhất 4 ký tự"
                         name="customer_password" placeholder="Mật khẩu"/>
                        <input type="number" data-validation="number" data-validation-error-msg=" Nhập số điện thoại"
                         name="customer_phone" placeholder="Số điện thoại"/>
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@stop();
