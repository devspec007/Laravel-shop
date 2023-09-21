<?php $page="addtransfer";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') ADD Transfer @endslot
			@slot('title_1') Transfer your stocks to one store another store. @endslot
		@endcomponent
        <form action="{{route('admin.transfer.store')}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>From</label>
                                <select class="select" name="from_store" id="from_store">
                                    <option value="">Choose</option>
                                    @if($main_store)
                                    <option value="{{$main_store->id}}">{{$main_store->name}}</option>
                                    @endif
                                    @foreach ($stores as $store)
                                    <option value="{{$store->id}}">{{$store->name}} >> {{$store->email}} >> {{$store->contact}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="from_store_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>To</label>
                                <select class="select" name="to_store">
                                    <option value="">Choose</option>
                                    @if($main_store)
                                    <option value="{{$main_store->id}}">{{$main_store->name}}</option>
                                    @endif
                                    @foreach ($stores as $store)
                                    <option value="{{$store->id}}">{{$store->name}} >> {{$store->email}} >> {{$store->contact}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="to_store_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Date </label>
                                <div class="input-groupicon">
                                    <input type="date" placeholder="DD-MM-YYYY" class="form-control" name="transfer_date">
                                    <div class="text-danger form-error" id="transfer_date_error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <div class="input-groupicon">
                                    <input type="text" class="search-product-for-transer" id="search-product-for-transer" placeholder="Scan/Search Product by code and select...">
                                    <div class="addonset">
                                        <img src="{{ URL::asset('/assets/img/icons/scanners.svg')}}" alt="img">
                                    </div>
                                    <div class="search-section">
                                        <ul class="search-product-list">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive ">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>QTY</th>
                                        <th>Price</th>
                                        <th>Transfer Stock	</th>
                                        <th>Tax	</th>

                                        <th >Total Cost ($)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="transfer-items">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-lg-12 float-md-right">
                            <div class="total-order">
                                <ul>
                                
                                    <h5 id="grand-total">0</h5>
                                    <input type="hidden" id="final-price" name="grand_total">
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        
                        {{-- <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Amount Paid</label>
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
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Note</label>
                                <textarea class="form-control" name="note"></textarea>
                                <div class="text-danger form-error" id="note_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('admin.transfer.index')}}"  class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection