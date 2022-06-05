@extends('layouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục bài viết
                </header>
                <div class="panel-body">
                    <?php

                        use Illuminate\Support\Facades\Session;

                            $message = Session::get('message');
                        if($message){
                             echo '<b style="color:red">'.$message.'</b>';
                            Session::put('message',null);
                     }
                    ?>
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-category-post')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="cate_post_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="cate_post_slug" class="form-control" id="convert_slug" placeholder="Tên danh mục" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none;" rows="5" name="cate_post_desc" class="form-control" id="ckeditor1" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="cate_post_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>

                        <button type="submit" name="add_post_cate" class="btn btn-info">Thêm danh mục bài viết</button>
                    </form>
                    </div>
                </div>
            </section>

    </div>

    @stop();
