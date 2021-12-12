@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Danh sách sản phẩm <a href="{{route('admin.product.create')}}" type="button"
                                  class="btn bg-olive btn-flat margin">Thêm sản phẩm</a>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>TT</th>
                                <th>Tên SP</th>
                                <th>Danh Mục</th>
                                <th>Hình ảnh</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Tác vụ</th>
                            </tr>
                            </thead>

                            <tbody>
                            <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                            @foreach($product as $key => $item)
                                <tr class="item-{{ $item->id }}"> <!-- Thêm Class Cho Dòng -->
                                    <td>{{ $key + 1}}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        {{ @$item->categories->name }}
                                    </td>
                                    <td>
                                    @if ($item->image) <!-- Kiểm tra hình ảnh tồn tại -->
                                        <img src="{{asset($item->image)}}" width="50" height="50">
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->is_active == 1)
                                            <button class="btn btn-success" dataTarget="{{ $item->id }}"
                                                    onclick="changeStatus(this)" dataValue="0">
                                                Hiện
                                            </button>
                                        @else
                                            <button class="btn btn-success" dataTarget="{{ $item->id }}"
                                                    onclick="changeStatus(this)" dataValue="1">
                                                Ẩn
                                            </button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('admin.admin.product_image.create',['id'=>$item->id])}}"
                                           class="btn btn-info btn-warning">+</a>
                                        <a href="{{route('admin.product.edit',['id'=>$item->id])}}"
                                           class="btn btn-info"><i class="fa fa-pencil-square-o"></i></a>
                                        <button onclick="deleteItem('product',{{ $item->id }})" class="btn btn-danger">
                                            <i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>

    </section>

@endsection
@section('script')
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
        function  changeStatus(button) {
            $.ajax({
                url: "{{ route('admin.admin.product.stt') }}",
                method: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: button.attributes.dataTarget.value,
                    is_active: button.attributes.dataValue.value
                },
                success: function (result) {
                    console.log(button)
                    if (result.is_active == 0) {
                        button.attributes.dataValue.value = 1;
                        button.innerText = "Ẩn";
                        button.classList.toggle('btn-success');
                    }else {
                        button.attributes.dataValue.value = 0;
                        button.innerText = "Hiện";
                        button.classList.toggle('btn-success');
                    }
                },
                error: function (error) {
                    alert('Lỗi: ' + error);
                }
            })
        }
    </script>
@endsection
