@extends('backend.layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tổng quan
        </h1>
        <!-- <ol class="breadcrumb"> -->
        <!-- <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li> -->
        <!-- <li class="active">Tổng quan</li> -->
        <!-- </ol> -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$numOrder}}</h3>

                        <h4>Đơn Hàng</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag" ></i>
                    </div>
                    <a href="{{route('admin.order.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$numProduct}}</h3>

                        <h4>Sản phẩm</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('admin.product.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$numUser}}</h3>

                        <h4>Người dùng</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('admin.user.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{number_format($numTotal,0,",",".")}} đ</h3>

                        <h4>Tổng doanh thu</h4>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="{{route('tongdoanhthu')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Liên hệ</span>
                        <span class="info-box-number">{{$numContact}}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-leanpub"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bài viết</span>
                        <span class="info-box-number">{{$numArticle}}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Đơn đang xử lý</span>
                        <span class="info-box-number">{{$numProcess}}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-remove"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Đơn đã hủy</span>
                        <span class="info-box-number">{{$numCancel}}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
{{--        <div class="box">--}}
{{--            <div class="box box-default">--}}
{{--                <div class="box-header with-border">--}}
{{--                    <h3 class="box-title">Doanh số</h3>--}}

{{--                    <div class="box-tools pull-right">--}}
{{--                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>--}}
{{--                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /.box-header -->--}}
{{--                <div class="box-body">--}}
{{--                    <div class="chart_div">--}}
{{--                        <div id="columnchart_material" style="width: 800px; height: 500px;"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="box">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Đơn hàng</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" >
                    <div class="chart_div">
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
                                    @if ($item->orders_status_id)
                                        <span class="label label-info">Mới</span>
                                    @endif
                                </td>
                                <td class="price">{{ number_format(($item->total),0,",",".") }} đ</td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- /.content -->
@endsection


{{--@section('script')--}}
{{--    <script type="text/javascript">--}}
{{--        google.charts.load('current', {'packages':['bar']});--}}
{{--        google.charts.setOnLoadCallback(drawChart);--}}

{{--        function drawChart() {--}}
{{--            var data = google.visualization.arrayToDataTable([--}}
{{--                ['Doanh thu', 'Doanh thu'],--}}
{{--                ['Ngày', {{ $moneyDay }}],--}}
{{--                ['Tháng', {{ $moneyMonth }}],--}}
{{--                ['Năm', {{ $moneyYear }}],--}}

{{--            ]);--}}

{{--            var options = {--}}
{{--                chart: {--}}
{{--                    title: 'Thống kê doanh thu',--}}
{{--                    subtitle: 'Theo ngày, tháng, năm',--}}
{{--                },--}}
{{--                bars: 'vertical',--}}
{{--                vAxis: {format: 'decimal'},--}}
{{--                height: 400,--}}
{{--                colors: ['#1b9e77', '#d95f02', '#7570b3']--}}
{{--            };--}}

{{--            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));--}}

{{--            chart.draw(data, google.charts.Bar.convertOptions(options));--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}

@section('script')
@endsection

