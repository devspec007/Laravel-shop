<tr>
    <td class="productimgname">
        {{$item->sku->product->name}}
        <input type="hidden" name="sku_id[]" required  class="product_id" value="{{$item->sku_id}}">
    </td>
    <td>
        {{$item->sku->sku}}
       
    </td>
    <td>
        @foreach ($item->sku->productAttributes as $key => $option)
        {{$option->attribute_value}} @if(count($item->sku->productAttributes)-1 > $key) / @endif
    @endforeach
    </td>
    <td><input type="numeric" required class="form-control purchase-quantity quantity" name="quantity[]" value="{{$item->quantity}}"></td>
    <td>
        <input class="form-control purchase-quantity unit-price " name="unit_price[]" value="{{$item->unit_price}}" data-toggle="tooltip" data-placement="right" data-mrp="{{$item->mrp}}" title="mrp : {{$item->mrp}}">
    
    </td>
    <td>{{$item->purchase_tax}}% <br>
        @php
            $tax_price = ($item->unit_tax);
        @endphp
        Rs. <span class="tax-value"> {{$tax_price*$item->quantity}}</span>
        <input type="hidden" name="tax_amount[]" class="tax_amount" value="{{$tax_price}}">


        <input type="hidden" name="purchase_tax[]" class="purchase_tax" value="{{$item->purchase_tax}}">
    </td>
    
    <td><span class="price-details">
       MRP = {{$item->mrp}}
    </span></td>
    <td><input class="form-control final-price " disabled value="{{($item->unit_price*$item->quantity)+($tax_price*$item->quantity)}}"></td>
    <td>
        <a class="delete-set remove-purchase-item"><img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="svg"></a>
    </td>
</tr>
