@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>Ảnh chi tiết sản phẩm</h1>
    </section>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4>Thêm ảnh sản phẩm</h4>
                    </div>
                    <form role="form" action="{{route('product_image.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputFile">Ảnh sản phẩm</label>
                                <input type="file" class="" id="image" name="image">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Tạo</button>
                            <input type="reset" class="btn btn-default pull-right" value="Reset">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4>Danh sách ảnh sản phẩm</h4>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>TT</th>
                                <th>Ảnh</th>
                                <th class="text-center">Tác vụ</th>
                            </tr>
                            </thead>
                            <tbody>
{{--                            <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->--}}
                            @foreach($product->products_image as $key => $item)
                                <tr class="item-{{ $item->id }}"> <!-- Thêm Class Cho Dòng -->
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                    @if ($item->image) <!-- Kiểm tra hình ảnh tồn tại -->
                                        <img src="{{asset($item->image)}}" width="50" height="50">
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button onclick="deleteItem('product_image',{{ $item->id }})"
                                                class="btn btn-danger">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
