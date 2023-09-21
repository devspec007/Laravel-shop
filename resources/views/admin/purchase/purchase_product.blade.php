<tr>
    <td class="productimgname">
        {{$sku->product->name}}
       <input type="hidden" name="sku_id[]" required  class="product_id" value="{{$sku->id}}">
    </td>
    <td>
        {{$sku->sku}}
       
    </td>
    <td>
        @foreach ($sku->productAttributes as $key => $option)
        {{$option->attribute_value}} @if(count($sku->productAttributes)-1 > $key) / @endif
    @endforeach
    </td>
    <td><input type="numeric" required class="form-control purchase-quantity quantity" name="quantity[]" value="0"></td>
    <td>
        <input class="form-control purchase-quantity unit-price " name="unit_price[]" value="{{$sku->purchase_price}}" data-toggle="tooltip" data-placement="right" data-mrp="{{$sku->mrp}}" title="mrp : {{$sku->mrp}}">
    
    </td>
    <td>{{$sku->product->purchase_tax}}% <br>
        @php
            $tax_price = ($sku->purchase_price*$sku->product->purchase_tax)/100;
        @endphp
        Rs. <span class="tax-value"> {{$tax_price}}</span>
        <input type="hidden" name="tax_amount[]" class="tax_amount" value="{{$tax_price}}">

        <input hidden class=" old_unit_price " name="old_unit_price[]" value="{{$sku->purchase_price}}"> 
        <input type="hidden" name="purchase_tax[]" class="purchase_tax" value="{{$sku->product->purchase_tax}}">
    </td>
    
    <td><span class="price-details">
       MRP = {{$sku->mrp}}
    </span></td>
    <td><input class="form-control final-price " disabled value="{{$sku->purchase_price+$tax_price}}"></td>
    <td>
        <a class="delete-set remove-purchase-item"><img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="svg"></a>
    </td>
</tr>
