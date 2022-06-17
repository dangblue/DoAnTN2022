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

                    <ul id="imageGallery">
                        @foreach($gallery as $key => $gal)
                        <li data-thumb="{{URL::to('public/uploads/gallery/'.$gal->gallery_image)}}"
                            data-src="{{URL::to('public/uploads/gallery/'.$gal->gallery_image)}}">
                          <img width="100%" alt="{{$gal->gallery_name}}" src="{{URL::to('public/uploads/gallery/'.$gal->gallery_image)}}" />
                        </li>
                        @endforeach
                      </ul>

                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">

                        <h3>{{$value->product_name}}</h3>
                        <form action="#" method="POST">
                            {{csrf_field()}}
                        <div class="product__details__rating">
                            @for($count=1; $count<=5; $count ++)
                                @php
                                    if($count <= $rating){
                                        $color = 'color:#ffcc00;';
                                    }else {
                                        $color = 'color:#ccc;';
                                    }
                                @endphp

                                <i title="đánh giá sao"
                                id="{{$value->product_id}}-{{$count}}"
                                data-index="{{$count}}"
                                data-product_id="{{$value->product_id}}"
                                data-rating="{{$rating}}"
                                class="rating"
                                style="cursor:pointer; {{$color}} font-size:30px;">&#9733;</i>

                            @endfor
                            <span>(Hãy cho mình 5 sao nếu bạn thích sản phẩm này nhé! Thanks:3 ! )</span>
                        </div>
                        </form>
                        <form action="{{URL::to('/show-cart')}}" method="GET">
                            {{ csrf_field() }}
                        <div class="product__details__price">{{$value->product_price}} VNĐ</div>

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
                            <li><b>Trọng lượng</b> <span>{{$value->product_weight}}</span></li>
                            <style type="text/css">
                                a.tags_style{
                                    margin: 3px 2px;
                                    border: 1px solid;
                                     height: auto;
                                     background: #0c5ca2
                                     color: #ffff;
                                     padding: 0px;
                                }
                                a.tags_style:hover{
                                    background: #7fad39;

                                }
                            </style>
                            <li><b>Tag</b>
                                <span><i class="fa fa-tag"></i>
                                    @php
                                        $tags = $value->product_tags;
                                        $tags = explode(',',$tags);
                                    @endphp
                                    @foreach ($tags as $tag)
                                        <a href="{{url('/tag/'.$tag)}}" class="tags_style">{{$tag}}</a>
                                    @endforeach
                                </span>
                            </li>

                            <li><b>Chia sẻ</b>
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
                                    aria-selected="true">Chi tiết</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Mô tả ngắn</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Đánh giá <span></span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Thông tin sản phẩm</h6>
                                    <p>{!!$value->product_content!!}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Mô tả sản phẩm</h6>
                                   <p>{!!$value->product_desc!!}</p>

                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="contact-form spad">
                                    <div class="container">

                                        <style>
                                            .row.style_comment{
                                                border: 1px solid #ddd;
                                                border-radius: 10px;
                                                background: #f0f0e9;
                                            }
                                        </style>
                                        <form action="{{url('/load-comment/'.$value->product_id)}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="comment_product_id" class="comment_product_id"
                                            value="{{$value->product_id}}">

                                        <div id="comment_show">
                                        </div>
                                        </form>
                                        <div class="blog__item__text">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="contact__form__title">
                                                    <h2>Đánh giá của bạn</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <form>
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <input type="text" class="comment_name" placeholder="Tên bình luận" required>
                                                </div>

                                                <div class="col-lg-12 text-center">
                                                    <textarea name="comment" class="comment_content" placeholder="Nhập nội dung của bạn" required></textarea>
                                                    <button type="submit" class="site-btn send-comment">Gửi đánh giá</button>
                                                </div>
                                                <div id="notify_comment">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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
                        <input type="hidden" id="wishlist_productname{{$relate->product_id}}" value="{{$relate->product_name}}" class="cart_product_name_{{$relate->product_id}}">
                        <input type="hidden" id="wishlist_valueimage{{$relate->product_id}}" value="{{$relate->product_image}}" class="cart_product_image_{{$relate->product_id}}">
                        <input type="hidden" id="wishlist_productprice{{$relate->product_id}}" value="{{$relate->product_price}}" class="cart_product_price_{{$relate->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$relate->product_id}}">
                        <div class="product__item__pic set-bg">
                            <img id="wishlist_productimage{{$relate->product_id}}" src="{{URL::to('public/uploads/product/'.$relate->product_image)}}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i type="button" class="fa fa-heart button_wishlist" id="{{$relate->product_id}}" onclick="add_wishlist(this.id);"></i></a></li>
                                <li><a id="wishlist_producturl{{$relate->product_id}}" href="{{URL::to('/chi-tiet-san-pham',$relate->product_id)}}"><i class="fa fa-retweet"></i></a></li>
                                <li><a><i type="button" data-id_product="{{$relate->product_id}}" class="fa fa-shopping-cart add-to-cart" name="add-to-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">{{$relate->product_name}}</a></h6>
                            <h5>{{$relate->product_price}} VNĐ</h5>
                        </div>
                    </form>
                    </div>

                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@stop()
