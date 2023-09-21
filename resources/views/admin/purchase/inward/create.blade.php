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
			@slot('title') Purchase Inward Add @endslot
			@slot('title_1') Add/Update Purchase Inward @endslot
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
                                <label>Material Inward Date </label>
                                <div class="input-groupicon">
                                    <input type="date" class="form-control" name="inward_date">
                                   
                                </div>
                                <div class="text-danger form-error" id="inward_date_error"></div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Purchase </label>
                                <div class="input-groupicon">
                                    <select class="form-control select purchase-select" name="purchase">
                                        <option value="">Select Purchase</option>
                                    </select>
                                   
                                </div>
                                <div class="text-danger form-error" id="purchase_error"></div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Received By </label>
                                <div class="input-groupicon">
                                    <select class="form-control select received_by-select" name="received_by">
                                        <option value="">Select Received By</option>
                                        @foreach ($employees as $data)
                                        <option value="{{$data->id}}">{{$data->name ." >> ".$data->email}}</option>
                                    @endforeach
                                    </select>
                                   
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
                                        {{-- <th>Variant</th> --}}
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>MRP</th>
                                        <th>TAX</th>
                                        <th>Received Quanity</th>
                                        {{-- <th>Price Details</th> --}}

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

                        <div class="col-lg-12 float-md-right">
                            <div class="total-order">
                                <ul>
                                    
                                    <li class="total">
                                        <h4>Grand Total</h4>
                                        <h5 id="grand-total">0</h5>
                                        <input type="hidden" id="final-price" name="grand_total">
                                    </li>
                                </ul>
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
            $('#purchase-items').html('')
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
	  