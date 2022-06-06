@extends('layouts.admin_layout')
@section('admin_content')

<div class="panel panel-default">
    <div class="panel-heading">
    Thông tin đăng nhập
    </div>

    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <?php

        use Illuminate\Support\Facades\Session;

            $message = Session::get('message');
        if($message){
    echo $message;
        Session::put('message',null);
     }
    ?>
        <thead>
          <tr>

            <th>Tên người đặt hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td>{{$order_1->customer_name}}</td>
            <td>{{$order_1->customer_phone}}</td>
            <td>{{$order_1->customer_email}}</td>
          </tr>

        </tbody>
      </table>
    </div>

  </div>
</div>
<br>
<div class="panel panel-default">
    <div class="panel-heading">
    Thông tin vận chuyển
    </div>

    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <?php



            $message = Session::get('message');
        if($message){
    echo $message;
        Session::put('message',null);
     }
    ?>
        <thead>
          <tr>

            <th>Tên người nhận</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Hình thức thanh toán</th>
            <th>Ghi chú đơn hàng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td>{{$order_2->shipping_name}}</td>
            <td>{{$order_2->shipping_address}}</td>
            <td>{{$order_2->shipping_phone}}</td>
            <td>{{$order_2->shipping_email}}</td>
            <td>{{$order_3->payment_method}}</td>
            <td>{{$order_2->shipping_notes}}</td>
          </tr>

        </tbody>
      </table>
    </div>

  </div>
</div>
<br>

<div class="panel panel-default">
    <div class="panel-heading">
    Chi tiết đơn hàng
    </div>

    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <?php

            $message = Session::get('message');
        if($message){
    echo $message;
        Session::put('message',null);
     }
    ?>
        <thead>
          <tr>

            <th>STT</th>

            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá </th>
            <th>Tổng giá</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @php
                $i=0;
            @endphp
            @foreach($order_by_Id as $key =>$v_content)
            @php
                $i++;
            @endphp
          <tr>
            <td><i>{{$i}}</i></td>
            <td>{{$v_content->product_name}}</td>
            <td>{{$v_content->product_sales_quantity}}</td>
            <td>{{$v_content->product_price}}</td>
            <td>{{$v_content->product_price*$v_content->product_sales_quantity}}</td>


          </tr>
            @endforeach
            <tr>
                <td>
                   <b> <i> Tổng thanh toán (Sau giảm): {{$v_content->order_total}} </i></b>
                </td>
            </tr>
        </tbody>
      </table>
    </div>

  </div>
</div>
@stop();
