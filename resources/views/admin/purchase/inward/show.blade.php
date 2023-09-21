<?php $page="addpurchase";?>
@extends('layout.mainlayout')
@section('styles')
    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            width: 128px;
        }
        </style>
@endsection
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Purchase Inward @endslot
			@slot('title_1') Purchase Inward Show @endslot

		@endcomponent

      
         <form action="{{route('admin.material-inward.store')}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Supplier Name</label>
                                <div class="row">
                                    <div class="col-lg-1w col-sm-12 col-12">
                                        <input class="form-control" value="{{$inward->supplier->name ?? ''}}" disabled>
                                        <div class="text-danger form-error" id="supplier_error"></div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Material Inward No. </label>
                                <div class="input-groupicon">
                                    <input class="form-control" disabled value="{{$inward->inward_no?? ''}}">
                                   
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Material Inward Date </label>
                                <div class="input-groupicon">
                                    <input type="date" class="form-control" name="inward_date" disabled value="{{$inward->inward_date?? ''}}">
                                   
                                </div>
                                <div class="text-danger form-error" id="inward_date_error"></div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Purchase </label>
                                <div class="input-groupicon">
                                    <input class="form-control" name="purchase" disabled value="{{$inward->purchase->refrence_number ?? ''}}">
                                   
                                </div>
                                <div class="text-danger form-error" id="purchase_error"></div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Received By </label>
                                <div class="input-groupicon">
                                    <input class="form-control" value="{{$inward->receiver->name ?? ''}}" name="received_by" disabled>
                                </div>
                                <div class="text-danger form-error" id="received_by_error"></div>

                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Item Code</th>
                                        <th>Variant</th>
                                        <th>Quantity</th>
                                        <th>Received Qty</th>
                                        <th>Price Details</th>

                                        <th class="text-end">Total Cost 	</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="purchase-items">
                                    @foreach ($inward->inwardItems as $item)
                                       <tr>
                                            <td>{{$item->purchaseItem && $item->purchaseItem->product ? $item->purchaseItem->product->name : ''}}</td>
                                            <td>{{$item->purchaseItem && $item->purchaseItem->sku ? $item->purchaseItem->sku->sku : ''}}</td>
                                        <td>
                                            @foreach ($item->purchaseItem->sku->productAttributes as $key => $option)
                                            {{$option->attribute->lable ?? ''}} : {{$option->attribute_value}} @if(count($item->purchaseItem->sku->productAttributes)-1 > $key) / @endif
                                        @endforeach
                                        </td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->received_quantity}}</td>
                                        <td>
                                            <span class="price-details">
                                                Unit Price = {{$item->purchaseItem->unit_price}}<br>
                                                MRP = {{$item->purchaseItem->mrp}}<br>Tax = {{$item->purchaseItem->unit_tax*$item->received_quantity}}
                                            </span>
                                        </td>
                                        <td>{{$item->received_quantity*$item->purchaseItem->unit_price}}</td>
                                        </tr> 
                                    @endforeach
                                
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-danger form-error" id="error_error"></div>

                        <div class="col-lg-12 float-md-right">
                            <div class="total-order">
                                {{-- <ul>
                                    
                                    <li class="total">
                                        <h4>Grand Total</h4>
                                        <h5 id="grand-total">0</h5>
                                        <input type="hidden" id="final-price" name="grand_total">
                                    </li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Note</label>
                                <textarea class="form-control" name="note" disabled>{{$inward->note}}</textarea>
                                <div class="text-danger form-error" id="note_error"></div>

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
         </form>
    </div>
</div>		
@endsection

@section('scripts')
    <script>
        $(document).on('change', '.supplier-select', function(e){
            e.preventDefault();
            $.ajax({
                type : 'get',
                dataType : 'json',
                url : '{{route("admin.get-supplier-data")}}',
                data : {supplier_id : $(this).val(), 'type' : 'purchase'},
                success : function(response) {
                    console.log(response)
                    var list = '<option value="">Select Purchase</option>';
                    $.each(response.data, function(index, value){
                        list += `<option value="${value.id}">${value.refrence_number}</option>`;
                    });
                    $('.purchase-select').html(list)
                },
                error : function(error) {

                }
            })
        })

        $(document).on('change', '.purchase-select', function(e){
            e.preventDefault();
            $.ajax({
                type : 'get',
                dataType : 'json',
                url : '{{route("admin.get-purchase-data")}}',
                data : {purchase_id : $(this).val(), 'response' : 'html'},
                success : function(response) {
                    console.log(response)
                    $('#purchase-items').html(response.data)
                    
                },
                error : function(error) {

                }
            })
        })

        
        </script>
@endsection
	  