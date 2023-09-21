
@foreach (\Cart::instance('pos_order')->content() as $cart)
    @php
        $options = $cart->options;
        $image = URL::asset('/assets/img/product/product34.jpg');
        if($options->preview != null) {
      
            $image = $options->preview;
        }
        $mrp  = $options->mrp ?? $cart->price+1;
    @endphp
<ul class="product-lists" @if($mrp < $cart->price)style="border:2px solid red;" @endif>
 
    <li>
        <div class="productimg">
            <div class="productimgs">
                <img src="{{ $image}}" alt="img">
            </div>
            <div class="productcontet">
                <h4>{{$cart->name}} 
                <a href="javascript:void(0);" class="ms-2" data-bs-toggle="modal" data-bs-target="#edit"><img src="{{  URL::asset('/assets/img/icons/edit-5.svg')}}" alt="img"></a>
                </h4>
                <div class="productlinkset">
                    <h5>{{$options->sku}}</h5>
                </div> 
                <div class="increment-decrement">
                    <div class="input-groups">
                        <input type="button" value="-"  class="button-minus dec button" data-id="{{$cart->rowId}}">
                        <input type="text" name="child"  value="{{$cart->qty}}" class="quantity-field">
                        <input type="button" value="+"  class="button-plus inc button "data-id="{{$cart->rowId}}">
                    </div>
                </div>
                <input type="text" class="form-control sales-price-input" data-id="{{$cart->rowId}}"  placeholder="Sale Price" name="{{$cart->id}}" value="{{$cart->price}}"> 
            </div>
        </div>
    </li>
    <li>{{$cart->price * $cart->qty}}	</li>
    <li><a class="cart-confirm-text" data-id="{{$cart->rowId}}" href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/delete-2.svg')}}" alt="img"></a></li>
</ul>
@endforeach