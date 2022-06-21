@extends('layouts.admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
    Liệt kê đơn hàng
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <?php

        use Illuminate\Support\Facades\Session;

            $message = Session::get('message');
        if($message){
            echo '<b style="color:red">'.$message.'</b>';
        Session::put('message',null);
     }
    ?>
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên người đặt hàng</th>
            <th>Thời gian đặt</th>
            <th>Tổng giá tiền</th>
            <th>Tình trạng đơn hàng</th>
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @php
                $i=0;
            @endphp
            @foreach($all_order as $key => $order)
            @php
            $i++;
            @endphp
          <tr>
            <td><i>{{$i}}</i></td>
            <td>{{$order -> customer_name}}</td>
            <td>{{$order -> created_at}}</td>
            <td>{{number_format($order ->order_total,0,',','.')}}</td>
            <td>
                <select name="product_cate" class="form-control input-sm m-bot15">
                    @if($order->order_status == 1)
                    <option selected value="1">Đang chờ xử lý</option>
                    <option value="2">Đang giao hàng</option>
                    <option value="3">Đã giao</option>
                    @elseif($order->order_status == 2)
                    <option value="1">Đang chờ xử lý</option>
                    <option value="2" selected>Đang giao hàng</option>
                    <option value="3">Đã giao</option>
                    @elseif($order->order_status == 3)
                    <option value="1">Đang chờ xử lý</option>
                    <option value="2">Đang giao hàng</option>
                    <option value="3" selected>Đã giao</option>
                    @endif
                </select>
            </td>


            <td>
            <a href="{{URL::to('/view-order/'.$order->order_id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i></a>
            <a onclick="return confirm('Bạn có muốn xóa?')" href="{{URL::to('/delete-order/'.$order->order_id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">

        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">
            {{$all_order->links('admin.pagination.pagination')}}

        </div>
      </div>
    </footer>
  </div>
</div>

@stop()
