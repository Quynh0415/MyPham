@extends('frontend.layouts.main')
@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/cart.css')}}">
@endsection
@section('content')
    <div class="main">
        <div class="grid wide">
            <h3 class="main__notify">
                <div class="main__notify-icon">
                    <i class="fas fa-check"></i>
                    <!-- <i class="fas fa-times"></i> -->
                </div>
                <div class="main__notify-text">Giỏ hàng đã được cập nhật.</div>
            </h3>
            <div class="row">
                <div class="col l-8 m-12 s-12">
                    <div class="main__cart">
                        <div class="row title">
                            <div class="col l-4 m-4 s-8">Sản phẩm</div>
                            <div class="col l-2 m-2 s-0">Giá</div>
                            <div class="col l-2 m-2 s-0">Số lượng</div>
                            <div class="col l-2 m-2 s-4">Tổng</div>
                            <div class="col l-1 m-1 s-0">Xóa</div>
                        </div>
                        <div class="row item">
                            <div class="col l-4 m-4 s-8">
                                <div class="main__cart-product">
                                    <img src="" alt="">
                                    <div class="name">Azrouel dress variable Azrouel dress variable</div>
                                </div>
                            </div>
                            <div class="col l-2 m-2 s-0">
                                <div class="main__cart-price">476.000 đ</div>
                            </div>
                            <div class="col l-2 m-2 s-0">
                                <div class="buttons_added">
                                    <input class="minus is-form" type="button" value="-" onclick="minusProduct()">
                                    <input aria-label="quantity" class="input-qty" max="10" min="1" name="" type="number" value="1">
                                    <input class="plus is-form" type="button" value="+" onclick="plusProduct()">
                                </div>
                            </div>
                            <div class="col l-2 m-2 s-4">
                                <div class="main__cart-price">476.000 đ</div>
                            </div>
                            <div class="col l-1 m-1 s-0">
                                <span class="main__cart-icon">
                                <i class="far fa-times-circle "></i>
                            </span>
                            </div>
                        </div>
                        <div class="btn btn--default">
                            Cập nhật giỏ hàng
                        </div>
                    </div>
                </div>
                <div class="col l-4 m-12 s-12">
                    <div class="main__pay">
                        <div class="main__pay-title">Tổng số lượng</div>
                        <div class="pay-info">
                            <div class="main__pay-text">
                                Tổng phụ</div>
                            <div class="main__pay-price">
                                1,120,000 ₫
                            </div>
                        </div>
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
                                Tổng thành tiền</div>
                            <div class="main__pay-price">
                                1,120,000 ₫
                            </div>
                        </div>
                        <div class="btn btn--default orange">Tiến hành thanh toán</div>
                        <div class="main__pay-title">Phiếu ưu đãi</div>
                        <input type="text" class="form-control">
                        <div class="btn btn--default">Áp dụng</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
