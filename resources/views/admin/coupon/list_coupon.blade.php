@extends('layouts.admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
    Liệt kê mã giảm giá
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
            <th>Tên mã</th>
            <th>Mã giảm giá</th>
            <th>Số lượng mã</th>
            <th>Điều kiện giảm giá</th>
            <th>Số giảm</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @php
                $i=0;
            @endphp
            @foreach($coupon as $key => $cou)
            @php
                $i++;
            @endphp
          <tr>
            <td><i>{{$i}}</i></label></td>
            <td>{{$cou -> coupon_name}}</td>
            <td>{{$cou -> coupon_code}}</td>
            <td>{{$cou -> coupon_time}}</td>
            <td><span class="text-ellipsis">
             <?php
                if($cou -> coupon_condition == 1){
                ?>
                Giảm theo %
                <?php
                } else {
                ?>
                Giảm theo tiền
                <?php
                }
                ?>
                </span></td>

            <td>
                <td><span class="text-ellipsis">
                    <?php
                       if($cou -> coupon_condition == 1){
                       ?>
                       Giảm {{$cou->coupon_number}} %
                       <?php
                       } else {
                       ?>
                       Giảm {{$cou->coupon_number}} $
                       <?php
                       }
                       ?>
                       </span></td>

                   <td>

            <a onclick="return confirm('Bạn có muốn xóa?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}"
                class="active" ui-toggle-class="">
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
          <small class="text-muted inline m-t-sm m-b-sm"></small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

@stop()
