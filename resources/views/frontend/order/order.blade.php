@extends('frontend.layouts.main')
@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="frontend/css/cart.css">
@endsection
@section('content')
    <div class="main">
        <div class="grid wide">
            <h3 class="main__notify">
                <div class="category__heading">Giỏ hàng</div>
            </h3>
            <div class="row">
                <div class="col l-8 m-12 s-12">
                    <div class="main__cart">
                        <div class="row title">
                            <div class="col l-4 m-4 s-8">Sản phẩm</div>
                            <div class="col l-1 m-1 s-0">Loại</div>
                            <div class="col l-2 m-2 s-0">Giá</div>
                            <div class="col l-2 m-2 s-0">Số lượng</div>
                            <div class="col l-2 m-2 s-4">Tổng</div>
                            <div class="col l-1 m-1 s-0">Xóa</div>
                        </div>
                        @foreach(Cart::content() as $item)
                            <div class="row item">
                                <div class="col l-4 m-4 s-8">
                                    <div class="main__cart-product">
                                        <img src="{{ $item->options['image'] }}" alt="">
                                        <div class="name">{{ $item->name }}</div>
                                    </div>
                                </div>
                                <div class="col l-1 m-1 s-0">
{{--                                        @if($item->options['size'] == '')--}}
{{--                                            {{ $item->options['color'] }}--}}
{{--                                        @else--}}
{{--                                            {{ $item->options['size'] }}--}}
{{--                                        @endif--}}
                                </div>
                                <div class="col l-2 m-2 s-0">
                                    @if($item->options['sale'] <= 0)
                                        <div class="main__cart-price">{{ $item->price }}</div>
                                    @else
                                        <div
                                            class="main__cart-price">{{$item->price - ($item->price * $item->options['sale'] * 0.01)}}</div>
                                    @endif
                                </div>
                                <div class="col l-2 m-2 s-0">
                                    <div class="buttons_added">
                                        <input class="minus is-form" type="button" value="-" onclick="minusProduct()">
                                        <input aria-label="quantity" class="input-qty" max="10" min="1" name="qty"
                                               type="number" value="{{ $item->qty }}">
                                        <input class="plus is-form" type="button" value="+" onclick="plusProduct()">
                                    </div>
                                </div>
                                <div class="col l-2 m-2 s-4">
                                    @if($item->options['sale'] <= 0)
                                        <div class="main__cart-price">{{ $item->qty * $item->price }} ₫</div>
                                    @else
                                        <div
                                            class="main__cart-price">{{$item->price * $item->qty - ($item->qty * $item->price * $item->options['sale'] * 0.01)}} ₫</div>
                                    @endif
                                </div>
                                <div class="col l-1 m-1 s-0">
                                <span class="main__cart-icon">
                                    <a href="{{route('xoasanpham',[$item->rowId])}}">
                                        <i class="far fa-times-circle "></i>

                                    </a>
                            </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col l-4 m-12 s-12">
                    <div class="main__pay">
                        <div class="main__pay-title">Tổng số lượng</div>
                        <div class="pay-info">
                            <div class="main__pay-text">
                                Giao hàng
                            </div>
                            <div class="main__pay-text">
                                Giao hàng miễn phí
                            </div>

                        </div>
                        <div class="pay-info">
                            <div class="main__pay-text">
                                Tổng thành tiền
                            </div>
                            <div class="main__pay-price">
                                {{ Cart::subtotal()}} ₫
                            </div>
                        </div>
                        <a href="{{ route('thanhtoan') }}" class="btn btn--default orange">Tiến hành thanh toán</a>
                        <div class="main__pay-title">Phiếu ưu đãi</div>
                        <input type="text" class="form-control">
                        <div class="btn btn--default">Áp dụng</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
