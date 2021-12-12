@extends('backend.layouts.main')

@section('content')
{{--    <div class="alert alert-warning alert-dismissible" role="alert">--}}
{{--        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
{{--        <strong>Thông báo!</strong> Better check yourself, you're not looking too good.--}}
{{--    </div>--}}
    <section class="content-header">
        <h1>
            Danh Sách Banner <a href="{{ route('admin.banner.create') }}" type="button" class="btn bg-olive btn-flat margin">Thêm Banner</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <td>TT</td>
                                <th>Tiêu đề</th>
                                <th>Hình ảnh</th>
                                <th>Vị trí</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Tác Vụ</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($data as $key =>$item)
                                <tr class="item-{{ $item->id }}"> <!-- Thêm Class Cho Dòng -->
                                    <td>{{ $key + 1}}</td>
                                    <td>{!! $item->title !!}</td>
                                    <td>
                                    @if ($item->image) <!-- Kiểm tra hình ảnh tồn tại -->
                                        <img src="{{ asset($item->image)}} " width="100" height="50">
                                        @endif
                                    </td>
                                    <td>{{ $item->position }}</td>
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
                                        <a href="{{route('admin.banner.edit',['id'=>$item->id])}}" class="btn btn-info">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <button onclick="deleteItem('banner',{{ $item->id }})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

@endsection
@section('script')
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
        function  changeStatus(button) {
            $.ajax({
                url: "{{ route('admin.admin.banner.stt') }}",
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
