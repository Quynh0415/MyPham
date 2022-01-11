<!DOCTYPE html>
<html lang="en">

<head>

@section('head')
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
{{--        <base href="{{ asset('') }}">--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Beauty Mona</title>
        <!-- Font roboto -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <!-- Icon fontanwesome -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <!-- Reset css & grid sytem -->
        <link rel="stylesheet" href="{{asset('frontend/css/library.css')}}">
        <link href="{{asset('frontend/owlCarousel/assets/owl.carousel.min.css')}}" rel="stylesheet" />
        <!-- Layout -->
        <link rel="stylesheet" href="{{asset('frontend/css/common.css')}}">
        <!-- index -->

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Owl caroucel Js-->
        <script src="{{asset('frontend/owlCarousel/owl.carousel.min.js')}}"></script>
    <!--Bootstrap CDN-->
  @show
</head>

<body>
<section class="main">
    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.footer')

</section>
<!-- Modal Form -->
<div class="ModalForm">
    <div class="modal" id="my-Register">
        <a href="#" class="overlay-close"></a>
        <form action="{{ route('dangky') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="authen-modal register">
                @if (session('msg'))
                    <div class="form-group" style="font-size: 15px; padding-bottom: 10px; color: #9ad717">
                        <div class="alert alert-success alert-dismissible" style="" id="thongbao">
                            <h4><i class="icon fa fa-check"></i> Thông báo !</h4>
                            {{ session('msg') }}
                        </div>
                    </div>
                @endif
                <h3 class="authen-modal__title">Đăng Kí</h3>
                <div class="form-group">
                    <label for="name" class="form-label">Họ Tên</label>
                    <input id="name" name="name" type="text" class="form-control">
                        {{ old('name') }}
                    <span class="form-message">{{$errors->first('name')}}</span>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Tài khoản Email *</label>
                    <input id="email" name="email" type="email" class="form-control">
                    {{ old('email') }}
                    <span class="form-message">{{$errors->first('email')}}</span>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu *</label>
                    <input id="password" name="password" type="password" class="form-control">
                    {{ old('password') }}
                    <span class="form-message">{{$errors->first('password')}}</span>
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="password" class="form-label">Nhập lại mật khẩu *</label>--}}
{{--                    <input id="password" name="password" type="text" class="form-control">--}}

{{--                    <span class="form-message"></span>--}}
{{--                </div>--}}
                <div class="authen__btns">
                    <button class="btn btn--default">Đăng Kí</button>
                </div>
            </div>
        </form>
    </div>
    <div class=" modal" id="my-Login">
        <a href="#" class="overlay-close"></a>
        <div class="authen-modal login">
            @if (session('msg1'))
                <div class="form-group" style="font-size: 15px; padding-bottom: 10px; color: #9ad717">
                    <div class="alert alert-success alert-dismissible" style="" id="thongbao">
                        <h4><i class="icon fa fa-check"></i> Thông báo !</h4>
                        {{ session('msg1') }}
                    </div>
                </div>
            @endif
            <form role="form" action="{{ route('dangnhap') }}" method="POST">
            @csrf
            <h3 class="authen-modal__title">Đăng Nhập</h3>
            <div class="form-group">
                <label for="email" class="form-label">Địa chỉ email *</label>
                <input id="email" name="email" type="email" class="form-control">
                <span class="form-message">{{ $errors->first('email') }}</span>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu *</label>
                <input id="password" name="password" type="password" class="form-control">
                <span class="form-message">{{ $errors->first('password') }}</span>
            </div>

{{--            <div class="authen__btns">--}}
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn--default">Đăng Nhập</button>

                    </div>
                    <div class="col-md-6">
                        <input type="checkbox" class="authen-checkbox">
                        <label class="form-label">Ghi nhớ mật khẩu</label>
                    </div>
                </div>
                {{--            </div>--}}
                {{--            <a class="authen__link">Quên mật khẩu ?</a>--}}
            </form>
        </div>
    </div>
    <div class="up-top" id="upTop" onclick="goToTop()">
        <i class="fas fa-chevron-up"></i>
    </div>
</div>
<script src="{{asset('frontend/js/homeScript.js')}}"></script>
<script src="{{asset('frontend/js/commonscript.js')}}"></script>
<script src="{{asset('/frontend/js/sweetalert.min.js')}}"></script>
<script src="{{asset('/frontend/js/toastr.js')}}"></script>
<script>
    $('.owl-carousel.hight').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
    $('.owl-carousel.news').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 2
            }
        }
    })
    $('.owl-carousel.bands').owlCarousel({
        loop: true,
        margin: 20,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 6
            }
        }
    })
</script>
<script>
    $(document).ready(function() {
        var sync1 = $("#sync1 ");
        var sync2 = $("#sync2 ");
        var slidesPerPage = 4;
        var syncedSecondary = true;
        sync1.owlCarousel({
            items: 1,
            loop: true,
            margin: 20,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true
        })
        sync2
            .on('initialized.owl.carousel', function() {
                sync2.find(".owl-item ").eq(0).addClass("current ");
            })
            .owlCarousel({
                items: 4,
                dots: false,
                nav: false,
                margin: 30,
                smartSpeed: 200,
                slideSpeed: 500,
                slideBy: 4,
                responsiveRefreshRate: 100
            }).on('changed.owl.carousel', syncPosition2);

        function syncPosition(el) {
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);

            if (current < 0) {
                current = count;
            }
            if (current > count)  {
                current = 0;
            }

            //end block

            sync2
                .find(".owl-item ")
                .removeClass("current ")
                .eq(current)
                .addClass("current ");
            var onscreen = sync2.find('.owl-item.active').length - 1;
            var start = sync2.find('.owl-item.active').first().index();
            var end = sync2.find('.owl-item.active').last().index();

            if (current > end) {
                sync2.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                sync2.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                sync1.data('owl.carousel').to(number, 100, true);
            }
        }

        sync2.on("click ", ".owl-item ", function(e) {
            e.preventDefault();
            var number = $(this).index();
            sync1.data('owl.carousel').to(number, 300, true);
        });
    });

    $('.owl-carousel.hight').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 6
            }
        }
    })
</script>
@yield('my-script')
<!-- Script common -->

</body>
