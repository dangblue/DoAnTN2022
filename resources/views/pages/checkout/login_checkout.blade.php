@extends('layouts.site')
@section('main')

<style>
    #form {
    display: block;
    margin-bottom: 185px;
    margin-top: 185px;
    overflow: hidden;
}

.login-form {}

.signup-form {}

.login-form h2,
.signup-form h2 {
    color: #696763;
    font-family: 'Roboto', sans-serif;
    font-size: 20px;
    font-weight: 300;
    margin-bottom: 30px;
}

.login-form form input,
.signup-form form input {
    background: #F0F0E9;
    border: medium none;
    color: #696763;
    display: block;
    font-family: 'Roboto', sans-serif;
    font-size: 14px;
    font-weight: 300;
    height: 40px;
    margin-bottom: 10px;
    outline: medium none;
    padding-left: 10px;
    width: 100%;
}

.login-form form span {
    line-height: 25px;
}

.login-form form span input {
    width: 20px;
    float: left;
    height: 20px;
    margin-right: 8px;
}

.login-form form button {
    margin-top: 23px;
}

.login-form form button,
.signup-form form button {
    background: #7fad39;
    border: medium none;
    border-radius: 0;
    color: #FFFFFF;
    display: block;
    font-family: 'Roboto', sans-serif;
    padding: 6px 25px;
}

.login-form label {}

.login-form label input {
    border: medium none;
    display: inline-block;
    height: 0;
    margin-bottom: 0;
    outline: medium none;
    padding-left: 0;
}

.or {
    background: #7fad39;
    border-radius: 40px;
    color: #FFFFFF;
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
    height: 50px;
    line-height: 50px;
    margin-top: 75px;
    text-align: center;
    width: 50px;
}
</style>
<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Danh mục sản phẩm</span>
                    </div>
                    <ul>
                        @foreach($category as $key => $cate)
                        <li><b><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></b></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="{{URL::to('/tim-kiem')}}" method="POST">
                            {{csrf_field()}}
                            <input type="text" name="keywords_submit" placeholder="Nhập từ khóa cần tìm">
                            <button type="submit" name="search_items" class="site-btn">Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>0975715824</h5>
                            <span>Hỗ trợ 24/7</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
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
                        <button type="submit" class="btn btn-primary "><a href="{{URL::to('/quen-mat-khau')}}">Quên mật khẩu</a></button>
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
@stop()
