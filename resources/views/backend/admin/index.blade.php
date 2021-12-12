@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Danh Sách Admin <a href="{{route('admins.create')}}" class="btn bg-olive btn-flat margin">Thêm Admin</a>
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
                                <th>Họ & Tên</th>
                                <th>Email</th>
                                <th>Hình ảnh</th>
                                <th>Phân Quyền</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Tác vụ</th>
                            </tr>
                            </thead>

                            <tbody>
                            <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                            @foreach($data as $key => $item)
                                <tr class="item-{{ $item->id }}"> <!-- Thêm Class Cho Dòng -->
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                    @if ($item->avatar) <!-- Kiểm tra hình ảnh tồn tại -->
                                        <img src="{{asset($item->avatar)}}" width="50" height="50">
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->role_id == 1)
                                            <p>Admin</p>
                                        @elseif ($item->role_id == 2)
                                            <p>Manager<p>
                                        @elseif ($item->role_id == 3)
                                            <p>Guest<p>
                                        @elseif ($item->role_id == 4)
                                            <p>Other<p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->is_active == 1)
                                            <span class="label label-success">Kích hoạt</span>
                                        @else
                                            <span class="label label-default">Chưa kích hoạt</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('admins.edit', ['id'=> $item->id])}}" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></a>
                                        <!-- Thêm sự kiện onlick cho nút xóa -->
                                        <button onclick="deleteItem('admin',{{ $item->id }})" class="btn btn-danger">
                                            <i class="fa fa-trash-o"></i></button>                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
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
