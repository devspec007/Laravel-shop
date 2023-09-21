<?php $page="sales-details";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Order Details @endslot
			@slot('title_1') View Order details @endslot
		@endcomponent
        <div class="card">
            <div class="card-body">
                <div class="card-sales-split">
                    <h2>Sale Detail : {{$order->order_number}}</h2>
                     <ul>
                        <li>
                            <a  href="{{route('admin.order-invoice',[$order->id])}}" target="blank" class="dropdown-item"><img src="{{ URL::asset('/assets/img/icons/download.svg')}}" class="me-2" alt="img">Download pdf</a>
                            {{-- <a href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img"></a> --}}
                        </li>
                       {{-- <li>
                            <a href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/pdf.svg')}}" alt="img"></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/excel.svg')}}" alt="img"></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/printer.svg')}}" alt="img"></a>
                        </li>--}}
                    </ul> 
                </div>
                <div class="invoice-box table-height" style="max-width: 1600px;width:100%;overflow: auto;margin:15px auto;padding: 0;font-size: 14px;line-height: 24px;color: #555;">
                    <form action="{{route('admin.orders.update',[$order->id])}}" method="post" class="submit-form" enctype="multipart/form-data">


                       <table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
                           <tbody><tr class="top">
                               <td colspan="6" style="padding: 5px;vertical-align: top;">
                                   <table style="width: 100%;line-height: inherit;text-align: left;">
                                       <tbody><tr>
                                           <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                               <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">Billing Details</font></font><br>
                                              
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$billing_address->email ?? ''}}</font></font><br>
   
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$billing_address->name ?? ''}}</font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$billing_address->phone_no ?? ''}}</font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$billing_address->address ?? ''}} {{$billing_address->area ?? ''}} {{$billing_address->state ?? ''}} {{$billing_address->city ?? ''}} {{$billing_address->pincode ?? ''}}</font></font><br>
   
                                           </td>
                                           @if(strtolower($order->delivery_type) == 'local delivery')
                                           <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                               <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">Shipping Details</font></font><br>
                                               
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$shipping_address->name ?? ''}}</font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$shipping_address->phone_no ?? ''}}</font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$shipping_address->address ?? ''}} {{$shipping_address->area ?? ''}} {{$shipping_address->state ?? ''}} {{$shipping_address->city ?? ''}} {{$shipping_address->pincode ?? ''}}</font></font><br>
   
                                           </td>
                                           @else
                                           <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                               <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">Company Info</font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$order->store ? $order->store->name : ''}} </font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$order->store ? $order->store->email : ''}}</font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">{{$order->store ? $order->store->contact : ''}}</font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$order->store && $order->store->profile && $order->store->profile ? $order->store->profile->address : ''}}</font></font><br>
                                           </td>
                                           @endif
                                           <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                               <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">Invoice Info</font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Order Date </font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Order No. </font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">  Payment Status</font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Status</font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Payment Type</font></font><br>
   
                                           </td>
                                           <td style="padding:5px;vertical-align:top;text-align:right;padding-bottom:20px">
                                               <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">&nbsp;</font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">{{Carbon\Carbon::parse($order->order_date)->format('d M, Y')}} </font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">{{$order->order_number}} </font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#2E7D32;font-weight: 400;"> {{ucfirst($order->payment_status)}}</font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#2E7D32;font-weight: 400;">  {{ucfirst($order->order_status)}}</font></font><br>
                                               <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#2E7D32;font-weight: 400;">  {{ucfirst($order->payment_type)}}</font></font><br>
   
                                           </td>
                                       </tr>
                                   </tbody></table>
                               </td>
                           </tr>
                           <tr class="heading " style="background: #F3F2F7;">
                               <td style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                   Product Name
                               </td>
                               <td style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                   QTY
                               </td>
                               <td style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                   Price
                               </td>
                              
                               <td style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                   Subtotal
                               </td>
                               <th>Purchase Price</th>
                           </tr>
                           @foreach ($order->items as $data)
                               
                           <tr class="details" style="border-bottom:1px solid #E9ECEF ;">
                               <td style="padding: 10px;vertical-align: top; display: flex;align-items: center;">
                                   {{-- <img src="{{ URL::asset('/assets/img/product/product1.jpg')}}" alt="img" class="me-2" style="width:40px;height:40px;"> --}}
                                   {{$data->description}}
                               </td>
                               <td style="padding: 10px;vertical-align: top; ">
                                   {{$data->quantity}}
                               </td>
                               <td style="padding: 10px;vertical-align: top; ">
                                   {{$data->amount}}
                               </td>
                               
                               <td style="padding: 10px;vertical-align: top; ">
                                   {{$data->amount*$data->quantity}}
                               </td>
                               <th>
                                <a class="inventory-btn" data-target="#row{{$data->id}}">Inventory</a>
                                <input hidden name="item[]" value="{{$data->id}}">
                                {{-- <input type="hiiden" name="item[]" value="{{$data->id}}">
                                   <select name="batch{{$data->id}}" hidden class="form-control">
                                       <option value="">Select Batch</option>
                                       @foreach ($data->sku->inventories ?? [] as $inventory)
                                           <option value="{{$inventory->id}}">{{$inventory->unit_price}} ({{$inventory->left_quantity}})</option>
                                       @endforeach
                                   </select> --}}
                               </th>
                           </tr>
                           <tr class="inventory-section hide" id="row{{$data->id}}" style="display:none;">
                            <th>
                                <td colspan="1">
                                </td>
                                <td colspan="3">
                                    <table class="table">
                                        <thead>
                                            <th>Quantity</th>
                                        <th>Batch</th>
                                        <td>
                                            <a type="button" class="add-more " data-item="{{$data->id}}" inventory-data="{{json_encode($data->sku->storeInventories)}}">Add</a>
                                        </td>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->inventories as $item_inventory)
                                                <tr>
                                                    <th>
                                                        <input style="width: 100px" class="form-control" type="numeric" name="quantity{{$data->id}}[]" value="{{$item_inventory->quantity}}">
                                                    </th>
                                                    <th>
                                                        
                                                        <select name="batch{{$data->id}}[]"  class="form-control">
                                                            <option value="">Select Batch</option>
                                                            @foreach ($data->sku->storeInventories ?? [] as $inventory)
                                                                <option value="{{$inventory->id}}" {{$item_inventory->inventory_id == $inventory->id ? 'selected' : ''}}>{{$inventory->unit_price}} ({{$inventory->left_quantity}})</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <td><a href="" class="remove-row">Remove</a></td>
                                                </tr>
                                            @endforeach
                                           
                                        </tbody>
                                    </table>
                                </td>
                            </th>
                           </tr>
                           @endforeach
                          
                       </tbody></table>
                       <button class="btn btn-sm btn-primary">Update </button>
                   </form>

                </div>
                {{-- <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Order Tax</label>
                            <input type="text">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Discount</label>
                            <input type="text">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Shipping</label>
                            <input type="text">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="select">
                                <option>Choose Status</option>
                                <option>Completed</option>
                                <option>Inprogress</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-lg-6 ">
                            <div class="total-order w-100 max-widthauto m-auto mb-4">
                                <ul>
                                    <li>
                                        <h4>Sub Total</h4>
                                        <h5>{{$order->subtotal}}</h5>
                                    </li>
                                    {{-- <li>
                                        <h4>Discount	</h4>
                                        <h5>{{$order->discount_amount}}</h5>
                                    </li>
                                    <li>
                                        <h4>GST Amount	</h4>
                                        <h5>{{$order->gst_amount}}</h5>
                                    </li>	 --}}
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="total-order w-100 max-widthauto m-auto mb-4">
                                <ul>
                                   
                                    <li class="total">
                                        <h4>Grand Total</h4>
                                        <h5>{{$order->payable_amount}}</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-12">
                        <a href="javascript:void(0);" class="btn btn-submit me-2">Update</a>
                        <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                    </div> --}}
                </div>
            </div>
            @include('admin.orders.edit')
        </div>

     
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).on('click', '.inventory-btn', function(e) {
            e.preventDefault();
            var target = $(this).attr('data-target')
            $(target).toggle()
        })
        $(document).on('click', '.add-more', function(e) {
            e.preventDefault();
            var item = JSON.parse($(this).attr('data-item'))

            var data = JSON.parse($(this).attr('inventory-data'))
            var options = '';
            $.each(data, function(index, value){
               
                options += `<option value="${value.id}">${value.unit_price} (${value.left_quantity})</option>`;
            })
         
            var html = ` <tr><th>
                                                <input style="width: 100px" class="form-control" type="numeric" name="quantity${item}[]" value="">
                                            </th>
                                            <th>
                                                
                                                <select name="batch${item}[]"  class="form-control">
                                                    <option value="">Select Batch</option>
                                                   ${options}
                                                </select>
                                            </th>
                                            <td><a href="" class="remove-row">Remove</a></td>
                                            </tr>`;
                                            console.log(html)
            $(this).parents().eq(4).find('tbody').append(html)
        })
        $(document).on('click', '.remove-row', function(e){
            e.preventDefault();
            $(this).parents().eq(1).remove()
        })
        $(document).on('submit', '.order-submit-form', function(e){
            e.preventDefault()
            $.ajax({
                type : 'post',
                url : $(this).attr('action'),
                data : $(this).serialize(),
                dataType : 'json',
                success : function(response) {
                    window.location.reload()
                },
                error : function(error) {
                        console.log(error)
                }
                
            })
        })
</script>
<style>
    .hide_cancel_reason_1 ,.hide_cancel_reason_2 ,.hide_cancel_reason_3{
        display:none;
    }
</style>
<script>
    $('.update-order-status').on('change', function() {
    let status = this.value;
    if(status==='cancelled'){
        $(".hcr1").removeClass("hide_cancel_reason_1");
        $(".hcr2").removeClass("hide_cancel_reason_2");
    }else{
        $(".hcr1").addClass("hide_cancel_reason_1");
        $(".hcr2").addClass("hide_cancel_reason_2");
    }
    });
    $('.hcrr1').on('change', function() {
    let status = this.value;
    if(status==='cancel'){
        $(".hcr2").removeClass("hide_cancel_reason_2");
        $(".hcr3").addClass("hide_cancel_reason_3");
    }else{
        $(".hcr2").addClass("hide_cancel_reason_2");
        $(".hcr3").removeClass("hide_cancel_reason_3");
    }
    });
    <?php 
    if($order->order_status == 'cancelled'){
        ?>
        $(".hcr1").removeClass("hide_cancel_reason_1");
        <?php 
        if($order->order_status_type=='cancel'){  ?>
                $(".hcr2").removeClass("hide_cancel_reason_2");
                $(".hcr3").addClass("hide_cancel_reason_3"); 
        <?php }else { ?>
            
            $(".hcr2").addClass("hide_cancel_reason_2");
            $(".hcr3").removeClass("hide_cancel_reason_3");
        <?php }
    }    
    ?>
</script>
@endsection