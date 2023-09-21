<?php $page="importpurchase";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Import Purchase @endslot
			@slot('title_1') Add/Update Purchase @endslot
		@endcomponent
        <form action="{{route('admin.import-purchase.data')}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Supplier Name</label>
                            <div class="row">
                                <div class="col-lg-1w col-sm-12 col-12">
                                    <select class="select" name="supplier" required>
                                        <option value="">Select</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->name ." >> ".$supplier->email}}</option>
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
                                <input type="date" class="form-control" name="purchase_date" required>
                               
                            </div>
                            <div class="text-danger form-error" id="purchase_date_error"></div>

                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Reference No./Invoice No.</label>
                            <input type="text" name="refrence_number" required>
                            <div class="text-danger form-error" id="refrence_number_error"></div>

                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <a href="{{asset('sample/purchase-sample.xlsx')}}" target="blank" class="btn btn-submit w-100">Download Sample File</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>	Upload CSV File</label>
                            <div class="image-upload">
                                <input type="file" name="file" required>
                                <div class="image-uploads">
                                    <img src="{{ URL::asset('/assets/img/icons/upload.svg')}}" alt="img">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                      
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Total Amount Paid</label>
                                <input type="text" name="amount_paid" required>
                                <div class="text-danger form-error" id="amount_paid_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Payment Type</label>
                                <select class="select" name="payment_type" required>
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
                                <div class="text-danger form-error" id="no_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{url('purchaselist')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection