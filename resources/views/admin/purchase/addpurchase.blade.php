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
			@slot('title') Purchase Add @endslot
			@slot('title_1') Add/Update Purchase @endslot
		@endcomponent

      
         <form action="{{route('admin.purchase.store')}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Supplier Name</label>
                                <div class="row">
                                    <div class="col-lg-1w col-sm-12 col-12">
                                        <select class="select" name="supplier">
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
                                <label>Purchase Date </label>
                                <div class="input-groupicon">
                                    <input type="date" class="form-control" name="purchase_date">
                                   
                                </div>
                                <div class="text-danger form-error" id="purchase_date_error"></div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Supplier Date </label>
                                <div class="input-groupicon">
                                    <input type="date" class="form-control" name="supplier_date">
                                   
                                </div>
                                <div class="text-danger form-error" id="supplier_date_error"></div>

                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Reference No./Invoice No.</label>
                                <input type="text" name="refrence_number">
                                <div class="text-danger form-error" id="refrence_number_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="Scan/Search Product by code and select..." id="search-product">
                                  
                                    <div class="search-section">
                                        <ul class="search-product-list">
                                        </ul>
                                    </div>
                                </div>
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
                                        <th>Purchase Unit Price</th>
                                        <th>Tax </th>

                                        <th>Price Details</th>

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
                      
                        {{-- <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Total Amount Paid</label>
                                <input type="text" name="amount_paid">
                                <div class="text-danger form-error" id="amount_paid_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Payment Type</label>
                                <select class="select" name="payment_type">
                                    <option value="">Choose Status</option>
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                </select>
                                <div class="text-danger form-error" id="payment_type_error"></div>
    
                            </div>
                        </div>
                        --}}
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
	  