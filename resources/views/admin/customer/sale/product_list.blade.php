@foreach ($products as $product)
    @foreach ($product->varaints as $sku)
        
        <div class="col-lg-3 col-sm-6 d-flex ">
            <div class="productset flex-fill" data-product="{{$sku->id}}"  data-type="customer_order">
                <input type="checkbox"  class="pos-brand-category-checkbox">
                
                <div class="productsetimg">
                    <img src="{{ $product && $product->primaryImage ? asset('uploads/products/'.$product->primaryImage->image) : URL::asset('/assets/img/product/product1.jpg')}}" alt="img">
                   
                </div>
                <div class="productsetcontent">
                    <h5>{{$product->name}}</h5>
                    <h4>{{$product->category->name}} {{$product->subcategory->name}} {{$product->brand->name}}</h4>
                    <h6>SKU : ₹ {{$sku->sku}}</h6>
                    <h6>
                        @foreach ($sku->productAttributes as $productAttributes)
                        {{$productAttributes->attribute->lable .":".$productAttributes->attribute_value}} <br>
                    @endforeach
                    </h6>
                    <div >
                        <button class="btn btn-sm btn-primary">Add To Cart</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endforeach