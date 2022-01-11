<div class="sub-nav__item">
    <div href="" class="sub-nav__link heading">{{ $category->name }}</div>
</div>
@if (count($category->childs) > 0)
    @foreach ($category->childs as $sub)
        <li class="sub-nav__item">
            <a href="{{route('sanphamtheodanhmuc',$sub['slug'])}}" class="sub-nav__link">{{ $sub->name }}</a>
        </li>
    @endforeach
@endif
