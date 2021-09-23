@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Danh Sách Admin <a href="{{route('admins.create')}}" class="btn btn-info"><i class="fa fa-plus"></i>Thêm Admin</a>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
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
                                    <img src="{{asset($item->avatar)}}" width="70" height="70">
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
                                <td>{{ ($item->is_active == 1) ? 'Kích hoạt' : 'Chưa kích hoạt' }}</td>
                                <td class="text-center">
                                    <a href="{{route('admins.edit', ['id'=> $item->id])}}" class="btn btn-info">Sửa</a>
                                    <!-- Thêm sự kiện onlick cho nút xóa -->
                                    <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteItem('admin',{{ $item->id }})" >Xóa</a>
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
