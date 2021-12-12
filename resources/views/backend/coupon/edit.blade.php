@extends('backend.layouts.main')

@section('content')

    <section class="content-header">
        <h1>
            Cập Nhật Trạng Thái Mã Giảm Giá <a href="{{route('admin.coupon.index')}}" type="button"
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
                        <h3 class="box-title">Thông tin mã giảm giá</h3>
                    </div>

                    <form role="form" action="{{ route('admin.coupon.update', ['id' => $coupon->id]) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Mã giảm giá:</label>
                                <input value="{{$coupon->code}}" type="text" class="form-control" id="code" name="code">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Số lượng giảm:</label>
                                <input value="{{$coupon->value}}" type="text" class="form-control" id="value" name="value">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Số lượng mã:</label>
                                <input value="{{$coupon->quantity}}" type="text" class="form-control" id="quantity" name="quantity">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Ngày hết hạn:</label>
                                <input type="date" class="form-control" value="{{$coupon->date_end}}" id="date_end" name="date_end">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Số tiền tối thiểu:</label>
                                <input value="{{$coupon->condition}}" type="text" class="form-control" id="condition" name="condition">
                            </div>
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input {{ ($coupon->is_active == 1) ? 'checked':'' }} type="checkbox" value="1" name="is_active">
                                        Trạng thái hiển thị
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Lưu</button>
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
