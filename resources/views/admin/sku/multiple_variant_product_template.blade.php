

<tr style="border-bottom: 2px solid;" class="varaints-price">
    @if($product->product_type != 'simple')
    <th>
        @foreach ($sku->productAttributes as $key => $option)
            <span>{{$option->attribute->lable ?? ''}} : {{$option->attribute_value}} @if(count($sku->productAttributes)-1 > $key) / @endif</span>
        @endforeach
    </th>
    @endif
    <th>{{$sku->sku}}</th>
    <th>{{$sku->minimum_quantity}}</th>
    {{-- <th>{{$sku->quantity}}</th> --}}
    <th>{{$sku->purchase_price}}</th>
    <th>{{$sku->landing_cost}}</th>
    <th>{{$sku->mrp}}</th>
    <th>
        Margin : {{$sku->selling_margin}} <br>
        Discount : {{$sku->discount}} <br>
        Price : {{$sku->price}} <br>
    </th>
    <th>
        Margin : {{$sku->wholesale_margin}} <br>
        Discount : {{$sku->wholesale_discount}} <br>
        Price : {{$sku->wholesale_price}} <br>
    </th>
    <th>
        margin : {{$sku->retailer_margin}} <br>
        Discount : {{$sku->retailer_discount}} <br>
        Price : {{$sku->retailer_price}} <br>
    </th>
    {{-- <td>
                                  
        <a class="me-3" href="{{route('admin.sku.edit',[$sku->product_id,$sku->id])}}">
            <img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img">
        </a>
        <a class="confirm-text" href="javascript:void(0);">
            <img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="img">
        </a>
    </td>
  --}}

</tr>
                           