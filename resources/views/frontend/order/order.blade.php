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
                @if(count(Cart::content()))
                <div class="row">
                    <div class="col l-8 m-12 s-12">
                        <div class="main__cart">
                            <div class="row title">
                                <div class="col l-5 m-5 s-8">Sản phẩm</div>
                                <div class="col l-2 m-2 s-2">Loại</div>
                                <div class="col l-2 m-2 s-2">Giá</div>
                                <div class="col l-2 m-2 s-0">Số lượng</div>
                                <div class="col l-1 m-1 s-0">Xóa</div>
                            </div>
                            @foreach(Cart::content() as $item)
                                <div class="row item">
                                    <div class="col l-5 m-5 s-8">
                                        <div class="main__cart-product">
                                            <img src="{{ $item->options['image'] }}" alt="">
                                            <div class="name">{{ $item->name }}</div>
                                        </div>
                                    </div>
                                    <div class="col l-2 m-2 s-2">
{{--                                        @if($item->options['size'] == '')--}}
                                            <div class="name" style="font-size: 15px">
                                            {{ $item->options['color_size']}}
                                            </div>
{{--                                        @else--}}
{{--                                            <div class="name" style="font-size: 15px">--}}
{{--                                            {{ $item->options['size']}}--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
                                    </div>
                                    <div class="col l-2 m-2 s-2">
                                            <div id="{{$item->rowId}}" class="main__cart-price">{{ number_format($item->price, 0,",",".") }}
                                                ₫
                                            </div>
                                    </div>
                                    <div class="col l-2 m-2 s-0 quantity">
                                        <div class="buttons_added ">
                                            <input class="minus is-form" type="button" value="-"
                                                   onclick="minusProduct(this)">
{{--                                            {{dd($item)}}--}}
                                            <input data-num="{{$item->rowId}}" aria-label="quantity" class="input-qty item-qty" max="{{$item->options['max']}}" min="1" name="qty"
                                                   type="number" value="{{ $item->qty }}">
                                            <input data-num="{{$item->options['max']}}" class="plus is-form checkPlus" type="button" value="+" onclick="plusProduct(this)">

                                        </div>
                                        <br>
                                        <span class="form-message"></span>
                                        <a data-id="{{ $item->rowId }}" href="javascript:void(0)" class="update-qty">Cập nhật</a>

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
                                    Giao hàng:
                                </div>
                                <div class="main__pay-text">
                                    Giao hàng miễn phí.
                                </div>

                            </div>
                            <div class="pay-info">
                                <div class="main__pay-text">
                                    Tổng thành tiền:
                                </div>
                                <div class="main__pay-price">
                                    {{ Cart::subtotal(0,",",".")}} ₫
                                </div>
                            </div>
                            <a href="{{ route('thanhtoan') }}" class="btn btn--default orange">Tiến hành thanh toán</a>
                        </div>
                    </div>
                </div>
                @else
                    <style>
                        .buyother {
                            display: block;
                            overflow: hidden;
                            background: #fff;
                            line-height: 40px;
                            text-align: center;
                            margin: 15px auto;
                            width: 300px;
                            font-size: 14px;
                            color: #5c2699;
                            font-weight: 700;
                            text-transform: uppercase;
                            border: 2px solid #5c2699;
                            border-radius: 5px;
                        }
                    </style><br>
                    <div class="content">
                        <h3 class="text-center" style="font-size: 25px; color: #5c2699">Bạn chưa có sản phẩm nào trong giỏ hàng</h3>
                    </div>
                    <a href="/" class="buyother"><i class="fa fa-chevron-left"></i> Về trang chủ</a>
                @endif
            </div>
        </div>
        <script type="text/javascript">
            var maxProduct =5;

            $(function () {
                // cập nhật số lượng của từng sản phẩm trong giỏ hàng
                $(document).on("click", '.update-qty', function (e) {
                    var rowId = $(this).attr('data-id');
                    var qty = $(this).closest('.quantity').find('.item-qty').val(); // lấy số lượng của ô input

                    // Kiểm tra Nếu không phải là số nguyên Hoặc số lượng < 1
                    if (isNaN(qty) || qty < 1) {
                        alert("Số lượng là số nguyên lớn hơn >= 1");
                        $(this).closest('.quantity').find('.item-qty').val(1);
                        return false;
                    }

                    $.ajax({
                        url: '/gio-hang/cap-nhat-so-luong-sp',
                        type: 'get',
                        data: {
                            rowId: rowId,
                            qty: qty
                        }, // dữ liệu truyền sang nếu có
                        dataType: "HTML", // kiểu dữ liệu trả về
                        success: function (response) {
                            data = JSON.parse(response);
                            $('.main__pay-price').text(data.totalPrice+" đ")

                        },
                        error: function (data) { // lỗi nếu có
                            // console.log(data.responseJSON)
                            alert('Số sản phẩm trong kho của shop đã đạt  giới hạn');
                        }
                    });
                });


            })

            var value = 5

            function minusProduct(d) {
                value = parseInt(d.nextElementSibling.getAttribute("value"), 10);
                if (value > 1) {
                    value = isNaN(value) ? 1 : value;
                    value--;
                }

                d.nextElementSibling.setAttribute('value',value)
            }

            function plusProduct(d) {
                maxProduct= d.getAttribute("data-num");
                value = parseInt(d.previousElementSibling.getAttribute("value"), 10);
                // maxProduct = this.getAttribute('max');

                value = isNaN(value) ? 0 : value;
                value++;
                if (value > maxProduct) {
                    value = maxProduct;
                    alert('Số sản phẩm trong kho của shop đã đạt  giới hạn')
                }
                // previousElementSibling
                d.previousElementSibling.setAttribute('value',value)
            }
        </script>
@endsection
