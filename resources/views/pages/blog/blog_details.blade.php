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


<!-- Blog Details Hero Begin -->
<section class="blog-details-hero set-bg" data-setbg="{{url('public/frontend')}}/img/blog/details/details-hero.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog__details__hero__text">
                    <h2>{{$meta_title}}</h2>
                    <ul>
                        <li>By Hai Dang</li>
                        <li>January 14, 2019</li>
                        <li>8 Comments</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 order-md-1 order-2">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Tìm kiếm...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Danh mục bài viết</h4>
                        <ul>
                            @foreach($category_post as $key => $danhmucbaiviet)
                            <li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}">{{$danhmucbaiviet->cate_post_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Bài viết gần đây</h4>
                        <div class="blog__sidebar__recent">
                            @foreach($all_post as $key => $all)
                            <a href="{{URL::to('/bai-viet/'.$all->post_slug)}}" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="{{asset('public/uploads/post/'.$all->post_image)}}" alt="{{$all->post_slug}}" width="100px" height="100px">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>{{$all->post_title}}</h6>
                                    <span>MAR 05, 2019</span>
                                </div>
                            </a>
                            @endforeach

                        </div>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Tags</h4>
                        <div class="blog__sidebar__item__tags">
                            <a href="#">Món hot</a>
                            <a href="#">Món ngon</a>
                            <a href="#">Hoa quả</a>
                            <a href="#">Nước trái cây</a>
                            <a href="#">Ẩm thực du lịch</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
                @foreach($post as $key => $value)
                <div class="blog__details__text">
                    <img src="{{asset('public/uploads/post/'.$value->post_image)}}" height="450px" width="710px" alt="{{$value->post_lug}}">
                    <p>{!!$value->post_content!!}</p>

                </div>

                <div class="blog__details__content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="blog__details__author">
                                <div class="blog__details__author__pic">
                                    <a href="https://www.facebook.com/dangblue.231"><img src="{{url('public/frontend')}}/img/blog/details/admindang.jpg" alt=""></a>

                                </div>
                                <div class="blog__details__author__text">
                                    <a href="https://www.facebook.com/dangblue.231"><h6>Hải Đăng</h6></a>
                                    <span>Admin</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="blog__details__widget">
                                <ul>
                                    <li><span>Danh mục:</span>  {{$value ->cate_post->cate_post_name}}</li>
                                    <li><span>Tags:</span>  {{$value->post_meta_keywords}} </li>
                                </ul>
                                <div class="blog__details__social">
                                    <a href="https://www.facebook.com/OganiShopFood"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->

<!-- Related Blog Section Begin -->
<section class="related-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related-blog-title">
                    <h2>Bài viết liên quan</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    @foreach($related as $key => $post_relate)
                    <div class="blog__item__pic">
                        <a href="{{URL::to('/bai-viet/'.$post_relate->post_slug)}}"> <img src="{{asset('public/uploads/post/'.$post_relate->post_image)}}" alt=""> </a>
                    </div>
                    <div class="blog__item__text">

                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="{{URL::to('/bai-viet/'.$post_relate->post_slug)}}">{{$post_relate->post_title}}</a></h5>
                        {!!$post_relate->post_desc!!}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Related Blog Section End -->


@stop();
