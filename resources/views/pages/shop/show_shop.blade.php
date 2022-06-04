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
                        <a href="{{URL::to('/')}}">Home</a>
                        <span>Shop</span>
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
                        <h4>Danh mục sản phẩm</h4>
                        <ul>
                            @foreach($category as $key => $cate)
                        <li><b><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></b></li>
                        @endforeach
                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <h4>Price</h4>
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="10" data-max="540">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar__item sidebar__item__color--option">
                        <h4>Colors</h4>
                        <div class="sidebar__item__color sidebar__item__color--white">
                            <label for="white">
                                White
                                <input type="radio" id="white">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--gray">
                            <label for="gray">
                                Gray
                                <input type="radio" id="gray">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--red">
                            <label for="red">
                                Red
                                <input type="radio" id="red">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--black">
                            <label for="black">
                                Black
                                <input type="radio" id="black">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--blue">
                            <label for="blue">
                                Blue
                                <input type="radio" id="blue">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--green">
                            <label for="green">
                                Green
                                <input type="radio" id="green">
                            </label>
                        </div>
                    </div>
                    <div class="sidebar__item">
                        <h4>Popular Size</h4>
                        <div class="sidebar__item__size">
                            <label for="large">
                                Large
                                <input type="radio" id="large">
                            </label>
                        </div>
                        <div class="sidebar__item__size">
                            <label for="medium">
                                Medium
                                <input type="radio" id="medium">
                            </label>
                        </div>
                        <div class="sidebar__item__size">
                            <label for="small">
                                Small
                                <input type="radio" id="small">
                            </label>
                        </div>
                        <div class="sidebar__item__size">
                            <label for="tiny">
                                Tiny
                                <input type="radio" id="tiny">
                            </label>
                        </div>
                    </div>
                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>Latest Products</h4>
                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{url('public/frontend')}}/img/latest-product/lp-1.jpg" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{url('public/frontend')}}/img/latest-product/lp-2.jpg" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{url('public/frontend')}}/img/latest-product/lp-3.jpg" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="latest-prdouct__slider__item">
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{url('public/frontend')}}/img/latest-product/lp-1.jpg" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{url('public/frontend')}}/img/latest-product/lp-2.jpg" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{url('public/frontend')}}/img/latest-product/lp-3.jpg" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>Crab Pool Security</h6>
                                            <span>$30.00</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2>Giảm giá</h2>
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
                                        <div class="product__discount__percent">-0%</div>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i type="button" class="fa fa-heart button_wishlist" id="{{$pro->product_id}}" onclick="add_wishlist(this.id);"></i></a></li>
                                            <li><a id="wishlist_producturl{{$pro->product_id}}" href="{{URL::to('/chi-tiet-san-pham',$pro->product_id)}}"><i class="fa fa-retweet"></i></a></li>
                                            <li><a><i type="button" data-id_product="{{$pro->product_id}}" class="fa fa-shopping-cart add-to-cart" name="add-to-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span>{{$pro->category_name}}</span>
                                        <h5><a href="#">{{$pro->product_name}}</a></h5>
                                        <div class="product__item__price">{{$pro->product_price}} $ <span>{{$pro->product_price}} $</span></div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                <div class="filter__item">
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
                @foreach($product as $key => $product1)
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
                                <h5>${{$product1->product_price}}</h5>
                            </div>
                        </form>
                        </div>

                </div>
                @endforeach


                        {!!$product->links('pages.shop.my-paginate')!!}


            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->
<!-- Product Section End --
@stop();
