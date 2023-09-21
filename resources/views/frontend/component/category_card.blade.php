
@php
     $image = asset('/frontend/assets/imgs/shop/category-thumb-1.jpg');
    if($item->image) {
        $image = asset($item->image);
    }
@endphp
<div class="card-1">
    <figure class=" img-hover-scale overflow-hidden">
        <a href="shop-grid-right.html"><img src="{{$image}}" alt=""></a>
    </figure>
    <h5><a href="shop-grid-right.html">{{$item->name}}</a></h5>
</div>