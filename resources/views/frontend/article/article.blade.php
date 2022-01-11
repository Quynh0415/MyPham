
@extends('frontend.layouts.main')
@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/new.css')}}">
@endsection
@section('content')
    <div class="grid wide">
        <div class="main__taskbar">
            <div class="main__breadcrumb">
                <div class="breadcrumb__item">
                    <a href="/" class="breadcrumb__link">Trang chủ</a>
                </div>
                <div class="breadcrumb__item">
                    <a href="{{ route('tintuc') }}" class="breadcrumb__link">Danh sách tin tức</a>
                </div>
            </div>
        </div>

        <div class="list-new">
            @foreach($article as $item)
            <div href="#" class="new-item">
                <a href="#" class="new-item__img">
                    <img src="{{ asset($item->image) }}" alt="">
                </a>
                <div class="new-item__body">
                    <a href="#" class="new-item__title">
                       {{ $item->title }}
                    </a>
                    <p class="fas fa-calendar-alt">{{date('d/m/Y',strtotime($item->created_at)) }}</p>
                    <p class="new-item__description">{{ $item->content }}</p>
                    <a href="{{ route('chitiettintuc',$item['slug']) }}" class="btn btn--default">Xem thêm</a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
@endsection
