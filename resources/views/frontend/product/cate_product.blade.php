@extends('frontend.layouts.main')
@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/product.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.min.css')}}">
@endsection
@section('content')
    <div class="main">
        <div class="grid wide">
            <div class="main__taskbar">
                <div class="main__breadcrumb">
                    <div class="breadcrumb__item">
                        <a href="#" class="breadcrumb__link">Trang chủ</a>
                    </div>
                    <div class="breadcrumb__item">
                        <a href="{{ route('sanpham') }}" class="breadcrumb__link">Cửa hàng</a>
                    </div>
                    <div class="breadcrumb__item">
                        <a href="#" class="breadcrumb__link"></a>
                    </div>
                </div>
            </div>
            <div class="productList">
                <div class="listProduct">
                    <div class="row">
                        @foreach($product as $item)
                        <div class="col l-2 m-4 s-6">
                                <div class="product">
                                    <div class="product__avt" style="background-image: url({{ asset($item->image) }});">
                                    </div>
                                    <div class="product__info">
                                        <h3 class="product__name">{{$item->name}}</h3>
                                        @php
                                            $first_detail = $item->products_detail()->first();
                                        @endphp
                                        @if($first_detail->sale <= 0)
                                            <div class="product__price">
                                                {{ number_format($first_detail->price,0,",",".") }}đ
                                            </div>
                                        @else
                                            <div class="product__price">
                                                <div class="price__old">
                                                    {{ number_format($first_detail->price,0,",",".") }}đ
                                                </div>
                                                <div class="price__new">{{number_format($first_detail->price - ($first_detail->price * $first_detail->sale * 0.01), 0,",",".")}}<span class="price__unit">đ</span></div>
                                            </div>
                                        @endif
                                        @if($first_detail->sale <= 0)
                                        @else
                                            <div class="product__sale">
                                                <span class="product__sale-text">Giảm</span>
                                                <span class="product__sale-percent">{{ number_format($first_detail->sale,  0,",",".") }}%</span>

                                            </div>
                                        @endif
                                    </div>
                                    <a href="{{ route('chitietsanpham', $item['slug']) }}" class="viewDetail">Xem chi tiết</a>
                                </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
