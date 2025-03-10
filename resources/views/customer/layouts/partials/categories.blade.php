
<section class="sidebar-nav-item">
    @foreach($categories as $category)
    <span class="sidebar-nav-item-title">
        <a href="{{route('customer.products',[$category->id,'search'=>request()->search,'sort'=>5,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands])}}" class="d-inline">{{$category->name}}</a>
        @if($category->categories->count() > 0)
            <i class="fa fa-angle-left"></i>
        @endif
    </span>
        @include('customer.layouts.partials.sub-categories',['categories'=>$category->categories])
    @endforeach

</section>
