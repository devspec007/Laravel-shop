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
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="{{ URL::asset('/assets/img/icons/filter.svg')}}" alt="img">
                                <span><img src="{{ URL::asset('/assets/img/icons/closes.svg')}}" alt="img"></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img src="{{ URL::asset('/assets/img/icons/search-white.svg')}}" alt="img"></a>
                        </div>
                    </div>
                    <div class="wordset">
                         <ul>
                            <li>
                                <a href="{{route('admin.customer-sales.create')}}">Add Sale</a>
                            </li>
                           {{--
                              <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="{{ URL::asset('/assets/img/icons/pdf.svg')}}" alt="img"></a>
                            </li>
                             <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{ URL::asset('/assets/img/icons/excel.svg')}}" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{ URL::asset('/assets/img/icons/printer.svg')}}" alt="img"></a>
                            </li>--}}
                        </ul> 
                    </div>
                </div>
                <!-- /Filter -->
                <form action="" class="filter" id="filter-data">
                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="date" class=" cal-icon form-control" placeholder="Choose Date" name="start_date" value="{{$request->start_date}}">
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="date" class=" cal-icon  form-control" placeholder="Choose Date" name="end_date" value="{{$request->end_date}}">
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group" >
                                        <input type="text" placeholder="Enter Order No." name="refrence_number" value="{{$request->refrence_number}}">
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="search" placeholder="Search By Customer name and phone no." value="{{$request->search}}">
                                    </div>
                                </div>
                                {{-- <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Choose Status</option>
                                            <option>Inprogress</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="payment_status">
                                            <option value="" selected>Choose Payment Status</option>
                                            <option value="partial" @if(isset($request->payment_status) && in_array('partial', $request->payment_status)) selected @endif>Partial</option>
                                            <option value="paid" @if(isset($request->payment_status) && in_array('paid', $request->payment_status)) selected @endif>Paid</option>
                                            <option value="unpaid" @if(isset($request->payment_status) && in_array('unpaid', $request->payment_status)) selected @endif>Unpaid</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-6 col-12">
                                    <div class="form-group">
                                        <button class="btn btn-filters ms-auto"><img src="{{ URL::asset('/assets/img/icons/search-whites.svg')}}" alt="img"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /Filter -->
                <div class="table-responsive">
                    <table class="table  datanew1">
                        <thead>
                            <tr>
                                {{-- <th>
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th> --}}
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Customer Mobile</th>
                                <th>Order No.</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Discount</th>
                                <th>Total</th>
                                <th>Payable Amount</th>
                                <th>Due Amount</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $data)
                                
                            <tr>
                                {{-- <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td> --}}
                                <td>{{Carbon\Carbon::parse($data->order_date)->format('d M, Y')}}</td>
                                <td>{{$data->customer_name}}</td>
                                <td>{{$data->customer_mobile}}</td>
                                <td>{{$data->order_number}}</td>
                                <td><span class="badges bg-lightgreen">{{ucfirst($data->order_status)}}</span></td>
                                <td><span class="badges @if(strtolower($data->payment_status) == 'paid') bg-lightgreen @elseif(strtolower($data->payment_status) == 'unpaid') bg-lightred @else bg-lightyellow @endif">{{ucfirst($data->payment_status)}}</span></td>
                                <td>{{$data->discount_amount}}</td>
                                <td>{{$data->total_amount}}</td>
                                <td class="text-red">{{$data->payable_amount}}</td>
                                <td @if($data->due_amount > 0)class="text-red" @endif>{{$data->due_amount}}</td>
                              
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu"  >
                                        <li>
                                            <a href="{{route('admin.sales.show',[$data->id])}}" class="dropdown-item"><img src="{{ URL::asset('/assets/img/icons/eye1.svg')}}" class="me-2" alt="img">Sale Detail</a>
                                        </li>
                                        <li>
                                            <a  href="{{route('admin.sales.invoice',[$data->id])}}" target="blank" class="dropdown-item"><img src="{{ URL::asset('/assets/img/icons/download.svg')}}" class="me-2" alt="img">Download pdf</a>
                                        </li>
                                        <li>
                                            <a href="{{route('admin.sales.payments',[$data->id])}}" target="blank" class="dropdown-item"><img src="{{ URL::asset('/assets/img/icons/dollar-square.svg')}}" class="me-2" alt="img">Show Payments</a>
                                        </li>	
                                        {{-- <li>
                                            <a href="{{url('edit-sales')}}" class="dropdown-item"><img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" class="me-2" alt="img">Edit Sale</a>
                                        </li>
                                        
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#createpayment"><img src="{{ URL::asset('/assets/img/icons/plus-circle.svg')}}" class="me-2" alt="img">Create Payment</a>
                                        </li>
                                        
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item confirm-text"><img src="{{ URL::asset('/assets/img/icons/delete1.svg')}}" class="me-2" alt="img">Delete Sale</a>
                                        </li>								 --}}
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@component('components.modal-popup')                
@endcomponent
@endsection