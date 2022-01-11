@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Cập nhật trạng thái <a href="{{route('admin.contact.index')}}" type="button"
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
                        <h3 class="box-title">Thông tin khách hàng</h3>
                    </div>

                    <form role="form" action="{{ route('admin.contact.update',['id'=>$contact->id])}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Họ Tên</label>
                                    <input value="{{$contact->name}}" name="name"type="text" class="form-control" id="name"  placeholder="Nhập họ & tên">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input value="{{$contact->address}}" name="address"type="text" class="form-control" id="address" placeholder="Nhập địa chỉ">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input value="{{$contact->email}}" name="email"type="text" class="form-control" id="email"  placeholder="Nhập email">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input value="{{$contact->phone}}" name="phone"type="text" class="form-control" id="phone"  placeholder="Nhập SĐT">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Nội dung</label>
                                    <textarea name="content" class="form-control" rows="3" placeholder="">{{ $contact->content }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label>Trạng thái:</label>
                                    <select class="form-control" name="status">
                                        <option value="1" {{ ($contact->status == 1 ) ? 'selected': '' }}>--Chọn tình trạng--</option>
                                        <option value="2" {{ ($contact->status == 2 ) ? 'selected': '' }}>Đang xử lý</option>
                                        <option value="3" {{ ($contact->status == 3 ) ? 'selected': '' }}>Đã hủy</option>
                                        <option value="4" {{ ($contact->status == 4 ) ? 'selected': '' }}>Đã hoàn thành</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.box-body -->

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
