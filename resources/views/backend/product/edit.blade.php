@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Chi tiết sản phẩm <a href="{{route('product.index')}}" class="btn btn-flat btn-success"><i
                    class="fa fa-list"></i> Danh Sách SP</a>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-9">


            </div>

        </div>
    </section>
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
