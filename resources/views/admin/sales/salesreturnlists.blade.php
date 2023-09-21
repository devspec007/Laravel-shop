<?php $page="salesreturnlists";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Sales Return List @endslot
			@slot('title_1') Manage your Returns @endslot
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
                                        <input type="text" placeholder="Enter Order No." name="order_number" value="{{$request->order_number}}">
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
                                        <select class="select" name="payment_type">
                                            <option value="" selected>Choose Payment Type</option>
                                            <option value="cash"  {{isset($request->payment_type) && $request->payment_type == 'cash' ? 'selected' : ''}}>Cash</option>
                                            <option value="online"  {{isset($request->payment_type) && $request->payment_type == 'online' ? 'selected' : ''}}>Online</option>
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
                                <th>Orde No.</th>
                                <th>Product Name</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                              
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($return_items as $item)
                                
                            <tr>
                                {{-- <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td> --}}
                                <td>{{$item->orderItem->order->order_number}}</td>

                                <td class="productimgname">
                                    {{-- <a href="javascript:void(0);" class="product-img">
                                        <img src="{{ URL::asset('/assets/img/product/product1.jpg')}}" alt="product">
                                    </a> --}}
                                    <a href="javascript:void(0);">{{$item->orderItem->description}}</a>
                                </td>
                                <td>{{Carbon\Carbon::parse($item->return_date)->format('d M, Y')}}</td>
                                <td>{{$item->orderItem->order->customer_name}} ({{$item->orderItem->order->customer_mobile}})</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->orderItem->amount}}</td>
                              
                                <td>
                                    <a class="me-3" href="{{route('admin.sales.return.edit',[$item->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    {{-- <a class="me-3 confirm-text" href="javascript:void(0);">
                                        <img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="img">
                                    </a> --}}
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    {{ $return_items->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection