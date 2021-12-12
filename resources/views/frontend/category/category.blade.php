@foreach ($categories as $category)
    <ul class="sub-nav">
        @include('frontend.category.sub_category',['category'=>$category])
    </ul>
@endforeach
