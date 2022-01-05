<div class="header scrolling" id="myHeader">
    <div class="grid wide">
        <div class="header__top">
            <div class="navbar-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <a href="index.html" class="header__logo">
                <img src="/frontend/logo.png" alt="">
            </a>
            <div class="header__search">
                <form action="{{ route('timkiem') }}" method="GET" class="search-form">
                    <div class="header__search-wrap">
                        <input type="text" name="tu-khoa" value="{{ isset($keyword) ? $keyword : '' }}"
                               class="header__search-input" placeholder="Tìm kiếm">
                        <a class="header__search-icon">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                </form>
            </div>
            @if(Auth::check())
                <div class="header__account">
                    <a href="{{ route('thongtin') }}" class="header__account-login">{{ Auth::user()->name }}</a>
                    <a href="{{ route('dangxuat') }}" class="header__account-login">Logout</a>
                </div>
            @else
                <div class="header__account">
                    <a href="#my-Login" class="header__account-login">Đăng Nhập</a>
                    <a href="#my-Register" class="header__account-register">Đăng Kí</a>
                </div>
        @endif
        <!-- Cart -->
            <div class="header__cart have" href="#">
                <i class="fas fa-shopping-basket"></i>
                <div class="header__cart-amount">
                    {{ Cart::count() }}
                </div>
                <div class="header__cart-wrap">
                    <ul class="order__list">
                        @foreach(Cart::content() as $item)
{{--                            {{dd($item)}}--}}
                            <li class="item-order">
                                <div class="order-wrap">
                                    <a href="{{ $item->options['url'] }}" class="order-img">
                                        <img src="{{ $item->options['image'] }}" alt="">
                                    </a>
                                    <div class="order-main">
                                        <a href="{{ $item->options['url'] }}" class="order-main-name">{{ $item->name }}</a>
                                        <div class="order-main-price">
                                            {{ $item->qty }} x
{{--                                            @if($item->options['sale'] <= 0)--}}
                                                {{ number_format($item->price, 0,",",".") }} đ
{{--                                            @else--}}
{{--                                                {{number_format($item->price - ($item->price * $item->options['sale'] * 0.01), 0,",",".")}}--}}
{{--                                                đ--}}
{{--                                            @endif--}}
                                        </div>
                                    </div>
                                    <a href="{{route('xoasanpham',[$item->rowId])}}" class="order-close"><i
                                            class="far fa-times-circle"></i></a>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                    <div class="total-money"></div>
                    @if( Cart::count() == 0)
                        <div class="order-main-name">
                            Bạn chưa có sản phẩm nào.
                        </div>
                        <br>
                        <div class="order-main-name">
                            Hãy thêm sản phẩm để đặt hàng.
                        </div>
                    @else
                        <a href="{{ route('giohang') }}" class="btn btn--default cart-btn">Xem giỏ hàng</a>
                        <a href="{{ route('thanhtoan') }}" class="btn btn--default cart-btn orange">Thanh toán</a>
                @endif
                <!-- norcart -->
                    <!-- <img class="header__cart-img-nocart" src="http://www.giaybinhduong.com/images/empty-cart.png" alt=""> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Menu -->
    <div class="header__nav">
        <ul class="header__nav-list">
            <li class="header__nav-item index">
                <a href="/" class="header__nav-link">Trang chủ</a>
            </li>

            <li class="header__nav-item">
                <a href="{{ route('sanpham') }}" class="header__nav-link">Sản Phẩm</a>
                <div class="sub-nav-wrap grid wide" style="width: 45%;">
                    @include('frontend.category.category')
                </div>
            </li>
            <li class="header__nav-item">
                <a href="{{ route('tintuc') }}" class="header__nav-link">Tin Tức</a>
            </li>
            <li class="header__nav-item">
                <a href="{{ route('lienhe') }}" class="header__nav-link">Liên Hệ</a>
            </li>
        </ul>
    </div>
</div>

