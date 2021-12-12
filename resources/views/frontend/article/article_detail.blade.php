@extends('frontend.layouts.main')
@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="frontend/css/new.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/product.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

@endsection
@section('content')
    <div class="grid wide">
        <div class="productInfo">
            <div>
                <h1 class="category__heading"> Tin tức </h1>
            </div>
            <div class="row">
                <div class="col-md-9 box-left">
                    <div class="news__body">
                        <div class="main__breadcrumb">
                            <h2 class="news__body-title"
                                style="font-size: 30px; color: #0b93d5">{{ $article->title }}</h2>
                        </div>
                        <div class="new__body-date">{{date('d/m/Y',strtotime($article->created_at)) }}</div>
                        <span class="news__description" style="font-size: 20px; font-family: 'Times New Roman'">
                            {!! $article->description !!}
                        </span>
                    </div>
                </div>

                <div class="col-md-3 box-right">
                    <h2 style="font-size: 25px; color: #0b93d5">Bài viết liên quan</h2>
                    <br>
                    @foreach($sameArticles as $article)
                        <div class="news__body row">
                            <div class="col-md-3">
                                <img style="width: 100%; height: 100%" src="{{ asset($article->image) }}" alt="">
                            </div>
                            <div class="col-md-9">
                                <div class="new__body-date">{{date('d/m/Y',strtotime($article->created_at)) }}</div>
                                <a href="{{ route('chitiettintuc',$article['slug']) }}" class="news">
                                    <h3 style="color: #7a43b6" class="news__body-title">{{ $article->title }}</h3>
                                </a>
                            </div>
{{--                            <p class="news__description" style="font-size: 15px; font-family: 'Times New Roman'">--}}
{{--                                {{ $article->content }}--}}
{{--                            </p>--}}
                        </div>
                        <br>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
