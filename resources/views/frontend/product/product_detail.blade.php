@extends('frontend.layouts.main')
@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/product.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.min.css')}}">
@endsection
@section('content')
    <div class="main">
        <div class="grid wide">
            <div class="productInfo">
                <div class="row">
                    <div class="col l-5 m-12 s-12">
                        <div class="owl-carousel owl-theme" id="sync1">
                            <a class="product">
                                <div class="product__avt" style="background-image: url({{ asset($product->image) }})">
                                </div>
                            </a>
                            @foreach($product->products_image as $item)
                                <a class="product">
                                    <div class="product__avt" style="background-image: url({{asset($item->image)}})">

                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="owl-carousel owl-theme" id="sync2">
                            <a class="product">

                                <div class="product__avt" style="background-image: url({{asset($product->image)}})">

                                </div>
                            </a>
                            @foreach($product->products_image as $item)
                                <a class="product">
                                    <div class="product__avt" style="background-image: url({{asset($item->image)}})">

                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col l-7 m-12s s-12 pl testNum">
                        <div class="main__breadcrumb">
                            <div class="breadcrumb__item">
                                <a href="/" class="breadcrumb__link">Trang chủ</a>
                            </div>
                            <div class="breadcrumb__item">
                                <a href="{{ route('sanpham') }}" class="breadcrumb__link">Sản Phẩm</a>
                            </div>
                            <div class="breadcrumb__item">
                                <a href="{{ route('sanphamtheohang',$product->brands['slug']) }}" class="breadcrumb__link">{{ $product->brands->name }}</a>
                            </div>
                        </div>
                        <h3 class="productInfo__name">
                            {{$product->name}}
                        </h3>
                        <div class="productInfo__price">
                            @php
                                $first_detail = $product->products_detail[0];
                            @endphp
                            <span>{{number_format($first_detail->price - ($first_detail->price * $first_detail->sale * 0.01), 0,",",".")}} <span
                                    class="priceInfo__unit">đ</span></span>
                            @if($first_detail->sale>0 || $first_detail->sale = '' )
                                <span style="color: black; font-size: 16px"><del>{{number_format($first_detail->price, 0,",",".")}}đ</del></span>
                            @endif
                        </div>

                        <div class="productInfo__description">
                            {!!$product->content!!}
                        </div>
                        <div data-toggle="buttons">
                            <style>
                                .border {
                                    border: 1px solid black;
                                }
                            </style>
                            <form action="{{route('themsanpham')}}" method="post">
                                @csrf
                                <input type="hidden" id="" name="id" value="{{ $product->id }}">
                                @foreach($product->products_detail as $item)
                                    <label class="btn active border">
                                        @if($item->size == '')
                                            <input data-num="{{$item->stock}}" type="radio" name="options" class="forNum" required
                                                   value="{{ $item->id }}"> {{ $item->color }}
                                        @else
                                            <input data-num="{{$item->stock}}" type="radio" name="options" class="forNum"  required
                                                   value="{{ $item->id }}"> {{ $item->size }}
                                        @endif
                                    </label>
                                @endforeach
                        </div>

                        <div class="productInfo__addToCart">
                            <div class="buttons_added">
                                <input class="minus is-form" type="button" value="-" onclick="minusProduct()">
                                <input aria-label="quantity" class="input-qty"  min="1" name="qty"
                                       type="number"
                                       value="1" id="numProduct" max="20">
                                <input class="plus is-form" type="button" value="+" onclick="plusProduct()">
                            </div>
                            <button class="btn btn--default orange " type="submit">Thêm vào giỏ</button>
                        </div>
                        <br>
                        </form>

                        @if(session('success'))
                            <div class="alert alert-success mt-10" role="alert">
                                {{session('success')}}
                            </div>
                        @endif

                        @if(session('warning'))
                            <div class="alert alert-warning mt-10" role="alert">
                                {{session('warning')}}
                            </div>
                        @endif
                        <div class="productIndfo__category ">
                            <p class="productIndfo__category-text"> Danh mục : {{ $product->categories->name }}</p>
                            <p class="productIndfo__category-text"> Hãng : {{ $product->brands->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="productDetail ">
                <div class="main__tabnine ">
                    <div class="grid wide ">
                        <!-- Tab items -->
                        <div class="tabs ">
                            <div class="tab-item active ">
                                Mô tả
                            </div>
                            <div class="line "></div>
                        </div>
                        <!-- Tab content -->
                        <div class="tab-content ">
                            <div class="tab-pane active ">
                                <div class="productDes ">
                                    <p class="productDes__text ">
                                        <b>{{ $product->name }}</b> {!! $product->description !!}
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="main__frame ">
                <div class="grid wide ">
                    <h3 class="category__heading ">Sản Phẩm Tương tự</h3>

                    <div class="owl-carousel hight owl-theme ">
                        @foreach($sameProducts as $product)
                            <div class="product">
                                <div class="product__avt " style="background-image: url({{ asset($product->image) }})">
                                </div>
                                <div class="product__info">
                                    <h3 class="product__name">{{$product->name}}</h3>
                                    @php
                                        $first_detail = $product->products_detail()->first();
                                    @endphp
                                    @if($first_detail->sale <= 0)
                                        <div class="product__price">
                                            {{ number_format($first_detail->price, 0,",",".") }}đ
                                        </div>
                                    @else
                                        <div class="product__price">
                                            <div class="price__old">
                                                {{ number_format($first_detail->price, 0,",",".") }}đ
                                            </div>
                                            <div
                                                class="price__new">{{number_format($first_detail->price - ($first_detail->price * $first_detail->sale * 0.01), 0,",",".")}}
                                                <span class="price__unit">đ</span></div>
                                        </div>
                                    @endif
                                    @if($first_detail->sale <= 0)
                                    @else
                                        <div class="product__sale">
                                            <span class="product__sale-text">Giảm</span>
                                            <span class="product__sale-percent">{{ $first_detail->sale }}%</span>

                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('chitietsanpham', $product['slug']) }}" class="viewDetail">Xem chi
                                    tiết</a>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('my-script')
        <script type="text/javascript">
            var maxProduct =10;
            $(function () {
                // xóa sản phẩm khỏi giỏ hàng
                $(document).on("click", '.forNum', function () {
                    var max= $(this).attr('data-num');
                    $(this).closest('.testNum').find('#numProduct').attr({
                        "max" : max
                    });
                    // mm=$(this).closest('.testNum').find('#numProduct').attr('max');
                    // console.log(mm);
                    maxProduct = document.querySelector('.input-qty').getAttribute('max');
                });

            });
            var value = parseInt(document.querySelector('.input-qty').value, 10);

            function minusProduct() {
                if (value > 1) {
                    value = isNaN(value) ? 1 : value;
                    value--;
                }

                document.querySelector('.input-qty').value = value;
            }

            function plusProduct() {
                value = isNaN(value) ? 0 : value;
                value++;
                if (value > maxProduct) {
                    value = maxProduct;
                    alert('Số sản phẩm trong kho của shop đã đạt  giới hạn')
                }
                document.querySelector('.input-qty').value = value;
            }
        </script>
@endsection
