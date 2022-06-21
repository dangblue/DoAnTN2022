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
                    @foreach($category_name as $key => $cate_name)
                        <h2> {{$cate_name->category_name}} </h2>
                    @endforeach
                    <div class="breadcrumb__option">
                        <a href="{{URL::to('/')}}">Trang chủ</a>

                        <span>Danh mục sản phẩm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">

                </div>
                <div class="featured__controls">
                    <ul>

                        <li class="active" data-filter="*" ><a href="{{URL::to('/shop')}}"><h3>Tất cả sản phẩm</h3></a></li>


                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            @foreach($category_by_id as $key => $product)

            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <form>
                        @csrf
                        <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                        <input type="hidden" id="wishlist_productname{{$product->product_id}}" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                        <input type="hidden" id="wishlist_valueimage{{$product->product_id}}" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                        <input type="hidden" id="wishlist_productprice{{$product->product_id}}" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                        <input type="hidden" name="qty" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                    <div class="featured__item__pic set-bg">
                        <img id="wishlist_productimage{{$product->product_id}}" src="{{URL::to('/public/uploads/product/'.$product->product_image)}}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i type="button" class="fa fa-heart button_wishlist" id="{{$product->product_id}}" onclick="add_wishlist(this.id);"></i></a></li>
                            <li><a id="wishlist_producturl{{$product->product_id}}" href="{{URL::to('/chi-tiet-san-pham',$product->product_id)}}"><i class="fa fa-retweet"></i></a></li>
                            <li><a><i type="button" data-id_product="{{$product->product_id}}" class="fa fa-shopping-cart add-to-cart" name="add-to-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">{{$product->product_name}}</a></h6>
                        <h5>{{number_format($product->product_price,0,',','.')}} VNĐ</h5>
                    </div>
                    </form>
                </div>

            </div>

            @endforeach
        </div>
    </div>
</section>
<!-- Featured Section End -->




@stop()
