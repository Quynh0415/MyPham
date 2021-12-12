@extends('frontend.layouts.main')
@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="frontend/css/pay.css">
    <link rel="stylesheet" href="frontend/css/common.css">

@endsection
@section('content')
    <div class="grid wide">
            <div class="row">
                <div class="col l-7 m-12 s-12">
                    <div class="pay-information">
                        <div class="pay__heading">Thông tin thanh toán</div>
                        <div class="form-group">
                            <label for="account" class="form-label">Họ Tên *</label>
                            <input id="account" name="account" type="text" class="form-control">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="account" class="form-label">Địa chỉ *</label>
                            <input id="account" name="account" type="text" class="form-control">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="account" class="form-label">Tỉnh / Thành phố *</label>
                            <input id="account" name="account" type="text" class="form-control">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="account" class="form-label">Email *</label>
                            <input id="account" name="account" type="text" class="form-control">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="account" class="form-label">Số điện thoại *</label>
                            <input id="account" name="account" type="text" class="form-control">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group" style="margin-bottom: 30px;">
                            <label for="account" class="form-label" >Ghi chú cho đơn hàng</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="20"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col l-5 m-12 s-12">

                    <div class="pay-order">
                        <div class="pay__heading">Đơn hàng của bạn</div>
                        @foreach(Cart::content() as $item)
                                <div class="pay-info">
                                        <div class="main__pay-text ">
                                            {{ $item->name }}
                                    </div>

                                        <div class="main__pay-price ">
                                            @if($item->options['sale'] <= 0)
                                                <div class="main__cart-price">{{ $item->qty * $item->price }} ₫</div>
                                            @else
                                                <div
                                                    class="main__cart-price">{{$item->price * $item->qty - ($item->qty * $item->price * $item->options['sale'] * 0.01)}} ₫</div>
                                            @endif
                                        </div>
                            </div>
                        @endforeach
                        <div class="pay-info">
                            <div class="main__pay-text special">
                                Giao hàng
                            </div>
                            <div class="main__pay-text">
                                Giao hàng miễn phí
                            </div>

                        </div>
                        <div class="pay-info">
                            <div class="main__pay-text special">
                                Tổng thành tiền</div>
                            <div class="main__pay-price">
                                {{ Cart::subtotal() }} ₫
                            </div>
                        </div>

                        <div class="btn btn--default">Đặt hàng</div>


                    </div>
                </div>
            </div>
        </div>

@endsection
