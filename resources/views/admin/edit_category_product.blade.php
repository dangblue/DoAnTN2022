@extends('layouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhập danh mục sản phẩm
                </header>
                    <?php

                        use Illuminate\Support\Facades\Session;

                            $message = Session::get('message');
                        if($message){
                            echo '<b style="color:red">'.$message.'</b>';
                        Session::put('message',null);
                     }
                    ?>
                <div class="panel-body">
                    @foreach($edit_category_product as $key => $edit_value)
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Nhập tên danh mục và phải có ít nhất 3 ký tự" value="{{$edit_value->category_name}}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none;" rows="5" name="category_product_desc" required
                            class="form-control" id="ckeditor1">{{$edit_value->category_desc}}</textarea>
                        </div>

                        <button type="submit" name="update_category_product" class="btn btn-info">Cập nhập danh mục</button>
                    </form>
                    </div>
                    @endforeach
                </div>
            </section>

    </div>

@stop()
