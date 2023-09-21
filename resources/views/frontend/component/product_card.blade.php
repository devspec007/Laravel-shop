@php
     $product_name = '';
    // if($item->brand) {
    //     $product_name .= $item->brand->name;
    // }
    $product_name .= $item->name;

    if($item->varaints && count($item->varaints) > 0) {
        // $varaints  = $item->varaints[0];
        if(count($item->activeSKU->productAttributes) > 0) {

            $product_name .= " ( ";
            foreach ($item->activeSKU->productAttributes as $key => $value) {
                $product_name .= $value->attribute_value;
                if((count($item->activeSKU->productAttributes) -1) != $key)  {
                    $product_name .= ',';
                }
            }
           
            $product_name .= " )";
        }

    }

    $sub_category = '';
    if($item->subcategory) {
        $sub_category = $item->subcategory->name ?? '';
    }
    $image = asset('/frontend/assets/imgs/shop/product-2-1.jpg');
    if($item->primaryImage) {
        $image = asset('/uploads/products/'.$item->primaryImage->image);
    }
   
    $price_data = variantProductPrice($item->activeSKU);
@endphp
<div class="product-cart-wrap mb-30">
    <div class="product-img-action-wrap">
        <div class="product-img product-img-zoom">
            <a href="{{url('product/'.$item->slug)}}">
                <img class="default-img" src="{{$image}}" alt="">
                <img class="hover-img" src="{{$image}}" alt="">
            </a>
        </div>
    
        <div class="product-action-1">
            <a aria-label="Quick view" data-key="{{$item->id}}" class="action-btn hover-up product-quick-view" ><i class="fi-rs-search"></i></a>
            <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
            <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
        </div>
        @if ($price_data['discount_percent'] != 0) 
        <div class="product-badges product-badges-position product-badges-mrg">
            <span class="hot">-{{$price_data['discount_percent']}}%</span>
        </div>
        @endif
    </div>
    <div class="product-content-wrap">
        <div class="product-category">
            <a href="{{url('product/'.$item->slug)}}">{{$sub_category}}</a>
        </div>
        <h2><a href="{{url('product/'.$item->slug)}}">{{$product_name}}</a></h2>
        {{-- @if ($discount_percent != 0) 

            <div class="rating-result" title="{{$discount_percent}}%">
                <span>
                    <span>{{$discount_percent}}%</span>
                </span>
            </div>
        
            
        @endif --}}
        <div class="product-price">
            <span>&#8377; {{$price_data['price']}} </span>
            @if (!empty($price_data['discounted_price']) && $price_data['discounted_price'] != 0 && $price_data['discount_percent'] != 0) 
                
            <span class="old-price">&#8377; {{$price_data['discounted_price']}} </span>
            @endif
        </div>
        <div class="product-action-1 show">
            <form action="" class="add-to-cart-form">
                @csrf

                <div class="detail-extralink">
                    
                    <div class="product-extra-link2">
                        <input name="variant_id" hidden value="{{$item->activeVariant->id }}">
                        <button type="submit" aria-label="Add To Cart" class="action-btn hover-up  button-add-to-cart card-add-to-cart "><i class="fi-rs-shopping-bag-add"></i></button>
                    </div>
                </div>
            </form>

            {{-- <a aria-label="Add To Cart" class="action-btn hover-up" href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a> --}}
        </div>
    </div>
</div>