@extends('backend.layouts.main')
@section('content')
    <section class="content-header">
        <h1>
            Danh sách đơn hàng đã hoàn thành
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">TT</th>
                                <th class="text-center">Ngày</th>
                                <th class="text-center">Mã ĐH</th>
                                <th>Họ tên</th>
                                <th>SĐT</th>
                                <th style="max-with:200px">Trạng thái</th>
                                <th>Tổng tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                            @foreach($orders as $key => $item)
                                <tr class="item-{{$item->id}}"> <!-- Thêm Class Cho Dòng -->
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-center">{{$item->created_at}}</td>
                                    <td class="text-center">{{$item->code}}</td>
                                    <td>{{$item->cus_name}}</td>
                                    <td>{{$item->cus_phone}}</td>
                                    <td>
                                        @if($item->orders_status_id)
                                            <span class="label label-success">Hoàn thành</span>
                                        @endif
                                    </td>
                                    <td class="price">{{ number_format(($item->total),0,",",".") }} đ</td>
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
