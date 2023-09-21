@foreach ($skus as $sku)
 @if($sku->product)    
  @foreach ($sku->inventories as $inventory)
      
  <div class="col-lg-3 col-sm-6 d-flex ">
      <div class="productset flex-fill" data-product="{{$inventory->id}}"  data-type="pos_order">
          {{-- <input type="checkbox"  class="pos-brand-category-checkbox"> --}}
          
          <div class="productsetimg">
              <img src="{{ $sku->product && $sku->product->primaryImage ? asset('uploads/products/'.$sku->product->primaryImage->image) : URL::asset('/assets/img/product/product1.jpg')}}" alt="img">
             
          </div>
          <div class="productsetcontent">
              <h5>{{$sku->product->name}}</h5>
              @if($sku->productAttributes)
              <span class="pos-variant-detail">(
                @foreach ($sku->productAttributes as $key => $productAttributes)
                {{$productAttributes->attribute_value}} @if(count($sku->productAttributes)-1 > $key )/ @endif
            @endforeach
              )
            </span>
            @endif
              <h4>{{$sku->product->category->name ?? ''}} {{$sku->product->subcategory->name ?? ''}} {{$sku->product->brand->name ?? ''}}</h4>
              <h5>SKU : {{$sku->sku}}</h5>
             
              <h6>Purchase Price : ₹ {{$inventory->unit_price}}</h6>
            <h6>Sales Price : ₹ {{$sku->price}}</h6>
          
              <div >
                  <button class="btn btn-sm btn-primary">Add To Cart</button>
              </div>
          </div>
      </div>
  </div>
  @endforeach
@endif
@endforeach