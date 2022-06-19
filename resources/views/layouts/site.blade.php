<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani Shop</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{url('public/frontend')}}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/frontend')}}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/frontend')}}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/frontend')}}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/frontend')}}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/frontend')}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/frontend')}}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/frontend')}}/css/style.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/frontend')}}/css/sweetalert.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/addang')}}/css/formValidation.min.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/frontend')}}/css/lightgallery.min.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/frontend')}}/css/lightslider.css" type="text/css">
    <link rel="stylesheet" href="{{url('public/frontend')}}/css/prettify.css" type="text/css">
</head>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{url('public/frontend')}}/img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="{{URL::to('/wishlist')}}"><i class="fa fa-heart"></i> <span></span></a></li>
                <?php
                                if(Session::get('cart') != NULL){
                            ?>
                            <li>
                               <a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-bag" ></i><span id="show-cart-qt">'.$cart.'</span></a>
                            </li>
                            <?php
                                }else{
                            ?>
                             <li>
                                <a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-bag" ></i><span id="show-cart-qt">0</span></a>
                             </li>
                            <?php
                                }
                            ?>
            </ul>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="{{url('public/frontend')}}/img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">VietNam</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                        <?php
                            $customer_id = Session::get('customer_id');
                            if($customer_id != NULL){
                        ?>
                            <a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-user"></i> Đăng xuất</a>
                        <?php
                            }else{
                        ?>
                            <a href="{{URL::to('/login-checkout')}}"><i class="fa fa-user"></i> Đăng nhập</a>
                        <?php
                            }
                        ?>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                            <li><a href="{{URL::to('/shop')}}">Cửa hàng</a></li>
                            <li><a href="{{URL::to('/show-cart')}}">Giỏ hàng</a>
                                <ul class="header__menu__dropdown">
                                    <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != NULL){
                                    ?>
                                        <li><a href="{{URL::to('/checkout')}}">Thanh toán</a></li>
                                    <?php
                                        }else{
                                    ?>
                                        <li><a href="{{URL::to('/login-checkout')}}">Thanh toán</a></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </li>
                            <li><a href="#">Blog</a>
                                <ul class="header__menu__dropdown">
                                    @foreach($category_post as $key => $danhmucbaiviet)
                                    <li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}">{{$danhmucbaiviet->cate_post_name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{URL::to('/contact')}}">Liên hệ</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="https://www.facebook.com/OganiShopFood"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> damgblue@gmail.com</li>
                <li>Free Shipping toàn quốc</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->
    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> damgblue@gmail.com</li>
                                <li>Free Shipping toàn quốc</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="https://www.facebook.com/OganiShopFood"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="{{url('public/frontend')}}/img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">VietNam</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != NULL){
                                ?>
                                <a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-user"></i> Đăng xuất</a>
                                <?php
                                    }else{
                                ?>
                                <a href="{{URL::to('/login-checkout')}}"><i class="fa fa-user"></i> Đăng nhập</a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{URL::to('/')}}"><img src="{{url('public/frontend')}}/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                            <li><a href="{{URL::to('/shop')}}">Cửa hàng</a></li>
                            <li><a href="{{URL::to('/show-cart')}}">Giỏ hàng</a>
                                <ul class="header__menu__dropdown">

                                    <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != NULL){
                                    ?>
                                        <li><a href="{{URL::to('/checkout')}}">Thanh toán</a></li>
                                    <?php
                                        }else{
                                    ?>
                                        <li><a href="{{URL::to('/login-checkout')}}">Thanh toán</a></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </li>
                            <li><a href="#">Blog</a>
                                <ul class="header__menu__dropdown">
                                    @foreach($category_post as $key => $danhmucbaiviet)
                                    <li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}">{{$danhmucbaiviet->cate_post_name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{URL::to('/contact')}}">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart" >
                        <ul>
                            <li><a href="{{URL::to('/wishlist')}}"><i class="fa fa-heart"></i> <span></span></a></li>
                            <?php
                                if(Session::get('cart') != NULL){
                            ?>
                            <li>
                               <a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-bag" ></i><span id="show-cart-menu">'.$cart.'</span></a>
                            </li>
                            <?php
                                }else{
                            ?>
                             <li>
                                <a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-bag" ></i><span id="show-cart-menu">0</span></a>
                             </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    @yield('main')
    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="{{URL::to('/')}}"><img src="{{url('public/frontend')}}/img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Địa chỉ: 99 Nguyễn Chí Thanh - Láng Hạ - Đống Đa - Hà Nội</li>
                            <li>SĐT: 0975715824</li>
                            <li>Email: damgblue@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Liên kết hữu ích</h6>
                        <ul>
                            <li><a href="#">Về chúng tôi</a></li>
                            <li><a href="#">Giới thiệu về cửa hàng</a></li>
                            <li><a href="#">Mua sắm an toàn</a></li>
                            <li><a href="#">Thông tin phân phối</a></li>


                        </ul>
                        <ul>
                            <li><a href="#">Chính sách bảo mật</a></li>
                            <li><a href="#">Dịch vụ của cửa hàng</a></li>
                            <li><a href="#">Dự án</a></li>
                            <li><a href="{{URL::to('/contact')}}">Liên hệ</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Tham gia cùng chúng tôi</h6>
                        <p>Nhận thông tin cập nhật qua E-mail về các ưu đãi đặc biệt của cửa hàng.</p>
                        <form action="#">
                            <input type="text" placeholder="Nhập email của bạn">
                            <button type="submit" class="site-btn">Đặt ngay</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="https://www.facebook.com/OganiShopFood"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> Designed <i class="fa fa-heart" aria-hidden="true"></i> by <a href="{{URL::to('/')}}" target="_blank">Ogani</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="{{url('public/frontend')}}/img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('public/frontend/js/mixitup.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{url('public/frontend')}}/js/main.js"></script>
    <script src="{{url('public/frontend')}}/js/sweetalert.js"></script>
    <script src="{{url('public/frontend')}}/js/sweetalert.min.js"></script>
    <script src="{{url('public/addang')}}/js/jquery.form-validator.min.js"></script>
    <script src="{{url('public/frontend')}}/js/lightgallery-all.min.js"></script>
    <script src="{{url('public/frontend')}}/js/lightslider.js"></script>
    <script src="{{url('public/frontend')}}/js/prettify.js"></script>
    <script>
    $.validate({});
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#sort').on('change',function(){
                var url = $(this).val();
                if(url){
                    window.location = url;
                }
                return false;
            });
        });

    </script>

    <script type="text/javascript">
        show_cart_menu();
            function show_cart_menu(){
                $.ajax({
                    url:'{{url('/show-cart-menu')}}',
                    method:'get',
                    success:function(data){
                        $('#show-cart-menu').html(data);
                    }
                });
            }
            show_cart_qt();
            function show_cart_qt(){
                $.ajax({
                    url:'{{url('/show-cart-menu')}}',
                    method:'get',
                    success:function(data){
                        $('#show-cart-qt').html(data);
                    }
                });
            }
        $(document).ready(function(){


            $(".add-to-cart").click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_'+id).val();
                var cart_product_name = $('.cart_product_name_'+id).val();
                var cart_product_image = $('.cart_product_image_'+id).val();
                var cart_product_price = $('.cart_product_price_'+id).val();
                //var cart_product_qty = $('.cart_product_qty_'+id).val();
                var cart_product_qty = document.getElementById("qty").value;
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('/add-cart-ajax')}}",
                    method:"POST",
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image
                        ,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
                    success:function(data){
                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Tiếp tục mua hàng hoặc xem giỏ hàng ?",
                                showCancelButton: true,
                                cancelButtonText: "Tiếp tục",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Xem giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/show-cart')}}";
                            });
                            show_cart_menu();
                            show_cart_qt();
                        }
                    });
                });
            });
    </script>

    <script type="text/javascript">

        function view(){
            if(localStorage.getItem('data')!=null){
                var data = JSON.parse(localStorage.getItem('data'));
                data.reverse();
                document.getElementById('row_wishlist').style.overflow = 'scroll';
                document.getElementById('row_wishlist').style.height = '400px';

                for(i=0;i<data.length;i++){
                    var product_id = data[i].product_id;
                    //var attr_id = data[i].attr_id;
                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;
                    var valueImage = data[i].valueImage;
                    $("#row_wishlist").append('<div class="row"><div class="col-lg-12"><div class="shoping__cart__table"><table><thead><tr><th class="shoping__product">Sản phẩm</th><th>Giá</th></tr></thead> <tbody> <tr><td class="shoping__cart__item"> <a href="'+url+'"><img src="'+image+'" width="100" alt=""></a><h5>'+name+'</h5></td><td class="shoping__cart__price"><span>'+price+'</span></td><td><div class="row"><div class="col-lg-12"><div class="shoping__cart__btns"><input type="hidden" value="'+product_id+'" class="cart_product_id_'+product_id+'"><input type="hidden" value="'+name+'" class="cart_product_name_'+product_id+'"><input type="hidden" value="'+valueImage+'" class="cart_product_image_'+product_id+'"><input type="hidden" value="'+price+'" class="cart_product_price_'+product_id+'"><input type="hidden" name="qty" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required><input type="hidden" value="1" class="cart_product_qty_'+product_id+'"><a type="button" data-id_product="'+product_id+'" class="primary-btn cart-btn add-to-cart">Thêm vào giỏ hàng</a></div></div></div></td><td class="shoping__cart__item__close"><button><a type="button" class="icon_close delete_wishlist" data-id="'+product_id+'"></a></button></td> </tr></tbody></table></div>');
                }
            }
        }
        view();

        function add_wishlist(clicked_id){
            var product_id = clicked_id;
            //var attr_id = document.getElementById('wishlist_attrid'+product_id).value;
            var name = document.getElementById('wishlist_productname'+product_id).value;
            var price = document.getElementById('wishlist_productprice'+product_id).value;
            var image = document.getElementById('wishlist_productimage'+product_id).src;
            var url = document.getElementById('wishlist_producturl'+product_id).href;
            var valueImage = document.getElementById('wishlist_valueimage'+product_id).value;

            var newItem = {
                'url':url,
                'product_id':product_id,
                //'attr_id':attr_id,
                'name':name,
                'price':price,
                'image':image,
                'valueImage':valueImage,
            }

            if(localStorage.getItem('data')==null){
                localStorage.setItem('data','[]');
            }

            var oldData = JSON.parse(localStorage.getItem('data'));

            var matches = $.grep(oldData,function(obj){
                return obj.product_id == product_id;
            });

            if(matches.length){
                alert('Đã tồn tại trong danh mục yêu thích');
            }else{
                oldData.push(newItem);
            }
            localStorage.setItem('data',JSON.stringify(oldData));
        }
    </script>

    <script>
        $(document).on('click','.delete_wishlist',function(event){
            event.preventDefault(); // những hành động mặc định của sự kiện sẽ k xảy ra
                var id = $(this).data('id');
                if (localStorage.getItem('data') != null) {
                    var data = JSON.parse(localStorage.getItem('data'));
                    if (data.length) {
                            for (var i = 0; i < data.length; i++) {
                                if (data[i].product_id == id) {
                                data.splice(i,1); //xóa phần tử khỏi mảng, tham số thứ 2 là 1 phần tử
                            }
                        }
                    }

                    localStorage.setItem('data',JSON.stringify(data));  //chuyển obj->string
                    window.location.reload();
                }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
        gallery:true,
        item:1,
        loop:true,
        thumbItem:4,
        slideMargin:0,
        enableDrag: false,
        currentPagerPosition:'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }
    });
  });
    </script>

    <script>
        function remove_background(product_id)
        {
            for(var count = 1; count <=5; count++){
                $('#'+product_id+'-'+count).css('color','#ccc');
            }
        }
        //hover chuột đánh giá sao
        $(document).on('mouseenter', '.rating', function(){
            var index = $(this).data("index");
            var product_id = $(this).data("product_id");

            remove_background(product_id);

            for(var count = 1; count <=index; count++){
                $('#'+product_id+'-'+count).css('color','#ffcc00');
            }
        });
        //nhả chuột không đánh giá sao
        $(document).on('mouseleave', '.rating', function(){
            var index = $(this).data("index");
            var product_id = $(this).data("product_id");
            var rating = $(this).data("rating");
            remove_background(product_id);
            //alert(rating);
            for(var count = 1; count <=rating; count++){
                $('#'+product_id+'-'+count).css('color','#ffcc00');
            }
        });
        //click đánh giá sao
        $(document).on('click', '.rating', function(){
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('insert-rating')}}",
                method:"POST",
                data:{index:index, product_id:product_id,_token:_token},
                success:function(data){
                    if(data == 'done'){
                        alert("Bạn đã đánh giá "+ index +" trên 5 sao cho sản phẩm ");
                    }else{
                        alert("Lỗi đánh giá")
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            load_comment();
            function load_comment(){

                var product_id = $('.comment_product_id').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url:"{{url('/load-comment')}}",
                    method:"POST",
                    data:{product_id:product_id, _token:_token},
                    success:function(data){
                        $('#comment_show').html(data);
                    }
                });
            }
            $('.send-comment').click(function(){
                var product_id = $('.comment_product_id').val();
                var comment_name = $('.comment_name').val();
                var comment_content = $('.comment_content').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url:"{{url('/send-comment')}}",
                    method:"POST",
                    data:{product_id:product_id, _token:_token, comment_name:comment_name, comment_content:comment_content},
                    success:function(data){

                       $('#notify_comment').html(data);
                       alert("Cảm ơn đánh giá của bạn, bình luận của bạn sẽ sớm được duyệt");
                       load_comment();
                    }
                });
            });
        });
    </script>
</body>

</html>
