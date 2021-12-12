@extends('frontend.layouts.main')
@section('head')
    @parent
    <link href="frontend/css/home.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="main">
        <!-- Slider -->
        <div class="main__slice">
            <div class="slider">
                @foreach($banner as $item)
                <div class="slide active" style="background-image:url({{ asset($item->image) }})">
                    <div class="container">
                        <div class="caption">
                            <h1>Giảm giá 10%</h1>
                            <p>Giảm giá cực sốc trong tháng 12!</p>
                            <a href="{{ route('sanpham') }}" class="btn btn--default">Xem ngay</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- controls  -->
            <div class="controls">

                <div class="prev">
                    <i class="fas fa-chevron-left"></i>
                </div>

                <div class="next">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            <!-- indicators -->
            <div class="indicator">
            </div>
        </div>
        <!--Product Category -->
        <div class="main__tabnine">
            <div class="grid wide">
                <!-- Tab items -->
                <div class="grid wide">
                    <h3 class="category__heading">SẢN PHẨM MỚI</h3>

                </div>
                <!-- Tab content -->
                <div class="owl-carousel hight owl-theme">
                    @foreach($newProducts as $item)
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
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        <!-- HightLight  -->
        <div class="main__frame">
            <div class="grid wide">
                <h3 class="category__heading">SẢN PHẨM NỔI BẬT</h3>
                <div class="owl-carousel hight owl-theme">
                    @foreach($hotProducts as $item)
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
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Sales Policy -->
        <!-- News -->
        <div class="main__frame bg-3">
            <div class="grid wide">
                <h3 class="category__heading">Tin Tức</h3>
                <div class="owl-carousel news owl-theme">
                    @foreach($article as $item)
                    <a href="{{ route('chitiettintuc',$item['slug']) }}" class="news" >
                        <div class="news__img">
                            <img src="{{ asset($item->image) }}" alt="">
                        </div>
                        <div class="news__body" >
                            <h3 class="news__body-title">{{ $item->title }}</h3>
                            <div class="new__body-date">{{date('d/m/Y',strtotime($item->created_at)) }}</div>
                            <p class="news__description">
                               {{ $item->content }}
                            </p>
                            <button href="{{ route('chitiettintuc',$item['slug']) }}" class="btn btn--default">Xem thêm</button>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="main__bands">
            <div class="grid wide">
                <div class="owl-carousel bands">
                    @foreach($brand as $item)
                    <a href="{{route('sanphamtheohang',$item['slug'])}}" class="band__item" style="background-image: url({{ $item->image }})"></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
