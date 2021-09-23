@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Thêm Mới Tin Tức<a href="{{ route('article.index') }}" type="button"
                               class="btn bg-olive btn-flat margin">Danh Sách</a>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-9">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin Tin Tức</h3>
                    </div>
                    <form role="form" action="{{ route('article.store') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">

                            @if($errors->has('title'))
                                <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                            @endif
                                            <label for="exampleInputEmail1">Tiêu đề</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                   placeholder="Nhập tên tiêu đề" value="{{old('title')}}">
                                            <span class="help-block"> {{$errors->first('title')}} </span>
                                        </div>
                                        @if($errors->has('image'))
                                            <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                        @endif
                                                        <label for="exampleInputFile">Ảnh</label>
                                                        <input type="file" id="image" name="image">
                                                        <span class="help-block"> {{$errors->first('image')}} </span>
                                                    </div>

                                                    <div class="row">
                                                        @if($errors ->has('categories_id'))
                                                            <div class="form-group has-error">
                                                                @else
                                                                    <div class="col-md-6">
                                                                        @endif
                                                                        <label>Danh mục</label>
                                                                        <select class="form-control w-50"
                                                                                name="categories_id">
                                                                            <option value="0">-- chọn Danh Mục --
                                                                            </option>
                                                                            @foreach($categories as $category)
                                                                                <option
                                                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <span
                                                                            class="help-block"> {{$errors->first('categories_id')}} </span>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" value="1"
                                                                                       name="is_active"> Trạng thái hiển
                                                                                thị
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" value="1"
                                                                                       name="is_hot"> <b>Tin Tức Mới</b>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Vị
                                                                                trí</label>
                                                                            <input type="number" class="form-control"
                                                                                   id="position" name="position"
                                                                                   value="0">
                                                                        </div>
                                                                    </div>
                                                            </div>

                                                            @if($errors ->has('content'))
                                                                <div class="form-group has-error">
                                                                    @else
                                                                        <div class="form-group">
                                                                            @endif
                                                                            <label>Tóm tắt</label>
                                                                            <textarea name="content"
                                                                                      class="form-control" rows=3"
                                                                                      placeholder="Enter ...">{{old('content')}}</textarea>
                                                                            <span
                                                                                class="help-block"> {{$errors->first('content')}} </span>
                                                                        </div>

                                                                        @if($errors ->has('description'))
                                                                            <div class="form-group has-error">
                                                                                @else
                                                                                    <div class="form-group">
                                                                                        @endif
                                                                                        <label>Mô tả</label>
                                                                                        <textarea id="editor1" name="description" class="form-control" rows=10"
                                                                                                  placeholder="Enter ...">{{old('description')}}</textarea>
                                                                                        <span class="help-block"> {{$errors->first('description')}} </span>
                                                                                    </div>
                                                                            </div>

                                                                </div>

                                                                <!-- /.box-body -->

                                                                <div class="box-footer">
                                                                    <button type="submit" class="btn btn-primary">Tạo
                                                                    </button>
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
