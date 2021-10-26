@extends('backend.layouts.main')

@section('content')

    <section class="content-header">
        <h1>
            Thêm mới danh mục <a href="{{route('category.index')}}" type="button"
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
                        <h3 class="box-title">Thông tin danh mục</h3>
                    </div>

                    <form role="form" action="{{ route('category.store') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">

                            @if($errors->has('name'))
                                <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                            @endif
                                            <label for="exampleInputEmail1">Tên danh mục</label>
                                            <input value="{{old('name')}}" type="text" class="form-control" id="title" name="name" placeholder="Nhập tên danh mục">
                                            <span class="help-block"> {{$errors->first('name')}} </span>

                                        </div>
                                        @if($errors ->has('image'))
                                            <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                        @endif
                                                        <label for="exampleInputFile">Ảnh</label>
                                                        <input type="file" id="image" name="image">
                                                        <span class="help-block"> {{$errors->first('image')}} </span>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="exampleInputEmail1">Vị trí</label>
                                                            <input type="number" class="form-control" id="position"
                                                                   name="position" value="0">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="categoryOption">Danh mục cha</label>
                                                            <select name="parents_id" id="parents_id" class="form-control">
                                                                <option value="0">--- Chọn ---</option>
                                                                @foreach($data as $item)
                                                                    <option value="{{$item -> id}}">{{$item -> name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" value="1" name="is_active">
                                                                    Trạng thái hiển thị
                                                                </label>
                                                            </div>
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
