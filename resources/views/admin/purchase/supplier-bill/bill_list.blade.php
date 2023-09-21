<?php $page="purchaselist";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Bill LIST @endslot
			@slot('title_1') Manage your Bill @endslot
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
                                <a href="{{route('admin.supplier-bills.create')}}" class="btn btn-sm btn-primary">Create Bill</a>
                            </li>
                            {{--  <li>
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
                                        <input type="text" placeholder="Enter Reference" name="refrence_number" value="{{$request->refrence_number}}">
                                    </div>
                                </div>
                                {{-- <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="supplier">
                                            <option value="">Choose Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                            <option value="{{$supplier->id}}" {{$request->supplier == $supplier->id ? 'selected' : ''}}>{{$supplier->name ." >> ".$supplier->email}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div> --}}
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
                                        <select class="select" name="payment_status[]" multiple>
                                            <option value="">Choose Payment Status</option>
                                            <option value="paid" @if(isset($request->payment_status) && in_array('paid', $request->payment_status)) selected @endif>Paid</option>
                                            <option value="unpaid" @if(isset($request->payment_status) && in_array('unpaid', $request->payment_status)) selected @endif>Unpaid</option>
                                            <option value="partial" @if(isset($request->payment_status) && in_array('partial', $request->payment_status)) selected @endif>Partial</option>

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
                    <table class="table datanew1">
                        <thead>
                            <tr>
                                
                                <th>Supplier Name</th>
                                <th>Bill No.</th>
                                <th>Supplier Bill Date</th>
                                <th>Shipping Date</th>
                                <th>Bill Amount</th>
                                <th>Paid Amount</th>
                                <th>Status</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $data)
                            <tr>
                               
                                <td class="text-bolds">{{$data->supplier->name ?? ''}}</td>
                                <td>{{$data->bill_no}}</td>
                                <td>{{$data->supply_date}}</td>
                                <td>{{$data->shipping_date}}</td>
                                <td>{{$data->total_amount}}</td>
                                <td>{{$data->paid_amount}}</td>
                                <td>{!! getStatusDetail($data->payment_status) !!}</td>
                               
                                <td>
                                    
                                    <a class="me-3" href="{{route('admin.supplier-bills.show',[$data->id])}}">
                                        View
                                    </a>
                                   
                                </td>
                            </tr>
                            @endforeach
                          
                           
                        </tbody>
                    </table>
                    {{ $list->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection