@extends('layouts.site')
@section('main')
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
                    <h2>Giỏ hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">

    <?php

        use Illuminate\Support\Facades\Session;

            $message = Session::get('message');
                if($message){

                    echo '<b style="color:red">'.$message.'</b>';

                        Session::put('message',null);
                    }
    ?>

    <div class="container">
        <form action="{{url('/update-cart')}}" method="POST">
            {{csrf_field()}}

        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">

                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                    $total = 0;
                                    $cart1 = Session::get('cart');
                                    $cou1 = Session::get('coupon');
                                    if($cart1 == false){
                                            $cart1 = [];
                                        }
                                    if($cou1 == false){
                                            $cou1 = [];
                                        }
                            @endphp
                            @foreach($cart1 as $key => $cart)
                                @php
                                  $subtotal = $cart['product_price'] * $cart['product_qty'];
                                  $total += $subtotal;
                                @endphp

                            <tr>
                                <td class="shoping__cart__item">
                                    <a href="{{URL::to('/chi-tiet-san-pham',$cart['product_id'])}}">
                                        <img src="{{asset('public/uploads/product/'.$cart['product_image'])}}"
                                        width="100" alt="">
                                    </a>

                                    <h5>{{$cart['product_name']}}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    {{$cart['product_price']}} VNĐ
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="number" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    {{$subtotal}} VNĐ
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a class="icon_close" href="{{url('/del-product/'.$cart['session_id'])}}"></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a type="submit" href="{{URL::to('/')}}" class="primary-btn cart-btn">Tiếp tục mua sắm</a>
                    <input type="submit" value="Cập nhập giỏ hàng" name="update_qty" class="primary-btn cart-btn cart-btn-right">

                </div>
            </div>
            <div class="col-lg-8">
                <div class="shoping__checkout">
                    <h5>Tổng giỏ hàng</h5>
                    <ul>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Tổng tiền <span>{{number_format($total,0,',','.')}} VNĐ</span></li>
                        @if($cou1)
							<li>
									@foreach($cou1 as $key => $cou)
										@if($cou['coupon_condition']==1)
										Mã giảm <span>{{$cou['coupon_number']}} % </span>
											<p>
												@php
												$total_coupon = ($total*$cou['coupon_number'])/100;
												echo '<p><li>Tổng giảm:<span>'.number_format($total_coupon,0,',','.').'đ</span></li></p>';
												@endphp
											</p>
											<p><li>Tổng tiền sau giảm <span>{{number_format($total-$total_coupon,0,',','.')}} VNĐ</span></li></p>
										@elseif($cou['coupon_condition']==2)
											Mã giảm  <span>{{number_format($cou['coupon_number'],0,',','.')}} VNĐ</span>
											<p>
												@php
												$total_coupon = $total - $cou['coupon_number'];

												@endphp
											</p>
											<p><li> Tổng tiền sau giảm <span>{{number_format($total_coupon,0,',','.')}} VNĐ</span></li></p>
										@endif
									@endforeach
							</li>
						@endif
                    </ul>
                    <?php
                        $cart_checkout = Session::get('cart');
                        $customer_id = Session::get('customer_id');
                            if($customer_id != NULL && $cart_checkout !=NULL){
                            ?>
                                 <a href="{{URL::to('/checkout')}}" class="primary-btn" >Thanh toán</a>
                            <?php
                                }else{
                            ?>
                                <a href="{{URL::to('/login-checkout')}}" class="primary-btn" > Đăng nhập để thanh toán</a>
                            <?php
                                }
                            ?>
                </div>
            </div>
        </div>
    </form>
    @if(Session::get('cart'))
    <div class="col-lg-4">
        <div class="shoping__continue">
            <div class="shoping__discount">
                <h5>Mã giảm giá</h5>
                <form action="{{url('/check-coupon')}}" method="POST">
                    {{csrf_field()}}
                    <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br><br>
                    <input type="submit" class="site-btn check_coupon" name="check_coupon" value="Tính mã giảm giá"><br><br>
                    @if(Session::get('coupon'))
                    <a class="site-btn check_coupon" href="{{url('/unset-coupon')}}">Xóa mã giảm giá</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
    @endif
    </div>

</section>
<!-- Shoping Cart Section End -->
@stop()
