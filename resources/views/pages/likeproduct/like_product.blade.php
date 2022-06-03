@extends('layouts.site')
@section('main')
<section class="breadcrumb-section set-bg" data-setbg="{{url('public/frontend')}}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Sản phẩm yêu thích</h2>
                    <div class="breadcrumb__option">
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <span>Sản phẩm yêu thích</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="shoping-cart spad">
<div class="container">
    <div class="row" id="row_wishlist">

    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="shoping__cart__btns">
                <a type="submit" href="{{URL::to('/')}}" class="primary-btn cart-btn">Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Breadcrumb Section End -->
<!-- Blog Section End -->
@stop();

