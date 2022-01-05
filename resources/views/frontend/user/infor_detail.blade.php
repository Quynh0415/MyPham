@extends('frontend.layouts.main')
@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="frontend/css/pay.css">
    <link rel="stylesheet" href="frontend/css/common.css">

@endsection
@section('content')

    <div class="grid wide">
        <form action="{{route('capnhatthongtin', ['id' => $user->id])}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col l-7 m-12 s-12">
                    <div class="pay-information">
                        <div class="pay__heading">Thông tin khách hàng</div>
                        <div class="form-group">
                            <label for="name" class="form-label">Họ tên</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{ $user->name }}">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input id="address" name="address" type="text" class="form-control" value="{{ $user->address }}">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input id="phone" name="phone" type="text" class="form-control" value="{{ $user->phone }}">
                            <span class="form-message"></span>
                        </div>
                    </div>
                </div>
                <div class="col l-5 m-12 s-12">
                    <div class="pay-order">
                        <span class="form-message"></span>
                        <span class="form-message"></span>
{{--                        <div class="pay__heading"></div>--}}
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" value="{{ $user->email }}" name="email" type="text" class="form-control">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                            <span class="form-message"></span>
                        </div>
                        <button class="btn btn--default">Cập nhật thông tin</button>
                        <span class="form-message"></span>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
