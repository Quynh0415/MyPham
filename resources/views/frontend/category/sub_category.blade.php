<li class="sub-nav__item">
    <a href="" class="sub-nav__link heading">{{ $category->name }}</a>
</li>
@if (count($category->childs) > 0)
    @foreach ($category->childs as $sub)
        <li class="sub-nav__item">
            <a href="{{route('sanphamtheodanhmuc',$category['slug'])}}" class="sub-nav__link">{{ $sub->name }}</a>
        </li>
    @endforeach
@endif
