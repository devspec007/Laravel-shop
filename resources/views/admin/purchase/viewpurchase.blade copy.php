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
    
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Supplier Name</label>
                                <div class="row">
                                    <div class="col-lg-1w col-sm-12 col-12">
                                        <input class="form-control" name="supplier" value="{{$purchase->supplier->name ?? ''}}" disabled>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Purchase Date </label>
                                <div class="input-groupicon">
                                    <input type="date" class="form-control" name="purchase_date" value="{{$purchase->purchase_date}}" disabled>
                                   
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Supplier Date </label>
                                <div class="input-groupicon">
                                    <input type="date" class="form-control" name="supplier_date" value="{{$purchase->supplier_date}}" disabled>
                                   
                                </div>

                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Reference No./Invoice No.</label>
                                <input type="text" name="refrence_number" value="{{$purchase->refrence_number}}" disabled>

                            </div>
                        </div>
                      
                    </div>
                    <form action="{{route('admin.purchase.update',[$purchase->id])}}" method="post" class="submit-form">
                        @csrf
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Item Code</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Received Qty</th>
                                            <th>Pending Qty</th>

                                            <th>Purchase Unit Price</th>
                                            <th>Tax</th>
                                            <th>MRP</th>
                                            <th class="text-end">Total Cost ($)	</th>

                                        </tr>
                                    </thead>
                                    <tbody id="purchase-items">
    
                                        @foreach ($purchase->purchaseItems as $item)
                                            <tr>
                                                <td> {{$item->sku->sku}}</td>
                                                <td>
                                                    {{$item->product->name ?? ''}} 
                                                    @foreach ($item->sku->productAttributes as $key => $productAttributes)
                                                        @if($key != 0)
                                                        / 
                                                        @endif
                                                        {{$productAttributes->attribute_value}} 
                                                    @endforeach
                                                </td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$item->received_quantity}}</td>
                                                <td>{{$item->pending_quantity}}</td>

                                                <td>{{$item->unit_price}}</td>
                                                <td>{{$item->unit_tax*$item->quantity}}</td>
                                                <td>
                                                    {{$item->mrp}}
                                                    {{-- <input type="hidden" value="{{$item->id}}" name="items[]">
                                                    <input type="text" class="form-control" name="sale_price_{{$item->id}}" value="{{$item->sale_price}}"> --}}
                                                </td>
                                                <td>{{$item->total_price}}</td>
                                            </tr>
                                        @endforeach
                                    
                                    </tbody>
                                </table>
                                {{-- <div class="col-lg-12 mt-3 text-right">
                                    <button type="submit" class="btn btn-submit me-2">Submit</button>
                                </div> --}}
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-12 float-md-right">
                            <div class="total-order">
                                <ul>
                                    
                                    <li class="total">
                                        <h4>Grand Total</h4>
                                        <h5 id="grand-total">{{$purchase->total_amount}}</h5>
                                        <input type="hidden" id="final-price" name="grand_total">
                                    </li>
                                    {{-- <li class="total">
                                        <h4>Total Amount Paid</h4>
                                        <h5>{{$purchase->total_amount_paid}}</h5>
                                    </li> --}}
                                    {{-- <li class="total">
                                        <h4>Due Amount</h4>
                                        <h5>{{$purchase->due_amount}}</h5>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Note</label>
                                <textarea class="form-control" name="note" disabled>{{$purchase->note}}</textarea>

                            </div>
                        </div>
                        
                      
                    </div>
                </div>
            </div>
            @if($purchase->due_amount > 0)
            <form action="{{route('admin.purchase-transaction')}}" method="post" class="submit-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="purchase_id" value="{{$purchase->id}}">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Due AMount</label>
                                    <input type="text" disabled value="{{$purchase->due_amount}}">
                                  
    
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Transaction Date </label>
                                    <div class="input-groupicon">
                                        <input type="date" class="form-control" name="transaction_date" >
                                      
                                    </div>
                                    <div class="text-danger form-error" id="transaction_date_error"></div>
    
                                </div>
                            </div>
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
                                    <select class="select" name="payment_type">
                                        <option value="">Choose Status</option>
                                        <option value="online">Online</option>
                                        <option value="offline">Offline</option>
                                    </select>
                                    <div class="text-danger form-error" id="payment_type_error"></div>
        
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
            </form>
            @endif
    </div>
</div>		
@endsection
	  