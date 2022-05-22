@extends('layouts.site')
@section('main')

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">

    <?php

        use Illuminate\Support\Facades\Session;

            $message = Session::get('message');
                if($message){

                    echo $message;


                        Session::put('message',null);
                    }
    ?>

    <div class="container">
        <form action="{{url('/update-cart')}}" method="POST">
            @csrf
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
                                @endphp
                            @foreach (Session::get('cart') as $key => $cart)
                                @php
                                  $subtotal = $cart['product_price'] * $cart['product_qty'];
                                  $total += $subtotal;
                                @endphp

                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="{{asset('public/uploads/product/'.$cart['product_image'])}}"
                                    width="100" alt="">
                                    <h5>{{$cart['product_name']}}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    {{$cart['product_price']}}$
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="number" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    {{$subtotal}}$
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
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">Nhập mã giảm giá</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Tổng giỏ hàng</h5>
                    <ul>
                        <li>Phí vận chuyển <span>{{$total}}$</span></li>
                        <li>Tổng tiền <span>{{$total}}$</span></li>

                    </ul>
                    <a href="#" class="primary-btn">Thanh toán</a>
                </div>
            </div>
        </div>
    </form>
    </div>

</section>
<!-- Shoping Cart Section End -->
@stop();
