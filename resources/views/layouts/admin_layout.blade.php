<!DOCTYPE html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{url('public/addang')}}/css/bootstrap.min.css">
<meta name="csrf-token" content="{{csrf_token()}}">

<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{url('public/addang')}}/css/style.css" rel='stylesheet' type='text/css'/>
<link href="{{url('public/addang')}}/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{url('public/addang')}}/css/font.css" type="text/css"/>
<link href="{{url('public/addang')}}/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="{{url('public/addang')}}/css/morris.css" type="text/css"/>
<link rel="stylesheet" href="{{url('public/addang')}}/css/bootstrap-tagsinput.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="/resources/demos/style.css">
<link rel="stylesheet" href="{{url('public/addang')}}/css/monthly.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<!-- //calendar -->

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<!-- //font-awesome icons -->
<script src="{{url('public/addang')}}/js/jquery2.0.3.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{url('public/addang')}}/js/morris.js"></script>
<script src="{{url('public/addang')}}/js/bootstrap-tagsinput.js"></script>
<script src="{{url('public/addang')}}/js/bootstrap-tagsinput.min.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL::to('/dashboard')}}" class="logo">
        admin
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{url('public/addang')}}/images/addang.png">
                <span class="username">

                    <?php

use Illuminate\Support\Facades\Session;

$name = Session::get('admin_name');
    if($name){
        echo $name;
    }
    ?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Thông tin</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Cài đặt</a></li>
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->

    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan danh mục</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL::to('/information')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Thông tin website</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-order')}}">Quản lý đơn hàng</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Người dùng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-user')}}">Tài khoản người dùng</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
						<li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu sản phẩm</a></li>
						<li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
						<li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bình luận</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/comment')}}">Liệt kê bình luận</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/insert-coupon')}}">Thêm mã giảm giá</a></li>
                        <li><a href="{{URL::to('/list-coupon')}}">Liệt kê mã giảm giá</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span> Danh mục bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-post')}}">Thêm danh mục bài viết</a></li>
						<li><a href="{{URL::to('/all-category-post')}}">Liệt kê danh mục bài viết</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-post')}}">Thêm bài viết</a></li>
						<li><a href="{{URL::to('/all-post')}}">Liệt kê bài viết</a></li>
                    </ul>
                </li>

            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
      @yield('admin_content')
    </section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p> Copyright &copy;<script>document.write(new Date().getFullYear());</script> Designed <i class="fa fa-heart" aria-hidden="true"></i> by <a href="{{URL::to('/')}}" target="_blank">Ogani</a></p>
			</div>
		  </div>

  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{url('public/addang')}}/js/bootstrap.js"></script>
<script src="{{url('public/addang')}}/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="{{url('public/addang')}}/js/scripts.js"></script>
<script src="{{url('public/addang')}}/js/jquery.slimscroll.js"></script>
<script src="{{url('public/addang')}}/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{url('public/addang')}}/js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{url('public/addang')}}/js/jquery.scrollTo.js"></script>
<script src="{{url('public/addang')}}/ckeditor/ckeditor.js"></script>
<script src="{{url('public/addang')}}/js/jquery.form-validator.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


<script>
    $.validate({});
</script>

<script>
    CKEDITOR.replace( 'ckeditor1' );
    CKEDITOR.replace( 'ckeditor2' );
</script>
<script type="text/javascript">
    $(document).ready(function(){
        load_gallery();
        function load_gallery(){
            var pro_id= $('.pro_id').val();
            var _token = $('input[name="_token"]').val();
            //alert(pro_id);
            $.ajax({
                url:"{{url('/select-gallery')}}",
                method: "POST",
                data:{pro_id:pro_id,_token:_token},
                success:function(data){
                    $('#gallery_load').html(data);
                }
            });
        }
        $('#file').change(function(){
            var error = '';
            var files = $('#file')[0].files;

            if(files.length > 5){
                error+='<p>Chỉ được chọn tối đa 5 ảnh</p>';
            }else if(files.length==''){
                error+='<p>Bạn không được bỏ trống ảnh</p>';
            }else if(files.size > 2000000){
                error+='<p>File ảnh không được lớn hơn 2MB</p>';
            }
            if(error==''){

            }else{
                $('#file').val('');
                $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
                return false;
            }
        });

        $(document).on('blur','.edit_gal_name', function(){
            var gal_id = $(this).data('gal_id');
            var gal_text =$(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/update-gallery-name')}}",
                method: "POST",
                data:{gal_id:gal_id,gal_text:gal_text,_token:_token},
                success:function(data){
                    load_gallery();
                    $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>');
                }
            });

        });

        $(document).on('click','.delete-gallery', function(){
            var gal_id = $(this).data('gal_id');

            var _token = $('input[name="_token"]').val();
            if(confirm('Bạn muốn có muốn xóa ?')){
            $.ajax({
                url:"{{url('/delete-gallery')}}",
                method: "POST",
                data:{gal_id:gal_id,_token:_token},
                success:function(data){
                    load_gallery();
                    $('#error_gallery').html('<span class="text-danger">Xoá thành công</span>');
                }
            });
            }

        });

        $(document).on('change','.file_image',function(){

            var gal_id = $(this).data('gal_id');
            var image = document.getElementById("file-"+gal_id).files[0];

            var form_data = new FormData();

            form_data.append("file", document.getElementById("file-"+gal_id).files[0]);
            form_data.append("gal_id", gal_id);

            $.ajax({
                url:"{{url('/update-gallery')}}",
                method: "POST",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:form_data,

                contentType:false,
                cache:false,
                processData:false,
                success:function(data){
                    load_gallery();
                    $('#error_gallery').html('<span class="text-danger">Cập nhật thành công</span>');
                },
            });


        });
    });
</script>
<!-- morris JavaScript -->
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });

	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}

		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},

			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});


	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{url('public/addang')}}/js/monthly.js"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',

			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
    <script>
        $('.comment_duyet_btn').click(function(){
            var comment_status = $(this).data('comment_status');
            var comment_id = $(this).data('comment_id');
            var comment_product_id = $(this).attr('id');
            //alert(comment_status);
            //alert(comment_id);
            //alert(comment_product_id);
            if(comment_status==0){
                var alert = 'Duyệt thành công';
            }
            else{
                var alert = 'Hủy duyệt thành công';
            }
            $.ajax({
                url:"{{url('/allow-comment')}}",
                method: "POST",

                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{comment_id:comment_id,comment_status:comment_status,comment_product_id:comment_product_id},
                success:function(data){
                    location.reload();
                    $('#notify_comment').html('<span class="text text-alert"><b style="color:red">'+alert+'</b></span>');


                },
            });

        });

        $('.btn-reply-comment').click(function(){
            var comment_id = $(this).data('comment_id');
            var comment = $('.reply_comment_'+comment_id).val();

            var comment_product_id = $(this).data('product_id');
            //alert(comment);
            //alert(comment_id);
            //alert(comment_product_id);
            var alert = 'Trả lời bình luận thành công';


            $.ajax({
                url:"{{url('/reply-comment')}}",
                method: "POST",

                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{comment_id:comment_id,comment:comment,comment_product_id:comment_product_id},
                success:function(data){

                   $('#notify_comment').html('<span class="text text-alert"><b style="color:red">'+alert+'</b></span>');
                   $('.reply_comment_'+comment_id).val('');

                },
            });

        });
    </script>
	<!-- //calendar -->
    <script>
        $(function(){
            $("#datepicker").datepicker({
                prevText:"Tháng trước",
                nextText:"Tháng sau",
                dateFormat:"yy-dd-mm",
                dayNamesMin: ["Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
                duration:"slow"
            });
            $("#datepicker2").datepicker({
                prevText:"Tháng trước",
                nextText:"Tháng sau",
                dateFormat:"yy-dd-mm",
                dayNamesMin: ["Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
                duration:"slow"
            });
        });
    </script>
    <script>
        $(document).ready(function(){

            var chart = new Morris.Bar({
            // ID of the element in which to draw the chart.
            element: 'myfirstchart',
            lineColors: ['#819C79','#fc8710','#FF6541', '#A4ADD3', '#766B56'],
            pointFillColors: ['#ffffff'],
            pointStrokeColors: ['black'],
            fillOpacity: 0.3,
            hideHover:'auto',
            parseTime: false,

            // The name of the data record attribute that contains x-values.
            xkey: 'period',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['order','sales','profit', 'quantity'],
            behaveLikeLine: true,
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Đơn hàng','Doanh số','Lợi nhuận','Số lượng']
        });

        $('.dashboard-filter').change(function(){
            var dashboard_value = $(this).val();
            var _token = $('input[name="_token"]').val();
            //alert(dashboard_value);
            $.ajax({
                url: "{{url('/dashboard-filter')}}",
                method:"POST",
                dataType:"JSON",
                    data:{dashboard_value:dashboard_value, _token:_token},
                    success:function(data)
                    {
                        chart.setData(data);
                    }
            });
        });

            $('#btn-dashboard-filter').click(function(){
                //alert('ok đã nhận');
                var _token = $('input[name="_token"]').val();
                var from_date =$('#datepicker'). val();
                var to_date =$('#datepicker2'). val();
                //alert(from_date);
                //alert(to_date);
                $.ajax({
                    url:"{{url('/filter-by-date')}}",
                    method:"POST",
                    dataType:"JSON",
                    data:{from_date:from_date, to_date:to_date, _token:_token},
                    success:function(data)
                    {
                        chart.setData(data);
                    }
                });
            });
        });
    </script>
</body>
</html>
