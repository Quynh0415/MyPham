
<div class="header scrolling" id="myHeader">
    <div class="grid wide">
        <div class="header__top">
            <div class="navbar-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <a href="index.html" class="header__logo">
                <img src="{{ $setting->image }}" alt="">
            </a>
            <div class="header__search">
                <div class="header__search-wrap">
                    <input type="text" class="header__search-input" placeholder="Tìm kiếm">
                    <a class="header__search-icon" href="#">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            </div>
            <div class="header__account">
                <a href="#my-Login" class="header__account-login">Đăng Nhập</a>
                <a href="#my-Register" class="header__account-register">Đăng Kí</a>
            </div>
            <!-- Cart -->
            <div class="header__cart have" href="#">
                <i class="fas fa-shopping-basket"></i>
                <div class="header__cart-amount">
                    {{ Cart::count() }}
                </div>
                <div class="header__cart-wrap">
                    <ul class="order__list">
                        @foreach(Cart::content() as $item)
                            <li class="item-order">
                                <div class="order-wrap">
                                    <a href="{{ $item->options['url'] }}" class="order-img">
                                        <img src="{{ $item->options['image'] }}" alt="">
                                    </a>
                                    <div class="order-main">
                                        <a href="" class="order-main-name">{{ $item->name }}</a>
                                        <div class="order-main-price">{{ $item->qty }} x {{ $item->price }}</div>
                                    </div>
                                    <a href="{{route('xoasanpham',[$item->rowId])}}" class="order-close"><i class="far fa-times-circle"></i></a>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                    <div class="total-money"></div>
                    <a href="{{ route('giohang') }}" class="btn btn--default cart-btn">Xem giỏ hàng</a>
                    <a href="{{ route('thanhtoan') }}" class="btn btn--default cart-btn orange">Thanh toán</a>
                    <!-- norcart -->
                    <!-- <img class="header__cart-img-nocart" src="http://www.giaybinhduong.com/images/empty-cart.png" alt=""> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Menu -->
    <div class="header__nav">
        <ul class="header__nav-list">
            <li class="header__nav-item nav__search">
                <div class="nav__search-wrap">
                    <input class="nav__search-input" type="text" name="" id="" placeholder="Tìm sản phẩm...">
                </div>
                <div class="nav__search-btn">
                    <i class="fas fa-search"></i>
                </div>
            </li>
            <li class="header__nav-item authen-form">
                <a href="#" class="header__nav-link">Tài Khoản</a>
                <ul class="sub-nav">
                    <li class="sub-nav__item">
                        <a href="#my-Login" class="sub-nav__link">Đăng Nhập</a>
                    </li>
                    <li class="sub-nav__item">
                        <a href="#my-Register" class="sub-nav__link">Đăng Kí</a>
                    </li>
                </ul>
            </li>
            <li class="header__nav-item index">
                <a href="/" class="header__nav-link">Trang chủ</a>
            </li>
            <li class="header__nav-item">
                <a href="#" class="header__nav-link">Giới Thiệu</a>
            </li>
            <li class="header__nav-item">
                <a href="{{ route('sanpham') }}" class="header__nav-link">Sản Phẩm</a>
                <div class="sub-nav-wrap grid wide" style="width: 50%;">
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

