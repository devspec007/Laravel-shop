

<tr>
    <th><button class="btn btn-sm btn-danger remove-varaints">Remove</button></th>
    <th> <lable>{{__('Item Code/Barcode')}}</lable><input class="form-control" required name="sku[]" placeholder="Item Code/Barcode"></th>

    @foreach ($product->variantOptions as $variant)
        <th>
            <lable>{{$variant->attribute->lable ?? ''}}</lable>
            @php
                $options = [];
                    if($variant->attribute_options)  {
                    
                        $options = json_decode($variant->attribute_options);
                    }
                @endphp  
                <input type="hidden" name="attribute[]" value="{{$variant->attribute_id}}">
                <select name="option_{{$variant->attribute_id}}[]" required class="select options" id="">
                    <option value="">Select Option</option>
                    @foreach ($options as $option)
                    <option value="{{$option}}">{{$option}}</option>
                        
                    @endforeach
                </select>
        </th>
    @endforeach
</tr>
<tr style="border-bottom: 2px solid;" class="varaints-price">
  
    <th><input class="form-control" name="purchase_price[]" required placeholder="Purchase Price"></th>
    <th><input class="form-control" name="landing_cost[]" required placeholder="Landing Cost"></th>
    <th><input class="form-control" name="mrp[]" required placeholder="MRP"></th>
   
    <th><input class="form-control" name="customer_discount[]" placeholder="Selling Discount"></th>
    <th><input class="form-control" name="customer_price[]" required placeholder="Selling Price"></th>
    <th><input class="form-control" name="customer_margin[]" placeholder="Selling Margin"></th>

    <th><input class="form-control" name="retailer_discount[]" placeholder="Retailer Discount"></th>
    <th><input class="form-control" name="retailer_price[]" placeholder="Retailer Price"></th>
    <th><input class="form-control" name="retailer_margin[]" placeholder="Retailer Margin"></th>
    <th><input class="form-control" name="wholesale_discount[]" placeholder="Wholesale Discount"></th>
    <th><input class="form-control" name="wholesale_price[]" placeholder="Wholesale Price"></th>
    <th><input class="form-control" name="wholesale_margin[]" placeholder="Wholesale Margin"></th>

    <th><input class="form-control" name="minimum_qty[]" required placeholder="Minimum Qty"></th>
    <th><input class="form-control" name="opening_qty[]" required placeholder="Opening Qty"></th>
</tr>
                           