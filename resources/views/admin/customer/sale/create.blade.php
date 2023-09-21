<?php $page="saleslist";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Sales List @endslot
			@slot('title_1') Manage your sales @endslot
		@endcomponent
        <!-- /product list -->
        <div class="page-wrapper ms-0">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 col-sm-12 tabs_wrapper" >
                        
                       <form class="order-filter-data">
                       
                          
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control order-search-product" name="filter_category" placeholder="search category">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control order-search-product" name="filter_brand" placeholder="search brand">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control order-search-product" name="filter_subcategory" placeholder="search subcategory">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control order-search-product" name="filter_product" placeholder="search product">
                                    </div>
                                  
                                </div>
                          
                            
                       
                       </form>
        
                        <div class="tabs_container" >
                            <div  class="" >
                                <div class="row mt-5" id="pos-product-list">
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 ">
                        
                        <form action="{{route('admin.customer-place-order')}}" method="post" class="submit-form">
                            @csrf
                            <input type="hidden" class="final-checkout-total-input" value="{{Cart::instance('customer_order')->total()}}">
                            <div class="card card-order">
                                <div class="card-body">
                                    <div class="row">
                                        {{-- <div class="col-12">
                                            <a href="javascript:void(0);" class="btn btn-adds" data-bs-toggle="modal" data-bs-target="#create"><i class="fa fa-plus me-2"></i>Add Customer</a>
                                        </div> --}}
                                        <div class="col-lg-12">
                                            <div class="select-split ">
                                                <div class="select-group w-100">
                                                    <select class="select" name="customer_type">
                                                        <option value="">Walk-in Customer</option>
                                                        @foreach ($customers as $customer)
                                                            <option value="{{$customer->id}}">{{$customer->name}} >> {{$customer->contact}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="form-error" id="customer_type_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <hr>
                                            <div class="row">
                                               
                                                <div class="col-lg-12">
                                                    <div class="select-split">
                                                        <div class="select-group w-100">
                                                            <input class="form-control" name="customer_name" placeholder="Name">
                                                            <div class="form-error" id="customer_name_error"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="select-split">
                                                        <div class="select-group w-100">
                                                            <input class="form-control" name="mobile_no" placeholder="Mobile No.">
                                                            <div class="form-error" id="mobile_no_error"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="split-card">
                                </div>
                                <div class="card-body pt-0">
                                    <div class="totalitem">
                                        <h4>Total items : <span class="total-cart-quantity">{{\Cart::instance('customer_order')->count()}}</span></h4>
                                        <a href="javascript:void(0);" class="cart-confirm-text" data-id="">Clear all</a>
                                    </div>
                                    <div class="product-table" id="cart-list">
                                        @include('admin.sales.cart_list')
                                    </div>
                                </div>
                                <div class="split-card">
                                </div>
                                <div class="card-body pt-0 pb-2">
                                    <div class="setvalue">
                                       
                                        <ul>
                                            <li class="total-value">
                                                <h5>Discount </h5>
                                                <h6 >
                                                    <input class="form-control discount_amount" name="discount_amount" value="0" placeholder="Enter Discount Amount">
                                                    <span class="form-error" id="discount_amount_error"></span>
                                                </h6>
                                            </li>
                                            <li class="total-value">
                                                <h5>GST (%)</h5>
                                                <h6 >
                                                    <input class="form-control gst_amount" name="gst_amount" value="0" placeholder="Enter GST">
                                                    <span class="form-error" id="gst_amount_error"></span>
                                                </h6>
                                            </li>
        
                                            <li>
                                                <h5>Subtotal </h5>
                                                <h6 id="final-subtotal">{{Cart::instance('customer_order')->subtotal()}}</h6>
                                            </li>
                                            <li>
                                                <h5>Discount </h5>
                                                <h6 id="discounted-amount">-0</h6>
                                            </li>
                                            <li>
                                                <h5>GST </h5>
                                                <h6 id="gst-amount">+0</h6>
                                            </li>
                                            <li class="total-value">
                                                <h5>Total  </h5>
                                                <h6 id="final-total">{{Cart::instance('customer_order')->total()}}</h6>
                                            </li>
                                            <li class="total-value">
                                                <h5>Total Paid </h5>
                                                <h6 >
                                                    <input type="text" class="form-control" name="paid_amount">
                                                    <span class="form-error" id="paid_amount_error"></span>
                                                </h6>
                                            </li>
                                        </ul>
        
                                    </div>
                                    <div class="setvaluecash">
                                        <ul>
                                            <li>
                                                <input type="radio" value="cash" name="payment_type" checked class="payment-type-option">
                                                <a href="javascript:void(0);" class="paymentmethod active">
                                                    <img src="{{ URL::asset('/assets/img/icons/cash.svg')}}" alt="img" class="me-2">
                                                    Cash
                                                </a>
                                            </li>
                                            <li>
                                                <input type="radio" value="online" name="payment_type" class="payment-type-option">
            
                                                <a href="javascript:void(0);" class="paymentmethod">
                                                    <img src="{{ URL::asset('/assets/img/icons/debitcard.svg')}}" alt="img" class="me-2">
                                                    Online
                                                </a>
                                            </li>
                                            {{-- <li>
                                                <a href="javascript:void(0);" class="paymentmethod">
                                                    <img src="{{ URL::asset('/assets/img/icons/scan.svg')}}" alt="img" class="me-2">
                                                    Scan
                                                </a>
                                            </li> --}}
                                        </ul>
                                    </div>		
                                    {{-- <div class="btn-totallabel"> --}}
                                        <button type="submit" class="btn-totallabel w-100">Checkout
                                            <h6 id="final-checkout-total">{{Cart::instance('customer_order')->total()}}</h6>
                                        </button>
                                        
                                    {{-- </div>							 --}}
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@component('components.modal-popup')                
@endcomponent
@endsection