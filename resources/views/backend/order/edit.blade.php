@extends('backend.layouts.main')
@section('content')
    <style>
        #thongbao {
            position: absolute;
            margin-bottom: 0px;
            width: 350px;
            z-index: 1000;
            float: right;
            right: 22px;
        }
    </style>
    <section class="content-header">
        <h1>
            Chi Tiết Đơn Hàng <a href="{{route('admin.order.index')}}" class="btn bg-olive btn-flat margin"><i class="fa fa-list"></i> Danh Sách</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
            <li><a href="{{route('admin.order.index')}}">DS Đơn Hàng</a></li>
        </ol>
    </section>
    @if (session('msg'))
        <div class="pad margin no-print">
            <div class="alert alert-success alert-dismissible" style="" id="thongbao">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Thông báo !</h4>
                {{ session('msg') }}
            </div>
        </div>
    @endif

    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <form action="{{ route('admin.order.update', ['id' => $orders->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="box-header with-border">
                            <button type="submit" class="btn bg-olive btn-flat margin">
                                <i class="fa fa-edit"></i>
                                Cập nhật
                            </button>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td><label for="">Mã ĐH :</label></td>
                                    <td>{{ $orders->code }}</td>
                                    <td><label>Ngày Đặt Hàng:</label></td>
                                    <td>{{date('d/m/Y',strtotime($orders->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <td><label for="">Họ tên :</label></td>
                                    <td>{{ $orders->cus_name }}</td>
                                    <td><label>SĐT :</label> </td>
                                    <td>{{ $orders->cus_phone }}</td>
                                </tr>
                                <tr>
                                    <td><label>Email :</label></td>
                                    <td>{{  $orders->cus_email  }}</td>
                                    <td><label>Trạng thái ĐH</label></td>
                                    <td>
                                        @if($orders->orders_status_id == 3 || $orders->orders_status_id == 4 )

                                            <select class="form-control" disabled name="orders_status_id" style="max-width: 150px;display: inline-block;" >
                                                <option value="0">-- chọn --</option>
                                                @foreach($order_status as $status)
                                                    <option {{ ($orders->orders_status_id == $status->id ? 'selected':'') }} value="{{ $status->id }}">{{ $status->name }}</option>
                                                @endforeach

                                            </select>
                                        @else
                                            <select class="form-control " name="orders_status_id" style="max-width: 150px;display: inline-block;" >
                                                <option value="0">-- chọn --</option>
                                                @foreach($order_status as $status)
                                                    <option {{ ($orders->orders_status_id == $status->id ? 'selected':'') }} value="{{ $status->id }}">{{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td><label>Địa chỉ nhận hàng :</label> </td>
                                    <td colspan="">
                                        {{ $orders->cus_address }}
                                    </td>
                                    <td><label>Thành tiền</label></td>
                                    <td style="color: red"> {{number_format($orders->total,0,",",".") }} đ</td>


                                </tr>
                                <tr>
                                    <td><label>Ghi chú :</label> </td>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <textarea name="content" class="form-control" rows="3" placeholder="">{{ $orders->content }}</textarea>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
                <div class="box">

                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>TT</th>
                                <th style="max-with:200px">Tên SP</th>
                                <th>Hình ảnh</th>
                                <th>Loại</th>
                                <th>Số lượng</th>

                                <th>Giá</th>
                                <th>Thành tiền</th>
                                <th class="text-center"></th>
                            </tr>
                            </tbody>
                            <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                            @foreach($orders->orders_detail as $key => $item)
                                <tr class="item-{{ $item->id }}"> <!-- Thêm Class Cho Dòng -->
                                    <td>{{ $key + 1}}</td>
                                    <td>
                                        <a href="{{route('admin.product.edit', ['id'=> $item->products_id])}}">
                                            {{ substr($item->name, 0, 50) }}
                                        </a>
                                    </td>
                                    <td>
                                    @if ($item->image) <!-- Kiểm tra hình ảnh tồn tại -->
                                        <img src="{{asset($item->image)}}" width="50" height="50">
                                        @endif
                                    </td>

                                    <td>{{ $item->color_size }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->price,0,",",".") }} đ</td>

                                    <td style="color:red;">{{ number_format($item->price * $item->quantity,0,",",".") }} đ</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->

                </div>

            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
@endsection

@section('my_javascript')
    <script type="text/javascript">
        $(function () {
            // xóa sản phẩm khỏi giỏ hàng
            $(document).on("click", '.remove-to-cart', function () {
                var result = confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng ?");
                if (result) {
                    var order_detail_id = $(this).attr('data-id');
                    var order_id = $('#order_id').val();

                    $.ajax({
                        url: '/admin/order/remove-to-cart',
                        type: 'post',
                        data: {
                            order_id : order_id,
                            order_detail_id : order_detail_id
                        }, // dữ liệu truyền sang nếu có
                        dataType: 'json', // kiểu dữ liệu trả về
                        success: function (response) {
                            if (response.status == true) {
                                // xóa dòng vừa được click delete
                                $('.item-'+product_id).closest('tr').remove(); // class .item- ở trong class của thẻ td đã khai báo trong file index
                            }
                        },
                        error: function (e) { // lỗi nếu có
                            console.log(e.message);
                        }
                    });
                }
            });
        })
    </script>
@endsection

