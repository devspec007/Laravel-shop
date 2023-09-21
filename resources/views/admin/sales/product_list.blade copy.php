@foreach ($skus as $sku)
 @if($sku->product)    
 @php
     print_r(json_encode($sku->product));
 @endphp   
{{-- <div class="col-lg-3 col-sm-6 d-flex ">
    <div class="productset flex-fill" data-product="{{$sku->id}}"  data-type="pos_order">
        <input type="checkbox"  class="pos-brand-category-checkbox">
        
        <div class="productsetimg">
            <img src="{{ $sku->product && $sku->product->primaryImage ? asset('uploads/products/'.$sku->product->primaryImage->image) : URL::asset('/assets/img/product/product1.jpg')}}" alt="img">
            {{-- <h6>Qty: {{$inventory->left_quantity}}</h6> --}}
           
        </div>
        <div class="productsetcontent">
            <h5>{{$sku->product->name}}</h5>
            <h4>{{$sku->product->category->name}} {{$sku->product->subcategory->name}} {{$sku->product->brand->name}}</h4>
            <h5>SKU : {{$sku->sku}}</h5>
            <h5>
                @foreach ($sku->productAttributes as $productAttributes)
                {{$productAttributes->attribute->lable .":".$productAttributes->attribute_value}} /
            @endforeach
            </h5>
            <h6>Purchase Price : ₹ {{$sku->unit_price}}</h6>
            <h6>Sales Price : ₹ {{$sku->regular_price}}</h6>
            <div >
                <button class="btn btn-sm btn-primary">Add To Cart</button>
            </div>
        </div>
    </div>
</div> --}}
@endif
@endforeach