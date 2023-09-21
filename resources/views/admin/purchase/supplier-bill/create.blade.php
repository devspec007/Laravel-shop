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
			@slot('title') Supplier Bill Add @endslot
			@slot('title_1') Add/Update  Supplier Bill @endslot
		@endcomponent

      
         <form action="{{route('admin.supplier-bills.store')}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Supplier Name</label>
                                <div class="row">
                                    <div class="col-lg-1w col-sm-12 col-12">
                                        <select class="select supplier-select" name="supplier">
                                            <option value="">Select</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->name ." >> ".$supplier->email}}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger form-error" id="supplier_error"></div>

                                    </div>
                                    {{-- <div class="col-lg-2 col-sm-2 col-2 ps-0">
                                        <div class="add-icon">
                                            <a href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/plus1.svg')}}" alt="img"></a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Supplier Bill Date </label>
                                <div class="input-groupicon">
                                    <input type="date" class="form-control" name="supply_date">
                                   
                                </div>
                                <div class="text-danger form-error" id="supply_date_error"></div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Shipping Date </label>
                                <div class="input-groupicon">
                                    <input type="date" class="form-control" name="shipping_date">
                                   
                                </div>
                                <div class="text-danger form-error" id="shipping_date_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Inward </label>
                                <div class="input-groupicon">
                                    <select class="form-control select inward-select" name="inward">
                                        <option value="">Select Inward</option>
                                    </select>
                                   
                                </div>
                                <div class="text-danger form-error" id="inward_error"></div>

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
                                        <th>Quantity</th>
                                        <th>Received Qty</th>

                                        <th>Purchase Unit Price</th>
                                        <th>MRP</th>
                                        <th>TAX</th>
                                        <th class="text-end">Total Cost 	</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="purchase-items">

                                
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-danger form-error" id="error_error"></div>

                        
                    </div>
                    <div id="online-transaction"  style="display:none">

                        <div class="row" >
                            <div class="col-md-3 from-group">
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
                    <div class="row">
                       
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
                data : {supplier_id : $(this).val(), 'type' : 'inward'},
                success : function(response) {
                  
                    console.log(response, 'response')
                    var list = '<option value="">Select Inward</option>';
                    $.each(response.data, function(index, value){
                        list += `<option value="${value.id}">${value.inward_no}</option>`;
                    });
                    $('.inward-select').html(list)
                },
                error : function(error) {
                    console.log(error, 'error')

                }
            })
        })

        $(document).on('change', '.inward-select', function(e){
            e.preventDefault();
            $.ajax({
                type : 'get',
                dataType : 'json',
                url : '{{route("admin.get-inward-data")}}',
                data : {inward_id : $(this).val(), 'response' : 'html'},
                success : function(response) {
                    console.log(response)
                    $('#purchase-items').html(response.data)
                    
                },
                error : function(error) {

                }
            })
        })

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

        
        </script>
@endsection
	  