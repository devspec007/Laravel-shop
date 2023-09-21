
@php
     $image = asset('frontend/assets/imgs/banner/brand-1.png');
    if($item->image) {
        $image = asset($item->image);
    }
@endphp
{{-- <div class="brand-logo">
    <img class="img-grey-hover" src="{{$image}}" alt="{{$item->name}}">
</div> --}}

<div class="card-1">
    <figure class=" img-hover-scale overflow-hidden">
        <a href="shop-grid-right.html"><img src="{{$image}}" alt="{{$item->name}}"></a>
    </figure>
</div>