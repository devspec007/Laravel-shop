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
            <div class="row">
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <ul class="sidebar-tabing">
                                <li class="@if((isset($request->type) && strtolower($request->type) == 'details') || !isset($request->type)) active @endif"><a href="{{route('admin.purchase.show',[$purchase->id])}}?type=details" >Order Details</a></li>
                                <li class="@if((isset($request->type) && strtolower($request->type) == 'inwards')) active @endif"><a href="{{route('admin.purchase.show',[$purchase->id])}}?type=inwards">Inwards</a></li>
        
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-10">
                    @if((isset($request->type) && strtolower($request->type) == 'details') || !isset($request->type))
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
                                            <input class="form-control" name="purchase_date" value="{{dateFormat($purchase->purchase_date)}}" disabled>
                                           
                                        </div>
        
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Created Time </label>
                                        <div class="input-groupicon">
                                            <input class="form-control" name="purchase_date" value="{{dateTimeFormat($purchase->created_at)}}" disabled>
                                           
                                        </div>
        
                                    </div>
                                </div>
        
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Supplier Date </label>
                                        <div class="input-groupicon">
                                            <input class="form-control" name="supplier_date" value="{{dateFormat($purchase->supplier_date)}}" disabled>
                                           
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
                                @php
                                    $total_tax = 0;
                                    $amount = 0;
                                @endphp
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
                                                        @php
                                                        $total_tax +=$item->unit_tax*$item->quantity;
                                                        $amount += $item->unit_price*$item->quantity;
                                                    @endphp
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
                                                <h4>Gross Amount</h4>
                                                <h5 id="grand-total">{{$amount}}</h5>
                                                <input type="hidden" id="final-price" name="grand_total">
                                            </li>
                                            <li class="total">
                                                <h4>Tax Amount</h4>
                                                <h5 id="grand-total">{{$total_tax}}</h5>
                                                <input type="hidden" id="final-price" name="grand_total">
                                            </li>
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
                    @elseif((isset($request->type) && strtolower($request->type) == 'inwards'))
                     <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datanew1">
                                    <thead>
                                        <tr>
                                            
                                            <th>Supplier Name</th>
                                            <th>Inward No.</th>
            
                                            <th>Date</th>
                                            <th>Created Time</th>
                                            <th>Quantity</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inwards as $data)
                                        <tr>
                                           
                                            <td class="text-bolds">{{$data->purchase->supplier->name ?? ''}}</td>
                                            <td><a class="text-primary" href="{{route('admin.material-inward.show',[$data->id])}}"><b>{{$data->inward_no}}</b></a></td>
                                            <td>{{dateFormat($data->inward_date)}}</td>
                                            <td>{{dateTimeFormat($data->created_at)}}</td>

                                            <td>{{array_sum(array_column(($data->inwardItems)->toArray(), 'received_quantity'))}}</td>
                                            <td>
                                              
                                                <a href="{{route('admin.material-inward.pdf',[$data->id])}}" target="blank" class="text-warning"><i class="fas fa-file"></i></a>
            
                                               
                                            </td>
                                        </tr>
                                        @endforeach
                                      
                                       
                                    </tbody>
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
	  