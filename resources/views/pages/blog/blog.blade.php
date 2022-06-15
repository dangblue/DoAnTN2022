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
                    <h2>{{$meta_title}}</h2>
                    <div class="breadcrumb__option">
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <span>Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
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
                                    <span>{{$all->created_at}}</span>
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
            <div class="col-lg-8 col-md-7">
                <div class="row">
                    @foreach($post as $key => $value)
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">

                                <a href="{{URL::to('/bai-viet/'.$value->post_slug)}}"> <img src="{{asset('public/uploads/post/'.$value->post_image)}}" alt="{{$value->post_lug}}"> </a>
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> {{$value->created_at}}</li>
                                    <li><i class="fa fa-comment-o"></i>10</li>
                                </ul>
                                <h5><a href="{{URL::to('/bai-viet/'.$value->post_slug)}}">{{$value->post_title}}</a></h5>
                                <p> {!!$value->post_desc!!} </p>
                                <a href="{{URL::to('/bai-viet/'.$value->post_slug)}}" class="blog__btn">Xem thêm <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-12">
                        <div class="product__pagination blog__pagination">
                            <a href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->

@stop()
