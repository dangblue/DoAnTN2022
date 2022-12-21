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
                    <h2>Organi Shop</h2>
                    <div class="breadcrumb__option">
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <span>Cửa hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4 style="color: red">Danh mục sản phẩm</h4>
                        <ul>
                            @foreach($category as $key => $cate)
                        <li><b><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></b></li>
                        @endforeach
                        </ul>
                    </div>
                    <div class="sidebar__item">

                    </div>

                    <div class="sidebar__item">
                        <h4 style="color: red">Tags </h4>
                        <div class="sidebar__item__size">
                            <label for="large">

                                @foreach($pro_tag as $key => $pro_tag)
                                    @php
                                    $tags = $pro_tag->product_tags;
                                    $tags = explode(',',$tags);
                                    @endphp
                                    @foreach ($tags as $tag)
                                 <input type="radio" id="large"><a href="{{url('/tag/'.$tag)}}" ><h6><i class="fa fa-tag"> <b style="color: #7fad39"> {{$tag}} </b></i></h6></a>
                                @endforeach

                                @endforeach
                            </label>
                        </div>
                    </div>
                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4 style="color: red">Sản phẩm mới</h4>
                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">
                                    @foreach($product_new as $key =>$pro)
                                    <a href="{{URL::to('/chi-tiet-san-pham',$pro->product_id)}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">

                                            <img src="{{URL::to('/public/uploads/product/'.$pro->product_image)}}">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$pro->product_name}}</h6>
                                            <span>{{number_format($pro->product_price,0,',','.')}} VNĐ</span>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                                <div class="latest-prdouct__slider__item">
                                    @foreach($product_new as $key =>$pro)
                                    <a href="{{URL::to('/chi-tiet-san-pham',$pro->product_id)}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">

                                            <img src="{{URL::to('/public/uploads/product/'.$pro->product_image)}}">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$pro->product_name}}</h6>
                                            <span>{{number_format($pro->product_price,0,',','.')}} VNĐ</span>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2 style="color: red">Giảm giá</h2>
                    </div>
                    <div class="row">
                        <div class="product__discount__slider owl-carousel">
                            @foreach($product_show as $key =>$pro)
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <form>
                                        @csrf
                                        <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                                        <input type="hidden" id="wishlist_productname{{$pro->product_id}}" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                                        <input type="hidden" id="wishlist_valueimage{{$pro->product_id}}" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
                                        <input type="hidden" id="wishlist_productprice{{$pro->product_id}}" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
                                        <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">

                                    <div class="product__discount__item__pic set-bg">
                                        <img id="wishlist_productimage{{$pro->product_id}}" src="{{URL::to('/public/uploads/product/'.$pro->product_image)}}">
                                        <div class="product__discount__percent">-30%</div>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i type="button" class="fa fa-heart button_wishlist" id="{{$pro->product_id}}" onclick="add_wishlist(this.id);"></i></a></li>
                                            <li><a id="wishlist_producturl{{$pro->product_id}}" href="{{URL::to('/chi-tiet-san-pham',$pro->product_id)}}"><i class="fa fa-retweet"></i></a></li>
                                            <li><a><i type="button" data-id_product="{{$pro->product_id}}" class="fa fa-shopping-cart add-to-cart" name="add-to-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span>{{$pro->category_name}}</span>
                                        <h5><a href="#">{{$pro->product_name}}</a></h5>
                                        @php
                                            $a = $pro->product_price;
                                            $a = $a - $a * 30/100;
                                        @endphp

                                        <div class="product__item__price">{{number_format($a,0,',','.')}} VNĐ <span>
                                            {{number_format($a,0,',','.')}} VNĐ</span></div>

                                    </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                <div class="filter__item">
                    <div class="section-title product__discount__title">
                        <h2 style="color: red">Tất cả sản phẩm</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <form>
                                {{csrf_field()}}
                                <label for="amount">Sắp xếp</label>
                                    <select name="sort" id="sort" class="form-control">
                                        <option value="{{Request::url()}}?sort_by=none">Lựa chọn</option>
                                        <option value="{{Request::url()}}?sort_by=tang_dan">Tăng dần theo giá</option>
                                        <option value="{{Request::url()}}?sort_by=giam_dan">Giảm dần theo giá</option>
                                        <option value="{{Request::url()}}?sort_by=kytu_az">Sắp xếp tên từ A->Z</option>
                                        <option value="{{Request::url()}}?sort_by=kytu_za">Sắp xếp tên từ Z->A</option>
                                    </select>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                            &nbsp;
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                @foreach($all_product as $key => $product1)
                <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                        <form>
                    {{csrf_field()}}
                        <input type="hidden" value="{{$product1->product_id}}" class="cart_product_id_{{$product1->product_id}}">
                        <input type="hidden" id="wishlist_productname{{$product1->product_id}}" value="{{$product1->product_name}}" class="cart_product_name_{{$product1->product_id}}">
                        <input type="hidden" id="wishlist_valueimage{{$product1->product_id}}" value="{{$product1->product_image}}" class="cart_product_image_{{$product1->product_id}}">
                        <input type="hidden" id="wishlist_productprice{{$product1->product_id}}" value="{{$product1->product_price}}" class="cart_product_price_{{$product1->product_id}}">
                        <input type="hidden" name="qty" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                            <div class="product__item__pic set-bg">
                                <img id="wishlist_productimage{{$product1->product_id}}" src="{{URL::to('public/uploads/product/'.$product1->product_image)}}">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i type="button" class="fa fa-heart button_wishlist" id="{{$product1->product_id}}" onclick="add_wishlist(this.id);"></i></a></li>
                                    <li><a id="wishlist_producturl{{$product1->product_id}}" href="{{URL::to('/chi-tiet-san-pham',$product1->product_id)}}"><i class="fa fa-retweet"></i></a></li>
                                    <li><a><i type="button" data-id_product="{{$product1->product_id}}" class="fa fa-shopping-cart add-to-cart" name="add-to-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{URL::to('/chi-tiet-san-pham/'.$product1->product_id)}}">{{$product1->product_name}}</a></h6>
                                <h5>{{number_format($product1->product_price,0,',','.')}} VNĐ</h5>
                            </div>
                        </form>
                        </div>

                </div>
                @endforeach


                        {!!$all_product->links('pages.shop.my-paginate')!!}


            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->
<!-- Product Section End -->
@stop()
