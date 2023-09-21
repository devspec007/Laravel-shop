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
			@slot('title') Supplier Bill @endslot
			@slot('title_1') Supplier Bill Show @endslot

		@endcomponent

      
            <div class="row">
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <ul class="sidebar-tabing">
                                <li class="@if($type == 'details' || $type == null) active @endif"><a href="{{route('admin.supplierBillDetails',[$bill->id, 'details'])}}" >Bill Details</a></li>
                                <li class="@if($type == 'transactions') active @endif"><a href="{{route('admin.supplierBillDetails',[$bill->id, 'transactions'])}}">Transactions</a></li>
        
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-10">
                    @if($type == 'details' || $type == null)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Supplier Name</label>
                                        <div class="row">
                                            <div class="col-lg-1w col-sm-12 col-12">
                                                <input class="form-control" value="{{$bill->supplier->name ?? ''}}" disabled>
                                                <div class="text-danger form-error" id="supplier_error"></div>
        
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Material Inward No. </label>
                                        <div class="input-groupicon">
                                            <input class="form-control" disabled value="{{$bill->bill_no?? ''}}">
                                           
                                        </div>
        
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Supplier Bill Date </label>
                                        <div class="input-groupicon">
                                            <input type="date" class="form-control" name="supply_date" disabled value="{{$bill->supply_date}}">
                                           
                                        </div>
                                        <div class="text-danger form-error" id="supply_date_error"></div>
        
                                    </div>
                                </div>
        
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Shipping Date </label>
                                        <div class="input-groupicon">
                                            <input type="date" class="form-control" name="shipping_date" disabled value="{{$bill->shipping_date}}">
                                           
                                        </div>
                                        <div class="text-danger form-error" id="shipping_date_error"></div>
        
                                    </div>
                                </div>
        
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Select Purchase </label>
                                        <div class="input-groupicon">
                                            <input class="form-control" name="purchase" disabled value="{{$bill->inward->inward_no ?? ''}}">
                                           
                                        </div>
                                        <div class="text-danger form-error" id="purchase_error"></div>
        
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Shipping Date </label>
                                        <div class="input-groupicon">
                                            <input type="date" class="form-control" name="shipping_date" disabled value="{{$bill->shipping_date}}">
                                           
                                        </div>
                                        <div class="text-danger form-error" id="shipping_date_error"></div>
        
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Shipping Date </label>
                                        <div class="input-groupicon">
                                            <input type="date" class="form-control" name="shipping_date" disabled value="{{$bill->shipping_date}}">
                                           
                                        </div>
                                        <div class="text-danger form-error" id="shipping_date_error"></div>
        
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
                                                <th>Unit Price</th>
        
                                                <th class="text-end">Total Cost 	</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="purchase-items">
                                            @foreach ($bill->supplyItems as $item)
                                               <tr>
                                                    <td>{{$item->purchaseItem && $item->purchaseItem->product ? $item->purchaseItem->product->name : ''}}</td>
                                                    <td>{{$item->purchaseItem && $item->purchaseItem->sku ? $item->purchaseItem->sku->sku : ''}}</td>
                                                <td>
                                                    @foreach ($item->purchaseItem->sku->productAttributes as $key => $option)
                                                    {{$option->attribute->lable ?? ''}} : {{$option->attribute_value}} @if(count($item->purchaseItem->sku->productAttributes)-1 > $key) / @endif
                                                @endforeach
                                                </td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$item->purchaseItem->unit_price}}</td>
        
                                                
                                                <td>{{$item->amount}}</td>
                                                </tr> 
                                            @endforeach
                                        
                                                <tr class="text-danger font-bold">
                                                    <th colspan="4"></th>
                                                    <th>Due Amount</th>
                                                    <th>{{$bill->pending_amount}}</th>

                                                </tr>
                                                <tr class="text-success font-bold">
                                                    <th colspan="4"></th>
                                                    <th>Paid Amount</th>
                                                    <th>{{$bill->paid_amount}}</th>

                                                </tr>
                                                <tr class="text-info font-bold">
                                                    <th colspan="4"></th>
                                                    <th>Total Amount</th>
                                                    <th>{{$bill->total_amount}}</th>

                                                </tr>
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
                                        <textarea class="form-control" name="note" disabled>{{$bill->note}}</textarea>
                                        <div class="text-danger form-error" id="note_error"></div>
        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    @else

        
                        @if($bill->pending_amount > 0)
                        <form action="{{route('admin.supplier-transaction')}}" method="post" class="submit-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="bill_id" value="{{$bill->id}}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>Due Amount</label>
                                                <input type="text" disabled value="{{$bill->pending_amount}}">
                                            
                
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>Transaction Date </label>
                                                <div class="input-groupicon">
                                                    <input type="date" class="form-control" name="transaction_date" >
                                                
                                                </div>
                                                <div class="text-danger form-error" id="transaction_date_error"></div>
                
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>Total Amount Paid</label>
                                                <input type="text" name="amount_paid">
                                                <div class="text-danger form-error" id="amount_paid_error"></div>
                
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>Payment Type</label>
                                                <select class="select payment_type" name="payment_type" >
                                                    <option value="">Choose Status</option>
                                                    <option value="online">Online</option>
                                                    <option value="cash">Cash</option>
                                                </select>
                                                <div class="text-danger form-error" id="payment_type_error"></div>
                    
                                            </div>
                                        </div>
            
                                        <div id="online-transaction"  style="display:none">
            
                                            <div class="row" >
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                    <lable>Select Bank</lable>
                                                    <select name="bank" class="form-control" id="">
                                                        <option value="">Select bank</option>
                                                        <option value="Axis Bank">Axis Bank</option>
                                                    </select>
                                                    <div class="text-danger form-error" id="tbank_error"></div>
                                                    </div>
                        
                                                </div>
                                                <div class="col-md-3 from-group">
                                                    <div class="form-group">
                                                    <lable>Select Type</lable>
                                                    <select name="type" class="form-control" id="online_type">
                                                        <option value="online">Online</option>
                                                        <option value="cheque">Cheque</option>
                                                    </select>
                                                    <div class="text-danger form-error" id="type_error"></div>
                                                    </div>
                        
                                                </div>
                                            </div>
                                            <div class="row" id="online_details">
                                                <div class="col-md-3 from-group">
                                                    <div class="form-group">
                                                    <lable>Transaction Date</lable>
                                                    <input name="transaction_date" class="form-control" type="date">
                                                    <div class="text-danger form-error" id="transaction_date_error"></div>
                                                    </div>
                        
                                                </div>
                                                <div class="col-md-3 from-group">
                                                    <div class="form-group">
                                                    <lable>Transaction No.</lable>
                                                    <input name="transaction_no" class="form-control" type="text">
                                                    <div class="text-danger form-error" id="transaction_no_error"></div>
                                                    </div>
                        
                                                </div>
                                            </div>
                                            <div class="row" id="cheque_details" style="display:none">
                                                <div class="col-md-3 from-group">
                                                    <div class="form-group">
                                                    <lable>Cheque Date</lable>
                                                    <input name="cheque_date" class="form-control" type="date">
                                                    <div class="text-danger form-error" id="cheque_date_error"></div>
                                                    </div>
                        
                                                </div>
                                                <div class="col-md-3 from-group">
                                                    <div class="form-group">
                                                    <lable>Cheque No.</lable>
                                                    <input name="cheque_no" class="form-control" type="text">
                                                    <div class="text-danger form-error" id="cheque_no_error"></div>
                                                    </div>
                        
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Note</label>
                                                <textarea class="form-control" name="note"></textarea>
                                                <div class="text-danger form-error" id="note_error"></div>
                
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                                            <a href="{{url('purchaselist')}}" class="btn btn-cancel">Cancel</a>
                                        </div>
                                    </div>  
                                </div>  
                            </div>    
                        </form>
                        @endif

                        <div class="card ">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Paid Amount</th>
                                            <th>Payment Type</th>
                                            <th>Type</th>

                                            <th>Payment Date</th>
                                            <th>Payment Transaction</th>
                                            
                                            <th>Note</th>
                                        </tr>
                                        @foreach ($bill->inventoryTransactions as $transaction)
                                        @php
                                            $data = [];
                                            if(!empty($transaction->additional_data)) {
                                                $data = json_decode($transaction->additional_data);
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{$transaction->paid_amount}}</td>
                                            <td>{{$data->payment_type ?? ''}}</td>
                                            <td>{{$data->type ?? ''}}</td>

                                            <td>{{isset($data->transaction_date) && !empty($data->transaction_date) ? $data->transaction_date : (isset($data->cheque_date) && !empty($data->cheque_date) ? $data->cheque_date : Carbon\Carbon::parse($bill->created_at)->format('Y-m-d'))}}</td>
                                            <td>{{isset($data->transaction_no) && !empty($data->transaction_no) ? $data->transaction_no : (isset($data->cheque_no) && !empty($data->cheque_no) ? $data->cheque_no : '')}}</td>
                                            <td>{{$transaction->note}}</td>

                                        </tr>
                                            
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
       
           
        
    </div>
</div>		
@endsection

@section('scripts')
    <script>
         
         $(document).on('change', '.payment_type', function(e){
            e.preventDefault();
            if($(this).val() == 'cash') {

                $('#online-transaction').hide()
            }
            else {
                $('#online-transaction').show()

            }
        })
        $(document).on('change', '#online_type', function(e){
            e.preventDefault();
            if($(this).val() == 'online') {

                $('#online_details').show()
                $('#cheque_details').hide()
            }
            else {
                $('#cheque_details').show()
                $('#online_details').hide()

            }
        })

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
	  