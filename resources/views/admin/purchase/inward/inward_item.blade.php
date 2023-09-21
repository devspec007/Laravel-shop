
@php
    $total_amount = 0;
@endphp
@foreach ($purchase->pendingPurchaseItems as $item)
    
<tr>
    <td class="productimgname">
        {{$item->sku->product->name}} 
        @foreach ($item->sku->productAttributes as $key => $option)
        {{$option->attribute->lable ?? ''}} : {{$option->attribute_value}} @if(count($item->sku->productAttributes)-1 > $key) / @endif
    @endforeach
       <input type="hidden" name="item_id[]" required  class="product_id" value="{{$item->id}}">
    </td>
    <td>
        {{$item->sku->sku}}
       
    </td>
    <td><input type="numeric" required class="form-control" disabled value="{{$item->quantity}}"></td>
    
    <td><input type="numeric" required class="form-control" disabled value="{{$item->received_quantity}}"></td>
    <td><input type="numeric" required class="form-control unit-price" name="unit_price" readonly value="{{$item->purchaseItem->unit_price}}"></td>
    <td><input type="numeric" required class="form-control" disabled value="{{$item->purchaseItem->mrp}}"></td>
    <td><input type="numeric" required class="form-control" disabled value="{{$item->purchaseItem->unit_tax*$item->received_quantity}}"></td>

    <td><input class="form-control final-price " disabled value="{{$item->pending_amount}}"></td>
    @php
    $total_amount += (float)$item->pending_amount;
@endphp
   
</tr>
@endforeach
<tr>
    <th colspan="6"></th>
    <th>Grand Total</th>
    <th>{{$total_amount}} <input type="hidden" name="total_amount" value="{{$total_amount}}"></th>



</tr>



<tr>
    <th colspan="6"></th>
    <th>Total Amount Paid</th>
    <th>
        <input type="text" name="amount_paid" class="form-control" value="{{$total_amount}}">
        <div class="text-danger form-error" id="amount_paid_error"></div>
    </th>


</tr>

<tr>
    <th colspan="6"></th>
    <th>Payment Type</th>
    <th>
        <select class="form-control payment_type" name="payment_type">
            <option value="">Choose Status</option>
            <option value="online">Online</option>
            <option value="cash">Cash</option>
        </select>
        <div class="text-danger form-error" id="payment_type_error"></div>

    </th>


</tr>