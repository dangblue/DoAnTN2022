@extends('layouts.site')
@section('main')


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{url('public/frontend')}}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Checkout</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                </h6>
            </div>
        </div>
        <div class="checkout__form">
            <h4>Chi tiết đơn hàng</h4>
            <form action="{{URL::to('/save-checkout-customer')}}" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Họ và tên <span>*</span></p>
                                    <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Nhập tên người dùng" name="shipping_name">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ<span>*</span></p>
                            <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Nhập địa chỉ" name="shipping_address" placeholder="Street Address" class="checkout__input__add">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại<span>*</span></p>
                                    <input type="text" data-validation="number" data-validation-error-msg=" Nhập số điện thoại" name="shipping_phone">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" data-validation="email" data-validation-error-msg=" Nhập địa chỉ email" name="shipping_email">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Ghi chú đơn hàng<span>*</span></p>
                            <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Nhập ghi chú" name="shipping_notes"
                                placeholder="Ghi chú đơn hàng">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Giỏ hàng của bạn</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Giá</span></div>
                            @php

                                    $total = 0;
                                    $cart1 = Session::get('cart');
                                    if($cart1 == false){
                                            $cart1 = [];
                                        }
                            @endphp
                            @foreach($cart1 as $key => $cart)
                                    @php
                                        $subtotal = $cart['product_price']*$cart['product_qty'];
                                        $total+=$subtotal;
                                    @endphp
                                    <ul>
                                        <li>{{$cart['product_name']}}<span>{{$cart['product_price']*$cart['product_qty']}}</span></li>
                                    </ul>
                                @endforeach
                                    <div class="checkout__order__total">Tổng giá <span>{{$total}}</span></div>

                        <form method="POST" action="{{URL::to('/save-checkout-customer')}}">
                            {{csrf_field()}}
                            <div class="checkout__input__checkbox">
                                <label for="payment">
                                    Trả tiền mặt
                                    <input type="radio" id="payment" class="collapsed" name="payment_option" value="2">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Thẻ ngân hàng
                                    <input type="radio" id="paypal" class="collapsed" name="payment_option" value="1" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </form>
                            <button type="submit" name="send_order" class="site-btn">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
@stop();
