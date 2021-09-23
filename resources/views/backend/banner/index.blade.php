@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Danh Sách Banner <a href="{{ route('banner.create') }}" type="button" class="btn bg-olive btn-flat margin">Thêm Banner</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
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
                                    <td>{{ ($item->is_active == 1) ? 'Hiển thị' : 'Ẩn' }}</td>
                                    <td class="text-center">
                                        <a href="{{route('banner.edit',['id'=>$item->id])}}" class="btn btn-primary">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <button onclick="deleteItem('banner',{{ $item->id }})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                    </div>
                        </table>
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
    </script>
@endsection
