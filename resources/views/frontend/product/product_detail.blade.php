@extends('frontend.layouts.main')
@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="frontend/css/product.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/bootstrap.min.css">
@endsection
@section('content')
    <div class="main">
        <div class="grid wide">
            <div class="productInfo">
                <div class="row">
                    <div class="col l-5 m-12 s-12">
                        <div class="owl-carousel owl-theme" id="sync1">
                            <a href="#" class="product">
                                <div class="product__avt" style="background-image: url({{ asset($product->image) }})">
                                </div>
                            </a>
                            @foreach($product->products_image as $item)
                                <a href="#" class="product">
                                    <div class="product__avt" style="background-image: url({{$item->image}})">

                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="owl-carousel owl-theme" id="sync2">
                            <a href="#" class="product">

                                <div class="product__avt" style="background-image: url({{$product->image}})">

                                </div>
                            </a>
                            @foreach($product->products_image as $item)
                                <a href="#" class="product">
                                    <div class="product__avt" style="background-image: url({{$item->image}})">

                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col l-7 m-12s s-12 pl">
                        <div class="main__breadcrumb">
                            <div class="breadcrumb__item">
                                <a href="/" class="breadcrumb__link">Trang chủ</a>
                            </div>
                            <div class="breadcrumb__item">
                                <a href="{{ route('sanpham') }}" class="breadcrumb__link">Sản Phẩm</a>
                            </div>
                            <div class="breadcrumb__item">
                                <a href="" class="breadcrumb__link">{{ $product->brands->name }}</a>
                            </div>
                        </div>
                        <h3 class="productInfo__name">
                            {{$product->name}}
                        </h3>
                        <div class="productInfo__price">
                            @php
                                $first_detail = $product->products_detail[0];
                            @endphp
                            <span>{{$first_detail->price - ($first_detail->price*$first_detail->sale*0.01)}} <span
                                    class="priceInfo__unit">đ</span></span>
                            @if($first_detail->sale>0)
                                <span style="color: black; font-size: 16px"><del>{{$first_detail->price}}đ</del></span>
                            @endif
                        </div>

                        <div class="productInfo__description">
                            {!!$product->content!!}
                        </div>

                       <div data-toggle="buttons">
                           <style>
                               .border{
                                   border: 1px solid black;
                               }
                           </style>
                           <form action="{{route('themsanpham')}}" method="post">
                               @csrf
                               <input type="hidden" id="" name="id" value="{{ $product->id }}">
                           @foreach($product->products_detail as $item)
                            <label class="btn active border">
                                @if($item->size == '')
                                    <input type="radio" name="options" id="option1" required value="{{ $item->id }}"> {{ $item->color }}
                                @else
                                    <input type="radio" name="options" id="option1" required value="{{ $item->id }}"> {{ $item->size }}
                                @endif
                            </label>
                           @endforeach
                        </div>

                        <div class="productInfo__addToCart">
                            <div class="buttons_added">
                                <input class="minus is-form" type="button" value="-" onclick="minusProduct()">
                                <input aria-label="quantity" class="input-qty" max="10" min="1" name="qty" type="number"
                                       value="1">
                                <input class="plus is-form" type="button" value="+" onclick="plusProduct()">
                            </div>
                            <button class="btn btn--default orange " type="submit">Thêm vào giỏ</button>
                        </div>
                        </form>
                        <div class="productIndfo__category ">
                            <p class="productIndfo__category-text"> Danh mục : {{ $product->categories->name }}</p>
                            <p class="productIndfo__category-text"> Hãng : {{ $product->brands->name }}</p>
{{--                            <p class="productIndfo__category-text"> Tình trạng: </p>--}}
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
{{--                            <div class="tab-item ">--}}
{{--                                Đánh giá--}}
{{--                            </div>--}}
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
{{--                            <div class="tab-pane ">--}}
{{--                                <div class="productDes__ratting ">--}}
{{--                                    <div class="productDes__ratting-title ">Đánh giá của bạn</div>--}}
{{--                                    <div class="productDes__ratting-wrap">--}}
{{--                                        <div id="rating">--}}
{{--                                            <input type="radio" id="star5" name="rating" value="5"/>--}}
{{--                                            <label class="full" for="star5" title="Awesome - 5 stars"></label>--}}

{{--                                            <input type="radio" id="star4half" name="rating" value="4 and a half"/>--}}
{{--                                            <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>--}}

{{--                                            <input type="radio" id="star4" name="rating" value="4"/>--}}
{{--                                            <label class="full" for="star4" title="Pretty good - 4 stars"></label>--}}

{{--                                            <input type="radio" id="star3half" name="rating" value="3 and a half"/>--}}
{{--                                            <label class="half" for="star3half" title="Meh - 3.5 stars"></label>--}}

{{--                                            <input type="radio" id="star3" name="rating" value="3"/>--}}
{{--                                            <label class="full" for="star3" title="Meh - 3 stars"></label>--}}

{{--                                            <input type="radio" id="star2half" name="rating" value="2 and a half"/>--}}
{{--                                            <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>--}}

{{--                                            <input type="radio" id="star2" name="rating" value="2"/>--}}
{{--                                            <label class="full" for="star2" title="Kinda bad - 2 stars"></label>--}}

{{--                                            <input type="radio" id="star1half" name="rating" value="1 and a half"/>--}}
{{--                                            <label class="half" for="star1half" title="Meh - 1.5 stars"></label>--}}

{{--                                            <input type="radio" id="star1" name="rating" value="1"/>--}}
{{--                                            <label class="full" for="star1" title="Sucks big time - 1 star"></label>--}}

{{--                                            <input type="radio" id="starhalf" name="rating" value="half"/>--}}
{{--                                            <label class="half" for="starhalf"--}}
{{--                                                   title="Sucks big time - 0.5 stars"></label>--}}
{{--                                        </div>--}}
{{--                                        <textarea class="ratecomment" name=" " id=" " cols="30 " rows="1"--}}
{{--                                                  placeholder="Vui lòng viết đánh giá của bạn "></textarea>--}}
{{--                                    </div>--}}
{{--                                    <input type="submit " class="btn btn--default" value="Đánh giá">--}}
{{--                                </div>--}}
{{--                                <ul class="rate__list">--}}
{{--                                    <li class="rate__item">--}}
{{--                                        <div class="rate__info">--}}
{{--                                            <img--}}
{{--                                                src="https://lh3.googleusercontent.com/ogw/ADGmqu9PFgn_rHIm9i3eIlVr5RwzwY2w8EystHF213wj=s32-c-mo"--}}
{{--                                                alt="">--}}
{{--                                            <h3 class="rate__user">Giang Tuấn Phương</h3>--}}
{{--                                            <div class="rate__star">--}}
{{--                                                <div class="group-star">--}}
{{--                                                    <i class="fas fa-star"></i>--}}
{{--                                                    <i class="fas fa-star"></i>--}}
{{--                                                    <i class="fas fa-star"></i>--}}
{{--                                                    <i class="fas fa-star-half-alt"></i>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="rate__comment">Sản phẩm chất lượng rất tốt thật tuyệt vời</div>--}}
{{--                                    </li>--}}
{{--                                    <li class="rate__item">--}}
{{--                                        <div class="rate__info">--}}
{{--                                            <img--}}
{{--                                                src="https://lh3.googleusercontent.com/ogw/ADGmqu9PFgn_rHIm9i3eIlVr5RwzwY2w8EystHF213wj=s32-c-mo"--}}
{{--                                                alt="">--}}
{{--                                            <h3 class="rate__user">Giang Tuấn Phương</h3>--}}
{{--                                            <div class="rate__star">--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="rate__comment">Sản phẩm chất lượng rất tốt</div>--}}
{{--                                    </li>--}}
{{--                                    <li class="rate__item">--}}
{{--                                        <div class="rate__info">--}}
{{--                                            <img--}}
{{--                                                src="https://lh3.googleusercontent.com/ogw/ADGmqu9PFgn_rHIm9i3eIlVr5RwzwY2w8EystHF213wj=s32-c-mo"--}}
{{--                                                alt="">--}}
{{--                                            <h3 class="rate__user">Giang Tuấn Phương</h3>--}}
{{--                                            <div class="rate__star">--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="rate__comment">Sản phẩm chất lượng rất tốt</div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="main__frame ">
                <div class="grid wide ">
                    <h3 class="category__heading ">Sản Phẩm Tương tự</h3>

                    <div class="owl-carousel hight owl-theme ">
                        @foreach($sameProduct as $item)
                            <div class="product">
                                <div class="product__avt " style="background-image: url({{ asset($item->image) }})">
                                </div>
                                <div class="product__info">
                                    <h3 class="product__name">{{$item->name}}</h3>
                                    @php
                                        $first_detail = $item->products_detail()->first();
                                    @endphp
                                    @if($first_detail->sale <= 0)
                                        <div class="product__price">
                                            {{ $first_detail->price }}đ
                                        </div>
                                    @else
                                        <div class="product__price">
                                            <div class="price__old">
                                                {{ $first_detail->price }}đ
                                            </div>
                                            <div
                                                class="price__new">{{$first_detail->price - ($first_detail->price * $first_detail->sale * 0.01)}}
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
                                <a href="{{ route('chitietsanpham', $item['slug']) }}" class="viewDetail">Xem chi
                                    tiết</a>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection
