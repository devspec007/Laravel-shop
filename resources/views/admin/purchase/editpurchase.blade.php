<?php $page="addpurchase";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Purchase Show @endslot
			@slot('title_1') View Purchase @endslot
		@endcomponent

        <style>
            .search-section {
                background: white;
    filter: drop-shadow(2px 4px 6px #ddd);
            }
            .search-section li {
                padding: 10px;
            }
            .search-section li:hover {
              
                background: #ff9f436e;
            }
            li.search-product-item.active {
                background: #FF9F43;
            }
        </style>
        <form action="{{route('admin.purchase.update',[$purchase->id])}}" method="post" class="submit-form">
    
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
                                                <option value="{{$supplier->id}}" {{$purchase->supplier_id == $supplier->id ? 'selected' : ''}}>{{$supplier->name ." >> ".$supplier->email}}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger form-error" id="supplier_error"></div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Purchase Date </label>
                               
                                    
                                    <div class="input-groupicon">
                                        <input type="date" class="form-control" name="purchase_date" value="{{$purchase->purchase_date}}">
                                       
                                    </div>
                                    <div class="text-danger form-error" id="purchase_date_error"></div>
                                

                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Supplier Date </label>
                                <div class="input-groupicon">
                                    <input type="date" class="form-control" name="supplier_date" value="{{$purchase->supplier_date}}">
                                   
                                </div>
                                <div class="text-danger form-error" id="supplier_date_error"></div>


                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Reference No./Invoice No.</label>
                                <input type="text" name="refrence_number" value="{{$purchase->refrence_number}}">
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
                        @csrf
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
                                            <th class="text-end">Total Cost ($)	</th>

                                        </tr>
                                    </thead>
                                    <tbody id="purchase-items">
    
                                        @foreach ($purchase->purchaseItems as $item)
                                            @include('admin.purchase.purchase_item_list')
                                          
                                        @endforeach
                                    
                                    </tbody>
                                </table>
                                {{-- <div class="col-lg-12 mt-3 text-right">
                                    <button type="submit" class="btn btn-submit me-2">Submit</button>
                                </div> --}}
                            </div>
                        </div>
                   
                    <div class="row">
                        <div class="col-lg-12 float-md-right">
                            <div class="total-order">
                                <ul>
                                    
                                    <li class="total">
                                        <h4>Grand Total</h4>
                                        <h5 id="grand-total">{{$purchase->total_amount}}</h5>
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
                                <textarea class="form-control" name="note">{{$purchase->note}}</textarea>
                                <div class="text-danger form-error" id="note_error"></div>


                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Update</button>
                            <a href="{{url('purchaselist')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                      
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>		
@endsection
	  