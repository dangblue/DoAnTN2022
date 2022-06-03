@extends('layouts.site')
@section('main')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{url('public/frontend')}}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Thanh toán</h2>
                    <div class="breadcrumb__option">
                        <a href="{{URL::to('/')}}">Trang chủ</a>

                        <span>Thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Đã đặt hàng thành công. Cảm ơn quý khách !</h2>
                </div>
            </div>
        </div>
    </div>
@stop();
