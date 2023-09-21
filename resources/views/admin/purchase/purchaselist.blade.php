<?php $page="purchaselist";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') PURCHASE LIST @endslot
			@slot('title_1') Manage your purchases @endslot
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
                        {{-- <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="{{ URL::asset('/assets/img/icons/pdf.svg')}}" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{ URL::asset('/assets/img/icons/excel.svg')}}" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{ URL::asset('/assets/img/icons/printer.svg')}}" alt="img"></a>
                            </li>
                        </ul> --}}
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
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="supplier">
                                            <option value="">Choose Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                            <option value="{{$supplier->id}}" {{$request->supplier == $supplier->id ? 'selected' : ''}}>{{$supplier->name ." >> ".$supplier->email}}</option>
                                        @endforeach
                                        </select>
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
                                {{-- <th>
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th> --}}
                                <th>Supplier Name</th>
                                <th>Reference</th>
                                <th>Purchase Date</th>
                                <th>Supplier date</th>

                                <th>Quantity</th>
                                <th>Grand Total</th>
                                {{-- <th>Paid</th> --}}
                                {{-- <th>Due</th> --}}
                                {{-- <th>Payment Status</th> --}}
                                <th>Status</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $data)
                            <tr>
                                {{-- <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td> --}}
                                <td class="text-bolds">{{$data->supplier->name ?? ''}}</td>
                                <td><a class="text-primary" href="{{route('admin.purchase.show',[$data->id])}}">{{$data->refrence_number}}</a></td>
                                <td>{{$data->purchase_date}}</td>
                                <td>{{$data->supplier_date}}</td>

                                <td>{{$data->total_quantity}}</td>
                                <td>{{$data->total_amount}}</td>
                                {{-- <td>{{$data->total_amount_paid}}</td> --}}
                                {{-- <td>{{$data->due_amount}}</td> --}}
                                {{-- <td><span class="badges @if($data->payment_status == 'paid')bg-lightgreen @elseif($data->payment_status == 'unpaid') bg-lightred @else bg-lightyellow @endif">{{$data->payment_status}}</span></td> --}}
                                <td>{!! getStatusDetail($data->status) !!}</td>
                                
                                <td>
                                 

                                    <a href="{{route('admin.purchase.pdf',[$data->id])}}" target="blank" class="btn btn-sm btn-warning me-3"><i class="fas fa-file"></i></a>
                                    @if (strtolower($data->status) == 'in progress')
                                        
                                    <a class="me-3 btn btn-sm btn-secondary" href="{{route('admin.purchase.edit',[$data->id])}}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                   

                                    <a class="me-3 btn btn-sm btn-danger confirm-text" data-href="{{route('admin.purchase.delete',[$data->id])}}?type=delete">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    <a class="me-3 btn btn-sm btn-danger cancel-confirm-text" data-href="{{route('admin.purchase.delete',[$data->id])}}?type=cancel">
                                        <i class="fas fa-times"></i>
                                    </a>
                                    @endif

                                    {{-- <a class="me-3 confirm-text" href="javascript:void(0);">
                                        <img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="img">
                                    </a> --}}
                                </td>
                            </tr>
                            @endforeach
                          
                           
                        </tbody>
                    </table>
                    {{ $purchases->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection