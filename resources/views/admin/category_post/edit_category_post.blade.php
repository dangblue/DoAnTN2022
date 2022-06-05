@extends('layouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhập danh mục bài viết
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
                        <form role="form" action="{{URL::to('/update-category-post/'.$category_post->cate_post_id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="cate_post_name" value="{{$category_post->cate_post_name}}" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="cate_post_slug" value="{{$category_post->cate_post_slug}}" class="form-control" id="convert_slug" placeholder="Tên danh mục" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none;" rows="5" name="cate_post_desc" class="form-control" id="ckeditor1" placeholder="Mô tả danh mục">{{$category_post->cate_post_desc}}</textarea>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="cate_post_status" class="form-control input-sm m-bot15">
                                @if($category_post->cate_post_status == 0)
                                    <option selected value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                @else
                                    <option  value="0">Ẩn</option>
                                    <option selected value="1">Hiển thị</option>
                                @endif
                            </select>
                        </div>

                        <button type="submit" name="update_post_cate" class="btn btn-info">Cập nhật danh mục bài viết</button>
                    </form>
                    </div>
                </div>
            </section>

    </div>

@stop();
