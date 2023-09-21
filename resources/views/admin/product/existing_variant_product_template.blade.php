

<tr>
    <th>
        <input type="hidden" name="sku_key[]" value="{{$sku->id}}">
        <lable>{{__('Item Code/Barcode')}}</lable>
        <input class="form-control" name="sku[]" placeholder="Item Code/Barcode" value="{{$sku->sku}}">
    </th>
    @php
    $product_attributes = ($sku->productAttributes)->toArray();
        $ids = array_column($product_attributes, 'attribute_id')
    @endphp
    @foreach ($product->variantOptions as $variant)
        <th>
            
            <lable>{{$variant->attribute->lable ?? ''}}</lable>
            @php
                $options = [];
                    if($variant->attribute_options)  {
                    
                        $options = json_decode($variant->attribute_options);
                    }
                    $index = array_search($variant->attribute_id, $ids);

                    $selected_data = isset($product_attributes[$index]) ? $product_attributes[$index]['attribute_value'] : '';
                                    
                    
                @endphp  
                <input type="hidden" name="attribute[]" value="{{$variant->attribute_id}}">
                <select name="option_{{$variant->attribute_id}}[]" class="select options" id="">
                    <option value="">Select Option</option>
                    @foreach ($options as $option)
                    <option value="{{$option}}" {{trim($selected_data)== trim($option) ? 'selected' : ''}}>{{$option}}</option>
                        
                    @endforeach
                </select>
        </th>
    @endforeach
</tr>
<tr style="border-bottom: 2px solid;" class="varaints-price">
    <th><input class="form-control" name="purchase_price[]" placeholder="Purchase Price" value="{{$sku->purchase_price}}"></th>

    <th><input class="form-control" name="landing_cost[]" placeholder="Landing Cost" value="{{$sku->landing_cost}}"></th>
    <th><input class="form-control" name="mrp[]" placeholder="MRP" value="{{$sku->mrp}}"></th>
   
    <th><input class="form-control" name="customer_discount[]" placeholder="Selling Discount" value="{{$sku->disocunt}}"></th>
    <th><input class="form-control" name="customer_price[]" placeholder="Selling Price" value="{{$sku->price}}"></th>
    <th><input class="form-control" name="customer_margin[]" placeholder="Selling Margin" value="{{$sku->selling_margin}}"></th>

    <th><input class="form-control" name="retailer_discount[]" placeholder="Retailer Discount" value="{{$sku->retailer_discount}}"></th>
    <th><input class="form-control" name="retailer_price[]" placeholder="Retailer Price" value="{{$sku->retailer_price}}"></th>
    <th><input class="form-control" name="retailer_margin[]" placeholder="Retailer Margin" value="{{$sku->retailer_margin}}"></th>

    <th><input class="form-control" name="wholesale_discount[]" placeholder="Wholesale Discount" value="{{$sku->wholesale_discount}}"></th>
    <th><input class="form-control" name="wholesale_price[]" placeholder="Wholesale Price" value="{{$sku->wholesale_price}}"></th>
    <th><input class="form-control" name="wholesale_margin[]" placeholder="Wholesale Margin" value="{{$sku->wholesale_margin}}"></th>

    <th><input class="form-control" name="minimum_qty[]" placeholder="Minimum Qty" value="{{$sku->minimum_quantity}}"></th>
    {{-- <th><input class="form-control" name="opening_qty[]" placeholder="Opening Qty" value="{{$sku->quantity}}"></th> --}}


    
</tr>
                           