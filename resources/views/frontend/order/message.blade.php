@extends('frontend.layouts.main')
@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="frontend/css/new.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/product.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

@endsection
@section('content')
    <div class="grid wide">
        <div class="productInfo">
            <div class="row">
                <div class="news__body">
                    <div class="main__breadcrumb">
                        <style>
                            .buyother {
                                display: block;
                                overflow: hidden;
                                background: #fff;
                                line-height: 40px;
                                text-align: center;
                                margin: 15px auto;
                                width: 300px;
                                font-size: 14px;
                                color: #7a43b6;
                                font-weight: 700;
                                text-transform: uppercase;
                                border: 2px solid #7a43b6;
                                border-radius: 5px;
                            }
                        </style>
                        <br>
                        @if(session('msg'))
                            <h2 class="text-center"><i
                                    class="fa fa-opencart" style="color: #7a43b6"></i>{{ session('msg') ? session('msg') : '' }}</h2>
                        @else
                            <h2 class="text-center"><i class="fa fa-opencart" style="color: #7a43b6"></i>Bạn chưa có đơn hàng mới nào</h2>
                        @endif

                    </div>
                    <div>
                        <a href="/" class="buyother"><i class="fa fa-chevron-left"></i> Về trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
