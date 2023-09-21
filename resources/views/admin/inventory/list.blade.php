<tr>
    <td>
        <select name="store[]" class="select">
            @foreach ($stores as $store)
                                        
            <option value="{{$store->id}}">{{$store->name}} >> {{$store->email}} >> {{$store->contact}}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="sku[]" class="select">
            <option value="">Select Variant</option>
            @foreach ($product->varaints as $variant)
                <option value="{{$variant->id}}">
                    {{$variant->sku}}
                    @foreach ($variant->productAttributes as $productAttributes)
                        {{$productAttributes->attribute->lable .":".$productAttributes->attribute_value}} /
                    @endforeach
                </option>
                
            @endforeach
        </select>
    </td>
    <td><input type="text" class="form-control" name="quantity[]"></td>
    <td><input type="text" class="form-control" name="unit_price[]"></td>
    <td><input type="text" class="form-control" name="sale_price[]"></td>

    <td>
        <a class="delete-set remove-purchase-item"><img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="svg"></a>
    </td>
</tr>