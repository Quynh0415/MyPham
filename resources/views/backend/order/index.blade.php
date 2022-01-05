@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Danh sách đơn hàng
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
                                <th>Họ & Tên</th>
                                <th>Email</th>
                                <th>SĐT</th>
                                <th>Ngày gửi</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Tác vụ</th>
                            </tr>
                            </thead>

                            <tbody>
                            <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                            @foreach($orders as $key => $item)
                                <tr class="item-{{ $item->id }}"> <!-- Thêm Class Cho Dòng -->
                                    <td>{{$key + 1}}</td>
                                    <td>{{ $item->cus_name }}</td>
                                    <td>{{ $item->cus_email }}</td>
                                    <td>{{ $item->cus_phone }}</td>
                                    <td>{{ $item->created_at}}</td>
                                    <td>
                                            @if ($item->orders_status_id == 1)
                                                <span class="label label-info">Mới</span>
                                            @elseif ($item->orders_status_id == 2)
                                                <span class="label label-warning">Đang XL</span>
                                            @elseif ($item->orders_status_id == 3)
                                                <span class="label label-success">Hoàn thành</span>
                                            @else
                                                <span class="label label-danger">Hủy</span>
                                            @endif
                                      </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.order.edit',$item->id) }}" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></a>
                                        <!-- Thêm sự kiện onlick cho nút xóa -->
                                        <button onclick="deleteItem('order',{{ $item->id }})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    </td>
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
