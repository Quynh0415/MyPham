@extends('frontend.layouts.main')
@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="frontend/css/contact.css">
@endsection
@section('content')
        <div class="grid wide">
            <div class="main__breadcrumb">
                <div class="breadcrumb__item">
                    <a href="#" class="breadcrumb__link">Trang chủ</a>
                </div>
                <div class="breadcrumb__item">
                    <a href="#" class="breadcrumb__link">Liên hệ</a>
                </div>
            </div>
            <div class="row">
                <div class="col l-6 m-12 s-12">
                    <<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d931.1666079744218!2d105.93595952914497!3d21.00600425110472!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a8ce6c5bd531%3A0x9dd01c9f5e7daf99!2zc-G7kSA5LCA2OCBOZ8O1IDY4LCBUcsOidSBRdeG7sywgR2lhIEzDom0sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1637773043800!5m2!1svi!2s"
                             width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

                </div>
                <div class="col l-6 m-12 s-12">
                    <div class="contact__wrap">
                        <div class="contact__img">
                            <img src="{{ $setting->image }}" alt="">
                        </div>
                        <ul class="contact__info">
                            <li class="contact__text">
                                <i class="fas fa-map-marked-alt"></i> {{ $setting->address }}
                            </li>
                            <li>
                                <a href="tel:076 922 0162" class="contact__link">
                                    <i class="fas fa-phone"></i> {{ $setting->phone }}
                                </a>
                            </li>

                            <li>
                                <a href="#" class="contact__link">
                                    <i class="fas fa-envelope"></i> {{ $setting->email }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <form action="{{route('lien-he')}}" method="POST">
                    @csrf
                    <div class="about-us">
                        <div class="about-us__heading">Liên hệ với chúng tôi</div>
                        @if (session('msg'))
                            <div class="form-group" style="font-size: 15px; padding-bottom: 10px; color: #9ad717">
                                <div class="alert alert-success alert-dismissible" style="" id="thongbao">
                                    <h4><i class="icon fa fa-check"></i> Thông báo !</h4>
                                    {{ session('msg') }}
                                </div>
                            </div>
                        @endif
                        <div class="form__group">
                            <div>
                                <input type="text" value="{{ old('name') }}" name="name" placeholder="Họ và tên">
                                <span style=" color: #ff0000">
                                        {{$errors->first('name')}}
                                    </span>
                            </div>
                            <div>
                                <input type="email" value="{{ old('email') }}" name="email" placeholder="Email">
                                <span style=" color: #ff0000">
                                        {{$errors->first('email')}}
                                    </span>
                            </div>
                            <div>
                                <input type="text" value="{{ old('address') }}" name="address" placeholder="Địa chỉ">
                                <span style=" color: #ff0000">
                                        {{$errors->first('address')}}
                                    </span>
                            </div>
                            <div>
                                <input type="text" value="{{ old('phone') }}" name="phone" placeholder="Điện thoại">
                                <span style=" color: #ff0000">
                                        {{$errors->first('phone')}}
                                    </span>
                            </div>
                        </div>
                        <div>
                            <textarea name="content" id="" cols="30" rows="5" placeholder="Lời nhắn">{{ old('content') }}</textarea>
                            <span style=" color: #ff0000">
                                        {{$errors->first('content')}}
                                    </span>
                        </div>

                        <button class="btn btn--default">Gửi</button>

                    </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

