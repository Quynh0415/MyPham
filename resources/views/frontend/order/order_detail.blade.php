@extends('frontend.layouts.main')
@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/pay.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/common.css')}}">

@endsection
@section('content')

    <div class="grid wide">
        <form action="{{route('donhang')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col l-7 m-12 s-12">
                    <div class="pay-information">
                        <div class="pay__heading">Thông tin thanh toán</div>
                        <div class="form-group">
                            <label for="cus_name" class="form-label">Họ tên *</label>
                            <input id="cus_name" name="cus_name" type="text" class="form-control"
                                   @if(Auth::check()) value="{{ Auth::user()->name }}" @endif>
                            <span class="form-message">{{$errors->first('cus_name')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="cus_address" class="form-label">Địa chỉ *</label>
                            <input id="cus_address" name="cus_address" type="text" class="form-control"
                                   @if(Auth::check()) value="{{ Auth::user()->address }}" @endif>
                            <span class="form-message">{{$errors->first('cus_address')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="cus_email" class="form-label">Email *</label>
                            <input id="cus_email" @if(Auth::check()) value="{{ Auth::user()->email }}"
                                   @endif name="cus_email" type="text" class="form-control">
                            <span class="form-message">{{$errors->first('cus_email')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="cus_phone" class="form-label">Số điện thoại *</label>
                            <input id="cus_phone" name="cus_phone" @if(Auth::check()) value="{{ Auth::user()->phone }}"
                                   @endif type="text" class="form-control">
                            <span class="form-message">{{$errors->first('cus_phone')}}</span>
                        </div>
                        <div class="form-group" style="margin-bottom: 30px;">
                            <label for="account" class="form-label">Ghi chú cho đơn hàng</label>
                            <textarea class="form-control" name=content" id="content" cols="30"
                                      rows="20">{{old('content')}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col l-5 m-12 s-12">
                    <div class="pay-order">
                        <div class="pay__heading">Đơn hàng của bạn</div>
                        @foreach(Cart::content() as $item)
                            <div class="pay-info">
                                <div class="main__pay-text special">
                                    {{ $item->name }}
                                </div>
                                <div class="main__pay-price ">
                                        <div class="main__cart-price">{{ number_format($item->qty * $item->price, 0,",",".") }} ₫</div>
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
                                Thanh toán sau khi nhận hàng
                            </div>
                        </div>
                        <div class="pay-info">
                            <div class="main__pay-text special">
                                Tổng thành tiền
                            </div>
                            <div class="main__pay-price">
                                {{ Cart::subtotal(0,",",".") }} ₫
                            </div>
                        </div>
                        <button href="{{ route('msg') }}" class="btn btn--default">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
