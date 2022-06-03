@extends('layouts.site')
@section('main')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{url('public/frontend')}}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Chi tiết sản phẩm</h2>
                    <div class="breadcrumb__option">
                        <a href="{{URL::to('/')}}">Trang chủ</a>

                        <span>Chi tiết sản phẩm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@foreach ($product_details as $key => $value)

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" width="528" height="516"
                                src="{{URL::to('public/uploads/product/'.$value->product_image)}}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img class="product__details__pic__item--large"
                                src="{{URL::to('public/uploads/product/'.$value->product_image)}}" alt="">
                            <img class="product__details__pic__item--large"
                                src="{{URL::to('public/uploads/product/'.$value->product_image)}}" alt="">
                            <img class="product__details__pic__item--large"
                                src="{{URL::to('public/uploads/product/'.$value->product_image)}}" alt="">
                            <img class="product__details__pic__item--large"
                                src="{{URL::to('public/uploads/product/'.$value->product_image)}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">

                        <h3>{{$value->product_name}}</h3>

                        <form action="{{URL::to('/show-cart')}}" method="GET">
                            {{ csrf_field() }}
                        <div class="product__details__price">{{$value->product_price}}$</div>
                        <p>{!!$value->product_desc!!}</p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input name="qty" id="qty" type="number" value="1" min="1" data-decimals="0" required>
                                    <input name="productid_hidden" type="hidden" value="{{$value->product_id}}"/>

                                </div>
                            </div>
                        </div>
                        <button type="button" data-id_product="{{$value->product_id}}" class="primary-btn add-to-cart" name="add-to-cart">THÊM VÀO GIỎ HÀNG</button>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        </form>

                        <ul>

                            <li><b>Tình trạng</b> <span>Còn hàng</span></li>
                            <li><b>Danh mục</b> <span>{{$value->category_name}}</span></li>
                            <li><b>Phí ship</b> <span><samp>Miễn phí vận chuyển</samp></span></li>
                            <li><b>Cân nặng</b> <span>0.5 kg</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>{!!$value->product_content!!}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->
    @endforeach
    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Sản phẩm liên quan </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($related as $key => $relate)

                <div class="col-lg-3 col-md-4 col-sm-6">

                    <div class="product__item">
                        <form>
                            @csrf
                        <input type="hidden" value="{{$relate->product_id}}" class="cart_product_id_{{$relate->product_id}}">
                        <input type="hidden" value="{{$relate->product_name}}" class="cart_product_name_{{$relate->product_id}}">
                        <input type="hidden" value="{{$relate->product_image}}" class="cart_product_image_{{$relate->product_id}}">
                        <input type="hidden" value="{{$relate->product_price}}" class="cart_product_price_{{$relate->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$relate->product_id}}">
                        <div class="product__item__pic set-bg" data-setbg="{{URL::to('public/uploads/product/'.$relate->product_image)}}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="{{URL::to('/chi-tiet-san-pham',$relate->product_id)}}"><i class="fa fa-retweet"></i></a></li>
                                <li><a><i type="button" data-id_product="{{$relate->product_id}}" class="fa fa-shopping-cart add-to-cart" name="add-to-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">{{$relate->product_name}}</a></h6>
                            <h5>{{$relate->product_price}}.$</h5>
                        </div>
                    </form>
                    </div>

                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@stop();
