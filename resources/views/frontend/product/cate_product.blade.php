@extends('frontend.layouts.main')
@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="frontend/css/product.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/bootstrap.min.css">
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
                        <a href="#" class="breadcrumb__link">Cửa hàng</a>
                    </div>
                    <div class="breadcrumb__item">
                        <a href="#" class="breadcrumb__link"></a>
                    </div>
                </div>
            </div>
            <div class="productList">
                <div class="listProduct">
                    <div class="row">
                        <div class="owl-carousel hight owl-theme">
                            @foreach($product as $item)
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
                                                {{ $first_detail->price }}đ
                                            </div>
                                        @else
                                            <div class="product__price">
                                                <div class="price__old">
                                                    {{ $first_detail->price }}đ
                                                </div>
                                                <div class="price__new">{{$first_detail->price - ($first_detail->price * $first_detail->sale * 0.01)}}<span class="price__unit">đ</span></div>
                                            </div>
                                        @endif
                                        @if($first_detail->sale <= 0)
                                        @else
                                            <div class="product__sale">
                                                <span class="product__sale-text">Giảm</span>
                                                <span class="product__sale-percent">{{ $first_detail->sale }}%</span>

                                            </div>
                                        @endif
                                    </div>
                                    <a href="{{ route('chitietsanpham', $item['slug']) }}" class="viewDetail">Xem chi tiết</a>
                                    <a href="cart.html" class="addToCart">Thêm vào giỏ</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="pagination">
                    <ul class="pagination__list">
                        <li class="pagination__item">
                            <a href="listFilm.html" class="pagination__link">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                        <li class="pagination__item active">
                            <a href="listFilm.html" class="pagination__link">1</a>
                        </li>
                        <li class="pagination__item">
                            <a href="listFilm.html" class="pagination__link">2</a>
                        </li>
                        <li class="pagination__item">
                            <a href="listFilm.html" class="pagination__link">3</a>
                        </li>
                        <li class="pagination__item">
                            <a href="listFilm.html" class="pagination__link">4</a>
                        </li>
                        <li class="pagination__item">
                            <a href="listFilm.html" class="pagination__link">5</a>
                        </li>
                        <li class="pagination__item">
                            <a href="listFilm.html" class="pagination__link">...</a>
                        </li>
                        <li class="pagination__item active">
                            <a href="listFilm.html" class="pagination__link">14</a>
                        </li>
                        <li class="pagination__item">
                            <a href="listFilm.html" class="pagination__link">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
