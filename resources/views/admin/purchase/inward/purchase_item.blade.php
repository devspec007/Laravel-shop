
@foreach ($purchase->pendingPurchaseItems as $item)
    
<tr>
    <td class="productimgname">
        {{$item->sku->product->name}} 
        @foreach ($item->sku->productAttributes as $key => $option)
        {{$option->attribute->lable ?? ''}} : {{$option->attribute_value}} @if(count($item->sku->productAttributes)-1 > $key) / @endif
    @endforeach
        {{-- <input type="text" name="product" required class="form-control" value="{{$item->sku->product->name}}" disabled> --}}
       <input type="hidden" name="item_id[]" required  class="product_id" value="{{$item->id}}">
    </td>
    <td>
        {{$item->sku->sku}}
       
    </td>
    {{-- <td>
        @foreach ($item->sku->productAttributes as $key => $option)
        {{$option->attribute->lable ?? ''}} : {{$option->attribute_value}} @if(count($item->sku->productAttributes)-1 > $key) / @endif
    @endforeach
    </td> --}}
    <td><input type="numeric" required class="form-control" disabled value="{{$item->pending_quantity}}"></td>
    <td><input type="numeric" required class="form-control" name="unit_price" readonly value="{{$item->unit_price}}"></td>
    <td><input type="numeric" required class="form-control" disabled value="{{$item->mrp}}"></td>
    <td><input type="numeric" required class="form-control" disabled value="{{$item->unit_tax}}"></td>

    <td>
        <input type="hidden" class="unit-price" value="{{$item->unit_price+$item->unit_tax}}">
        <input class="form-control purchase-inward-quantity quantity" name="quantity[]" value="0"></td>
    {{-- <td>
        <span class="price-details">
        Price (C) = {{$item->sku->price}}<br>Price (W) = {{$item->sku->wholesale_price}}<br>MRP = {{$item->sku->mrp}}
    </span></td> --}}
    <td><input class="form-control final-price " disabled value="0"></td>

   
</tr>
@endforeach
