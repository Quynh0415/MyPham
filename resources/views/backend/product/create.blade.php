@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Thêm mới sản phẩm <a href="{{route('product.index')}}" class="btn btn-flat btn-success"><i
                    class="fa fa-list"></i> Danh Sách SP</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12 col-lg-12">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin sản phẩm</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" action="{{route('product.store')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            @if($errors->has('name'))
                                <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                            @endif
                                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   value="{{old('name')}}">
                                            <span class="help-block"> {{$errors->first('name')}} </span>
                                        </div>

                                        @if($errors ->has('image'))
                                            <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                        @endif
                                                        <label for="exampleInputFile">Ảnh sản phẩm</label>
                                                        <input type="file" class="" id="image" name="image">
                                                        <span class="help-block"> {{$errors->first('image')}} </span>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            @if($errors ->has('categories_id'))
                                                                <div class="col-md-6 has-error">
                                                                    @else
                                                                        <div class="col-md-6">
                                                                            @endif
                                                                            <label>Danh mục sản phẩm</label>
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
                                                                                           name="is_active"> <b>Trạng
                                                                                        thái hiển thị</b>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                </div>


                                                        </div>

                                                        <div class="form-group">
                                                            <label>Nội dung</label>
                                                            <textarea id="editor1" name="content" class="form-control"
                                                                      rows="10"
                                                                      placeholder="Enter ...">{{old('content')}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Mô tả</label>
                                                            <textarea id="editor2" name="description" class="form-control"
                                                                      rows="10"
                                                                      placeholder="Enter ...">{{old('description')}}</textarea>
                                                        </div>
                                                    </div>

                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-primary">Tạo</button>
                                                <input type="reset" class="btn btn-default pull-right" value="Reset">
                                            </div>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
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
