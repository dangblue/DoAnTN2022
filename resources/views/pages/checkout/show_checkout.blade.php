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
                        <a href="{{URL::to('/')}}">Home</a>
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
            <form action="{{URL::to('/save-checkout-customer')}}"  method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Họ và tên <span>*</span></p>
                                    <input type="text" name="shipping_name" class="shipping_name"  required>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ<span>*</span></p>
                            <input type="text" name="shipping_address" placeholder="Địa chỉ" class="shipping_address" required>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại<span>*</span></p>
                                    <input type="number"  name="shipping_phone" class="shipping_phone" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="email" name="shipping_email" class="shipping_email" required>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Ghi chú đơn hàng<span>*</span></p>
                            <input type="text" name="shipping_notes" class="shipping_notes" required>
                        </div>

                    </div>
                    @if(Session::get('coupon'))
                        @foreach(Session::get('coupon') as $key => $cou)
                        <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                        @endforeach
                    @else
                        <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                    @endif

                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Giỏ hàng của bạn</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Giá</span></div>
                            @php

                                    $total = 0;
                                    $cart1 = Session::get('cart');
                                    $cou1 = Session::get('coupon');
                                    //$coupon = Session::get('coupon');
                                    if($cart1 == false){
                                            $cart1 = [];
                                        }
                                    if($cou1 == false){
                                            $cou1 = [];
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
                                    <div class="checkout__order__total">Tổng giá
                                        <span>{{$total}}</span></div>
                            @if($cou1)

									@foreach($cou1 as $key => $cou)
										@if($cou['coupon_condition']==1)
										<div class="checkout__order__total">Mã giảm: <span>{{$cou['coupon_number']}} % </span></div>
											<p>
												@php
												$total_coupon = ($total*$cou['coupon_number'])/100;
												echo '<div class="checkout__order__total">Tổng giảm:<span>'.number_format($total_coupon,0,',','.').'đ</span></div>';
												@endphp
											</p>
											<div class="checkout__order__total">Tổng tiền sau giảm: <span>{{number_format($total-$total_coupon,0,',','.')}}$</span></div>
										@elseif($cou['coupon_condition']==2)
										<div class="checkout__order__total"> Mã giảm: <span>{{number_format($cou['coupon_number'],0,',','.')}} $</span> </div>
											<p>
												@php
												$total_coupon = $total - $cou['coupon_number'];

												@endphp
											</p>
											<div class="checkout__order__total"> Tổng tiền sau giảm: <span> {{number_format($total_coupon,0,',','.')}}$ </span></div>
										@endif
									@endforeach

						    @endif
                            <form method="POST" action="{{URL::to('/save-checkout-customer')}}">
                                {{csrf_field()}}
                            <div class="checkout__input__checkbox">
                                <label for="payment">
                                    Trả tiền mặt
                                    <input type="radio" id="payment" class="collapsed " name="payment_option" value="trả tiền mặt">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Thẻ ngân hàng
                                    <input type="radio" id="paypal" class="collapsed " name="payment_option" value="trả bằng thẻ" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </form>

                        <?php
                        $cart_checkout = Session::get('cart');

                            if($cart_checkout !=NULL){
                            ?>
                                 <button type="submit" name="send_order" class="site-btn send_order">ĐẶT HÀNG</button>
                            <?php
                                }else{
                            ?>
                            <button type="submit" name="send_order" class="site-btn send_order" style="pointer-events: none">ĐẶT HÀNG</button>

                            <?php
                                }
                            ?>




                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
@stop();
