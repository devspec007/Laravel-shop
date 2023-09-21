<tr>
    <td class="productimgname">
        {{$inventory->sku->product->name}} 
        {{$inventory->product && $inventory->product->category ? $inventory->product->category->name : ''}} 
        {{$inventory->product && $inventory->product->subcategory ? $inventory->sku->product->subcategory->name : ''}} 
        {{$inventory->product && $inventory->product->brand ? $inventory->sku->product->brand->name : ''}} 
        ( {{$inventory->sku->sku}})
       <input type="hidden" name="inventory_id[]" required  class="sku_id" value="{{$inventory->id}}">
    </td>
    <td>
        {{$inventory->left_quantity}}
    </td>
    <td>
        ₹ {{$inventory->unit_price}}
        <input hidden class="purchase-inward-quantity unit-price " required name="unit_price[]" value="{{$inventory->unit_price}}">
    </td>
    <td><input type="number" class="form-control purchase-inward-quantity quantity" required name="quantity[]" min="1" max="{{$inventory->left_quantity}}" value="1"></td>

    <td><input class="form-control final-price " disabled value="{{$inventory->unit_price*1}}"></td>
    <td>
        <a class="delete-set remove-purchase-item"><img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="svg"></a>
    </td>
</tr>
