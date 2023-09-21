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
<div class="product-cart-wrap small hover-up">
    <div class="product-img-action-wrap">
        <div class="product-img product-img-zoom">
            <a href="{{url('product/'.$item->slug)}}">
                <img class="default-img" src="{{$image}}" alt="">
                <img class="hover-img" src="{{$image}}" alt="">
            </a>
        </div>
        <div class="product-action-1">
            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html" tabindex="0"><i class="fi-rs-heart"></i></a>
            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html" tabindex="0"><i class="fi-rs-shuffle"></i></a>
        </div>
      
        @if ($price_data['discount_percent'] != 0) 
        <div class="product-badges product-badges-position product-badges-mrg">
            <span class="hot">-{{$price_data['discount_percent']}}%</span>
        </div>
        @endif
    </div>
    <div class="product-content-wrap">
        <h2><a href="{{url('product/'.$item->slug)}}">{{$product_name}}</a></h2>
        <div class="rating-result" title="90%">
            <span>
            </span>
        </div>
        <div class="product-price">
            <span>&#8377; {{$price_data['price']}} </span>
            @if ($price_data['discount_percent'] != 0) 
                
            <span class="old-price">&#8377; {{$price_data['discounted_price']}} </span>
            @endif
        </div>
    </div>
</div>