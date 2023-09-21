
@foreach (\Cart::instance('frontend_order')->content() as $cart )
@php
// print_r(json_encode($cart->options->options));
    $image = URL::asset('assets/imgs/shop/product-1-2.jpg');
    if($cart->options->preview != null) {
                                    
        $image = $cart->options->preview;
    }
   
@endphp
<li>
    <div class="shopping-cart-img">
        <a href="shop-product-right.html"><img alt="Evara" src="{{$image}}"></a>
    </div>
    <div class="shopping-cart-title">
        <h4><a href="shop-product-right.html">{{$cart->name}}</a></h4>
        <h4><span>{{$cart->qty}} × </span>{{$cart->price}}</h4>
    </div>
    <div class="shopping-cart-delete">
        <a href="#"><i class="fi-rs-cross-small"></i></a>
    </div>
</li>
@endforeach