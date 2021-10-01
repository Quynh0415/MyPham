@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Chi tiết sản phẩm <a href="{{route('product.index')}}" class="btn btn-flat btn-success"><i
                    class="fa fa-list"></i> Danh Sách SP</a>
        </h1>
    </section>
    <!-- Main content -->
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Thông tin sản phẩm</h4>
                </div>
                <div class="box-body">
                    <form role="form" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Thay đổi ảnh sản phẩm</label>
                            <input type="file" class="" id="new_image" name="new_image" ><br>
                            <img src="{{asset($product->image)}}" width="200">
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label>Danh mục sản phẩm</label>
                                <select class="form-control w-50" name="categories_id">
                                    <option value="0">--Chọn danh mục--</option>
                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}" {{($category->id == $product->categories_id) ? 'selected' : ''}} >
                                            {{ $category->name }}</option>
                                    @endforeach                            </select>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Vị trí</label>
                                <input value="{{ $product->position }}" type="number"
                                       class="form-control" id="position"
                                       name="position">
                            </div>
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="is_active" {{ ($product->is_active == 1 ) ? 'checked': '' }}> Trạng thái hiển thị
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>Chỉnh sửa thông tin</h4>
                </div>
                <div class="box-body">

                </div>
            </div>

        </div>

    </div>
    <!-- /.content -->

@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            // setup textarea sử dụng plugin CKeditor
            var _ckeditor = CKEDITOR.replace('editor1');
            _ckeditor.config.height = 200; // thiết lập chiều cao
        })
    </script>
@endsection
