@extends('backend.layouts.main')

@section('content')

    <section class="content-header">
        <h1>
            Cập nhật Banner <a href="{{ route('banner.index') }}" type="button" class="btn bg-olive btn-flat margin">Danh Sách</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-9">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin Banner</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('banner.update', ['id' => $banner->id ]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">

                            @if($errors->has('title'))
                                <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                            @endif
                                            <label for="exampleInputEmail1">Tiêu đề</label>
                                            <input value="{!! $banner->title !!}" type="text" class="form-control" id="title" name="title" placeholder="Nhập tên tiêu đề">
                                            <span class="help-block"> {{$errors->first('title')}} </span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputFile">Thay đổi ảnh</label>
                                            <input type="file" id="new_image" name="new_image">
                                            <!-- Hiển thị ảnh cũ -->
                                            <br>
                                            <img src="{{ asset($banner->image) }}" width="250">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tùy chỉnh liên kết Url</label>
                                            <input value="{{ $banner->url }}" type="text" class="form-control" id="url" name="url" placeholder="Url">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="1" name="is_active" {{ ($banner->is_active == 1 ) ? 'checked': '' }}> Trạng thái hiển thị
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Vị trí</label>
                                                    <input type="number" class="form-control" id="position" name="position" value="{{ $banner->position }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea id="editor1" name="description" class="form-control" rows="10" placeholder="Enter ...">{{ $banner->description }}</textarea>
                                        </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                    </form>
                </div>
                <!-- /.box -->


            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            // setup textarea sử dụng plugin CKeditor
            var _ckeditor = CKEDITOR.replace('editor1');
            _ckeditor.config.height = 200; // thiết lập chiều cao
            var _ckeditor = CKEDITOR.replace('editor2');
            _ckeditor.config.height = 200; // thiết lập chiều cao
        })
    </script>
@endsection
