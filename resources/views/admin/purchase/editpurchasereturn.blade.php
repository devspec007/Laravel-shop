<?php $page="editpurchasereturn";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Edit Purchase Return @endslot
			@slot('title_1') Add/Update Purchase Return @endslot
		@endcomponent
        <form action="{{route('admin.purchase.return.update-item',[$item->id])}}" class="submit-form" method="post">
            @csrf
        
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Reference Number</label>
                                <div class="row">
                                    <div class="col-lg-10 col-sm-10 col-10">
                                        <input class="form-control" disabled value="{{$item->purchase->refrence_number}}">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Supplier</label>
                                <div class="row">
                                    <div class="col-lg-10 col-sm-10 col-10">
                                        <input class="form-control" disabled value="{{$item->purchase->supplier->name ?? ''}}">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Quantity</label>
                                <div class="row">
                                    <div class="col-lg-10 col-sm-10 col-10">
                                        <input class="form-control" disabled value="{{$item->quantity}}">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product</label>
                                <div class="input-groupicon">
                                    <input type="text" disabled value="{{$item->purchaseItem->product->productFullName()}}">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Unit Price</label>
                                <div class="row">
                                    <div class="col-lg-10 col-sm-10 col-10">
                                        <input class="form-control" disabled value="{{$item->purchaseItem->unit_price}}">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Return Date</label>
                                <div class="input-groupicon">
                                    <input type="date" class="form-control" name="return_date" value="{{Carbon\Carbon::parse($item->return_date)->format('Y-m-d')}}">
                                    <span class="form-error" id="return_date_error"></span>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Revert Quantity</label>
                                <div class="row">
                                    <div class="col-lg-10 col-sm-10 col-10">
                                        <input class="form-control" name="revert_quantity" value="0">
                                        <span class="form-error" id="revert_quantity_error"></span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Type</label>
                                <div class="row">
                                    <div class="col-lg-10 col-sm-10 col-10">
                                        <select  class="form-control"  name="type">
                                            <option value="return" {{$item->type == 'return' ? 'selected' : ''}}>Return </option>
                                            <option value="replace" {{$item->type == 'replace' ? 'selected' : ''}}>Replace </option>
                                        </select>
                                        <span class="form-error" id="type_error"></span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Reason</label>
                                <div class="row">
                                    <div class="col-lg-10 col-sm-10 col-10">
                                        <select  class="form-control"  name="reason">
                                            <option value="damage" {{$item->reason == 'damage' ? 'selected' : ''}}>Damage </option>
                                            <option value="not interested" {{$item->reason == 'not interested' ? 'selected' : ''}}>Not Interested </option>
                                        </select>
                                        <span class="form-error" id="reason_error"></span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Payment Type</label>
                                <div class="row">
                                    <div class="col-lg-10 col-sm-10 col-10">
                                        <select  class="form-control"  name="payment_type">
                                            <option value="cash"  {{$item->payment_type == 'cash' ? 'selected' : ''}}>Cash</option>
                                            <option value="online"  {{$item->payment_type == 'online' ? 'selected' : ''}}>Online</option>
                                        </select>
                                        <span class="form-error" id="reason_error"></span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Note</label>
                                <div class="row">
                                    <div class="col-lg-10 col-sm-10 col-10">
                                        <textarea class="form-control" name="note">{{$item->note}}</textarea>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2">Update</button>
                       
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
</div>
@endsection