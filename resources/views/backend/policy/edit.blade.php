@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Thay dổi chính sách hỗ trợ <a href="{{route('admin.policy.index')}}" type="button"
                                          class="btn bg-olive btn-flat margin">Chính sánh</a>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-9">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin chính sách</h3>
                    </div>
                    <form role="form" action="{{ route('admin.policy.update',['id' => $policy->id]) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên chính sách</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Nhập tên chính sách" value="{{ $policy->name }}">
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="editor1" name="content" class="form-control"
                                          rows="10"
                                          placeholder="Enter ...">{{$policy->content}}</textarea>
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
