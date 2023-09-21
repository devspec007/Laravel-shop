
@foreach ($purchase->pendingPurchaseItems as $item)
    
<tr>
    <td class="productimgname">
        <input type="text" name="product" required class="form-control" value="{{$item->sku->product->name}}" disabled>
       <input type="hidden" name="item_id[]" required  class="product_id" value="{{$item->id}}">
    </td>
    <td>
        <input type="text" name="variant" required class="form-control" value="{{$item->sku->sku}}" disabled>
       
    </td>
    <td>
        @foreach ($item->sku->productAttributes as $key => $option)
        {{$option->attribute->lable ?? ''}} : {{$option->attribute_value}} @if(count($item->sku->productAttributes)-1 > $key) / @endif
    @endforeach
    </td>
    <td><input type="numeric" required class="form-control quantity" disabled value="{{$item->pending_quantity}}"></td>
    <td><input class="form-control purchase-quantity " name="quantity[]" value="0"></td>
    <td>
        <input hidden class=" unit-price " name="unit_price" value="{{$item->sku->mrp}}">
        <span class="price-details">
        Price (C) = {{$item->sku->price}}<br>Price (W) = {{$item->sku->wholesale_price}}<br>MRP = {{$item->sku->mrp}}
    </span></td>
    <td><input class="form-control final-price " disabled value="0"></td>

   
</tr>
@endforeach
