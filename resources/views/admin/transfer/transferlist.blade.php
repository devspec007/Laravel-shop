<?php $page="transferlist";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">      
        @component('components.pageheader')                
			@slot('title') Transfer List @endslot
			@slot('title_1') Transfer your stocks to one store another store. @endslot
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
                            <a class="btn btn-searchset">
                                <img src="{{ URL::asset('/assets/img/icons/search-white.svg')}}" alt="img">
                            </a>
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
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="from_store" id="from_store">
                                            <option value="">Choose From Store</option>
                                            @if($main_store)
                                            <option value="{{$main_store->id}}" {{isset($request->from_store) && $request->from_store == $main_store->id ? 'selected' : ''}}>{{$main_store->name}}</option>
                                            @endif
                                            @foreach ($stores as $store)
                                            <option value="{{$store->id}}" {{isset($request->from_store) && $request->from_store == $store->id ? 'selected' : ''}}>{{$store->name}} >> {{$store->email}} >> {{$store->contact}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="to_store" id="to_store">
                                            <option value="">Choose To Store</option>
                                            @if($main_store)
                                            <option value="{{$main_store->id}}" {{isset($request->to_store) && $request->to_store == $main_store->id ? 'selected' : ''}}>{{$main_store->name}}</option>
                                            @endif
                                            @foreach ($stores as $store)
                                            <option value="{{$store->id}}" {{isset($request->to_store) && $request->to_store == $store->id ? 'selected' : ''}}>{{$store->name}} >> {{$store->email}} >> {{$store->contact}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-6 col-12 ms-auto">
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
                                <th>Transfer No.</th>
                                <th>Transfer Date</th>
                                <th>From Location</th>
                                <th>To Location</th>
                                <th>Total Amount</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transfers as $data)
                            <tr>
                                <td>{{$data->transfer_id}}</td>
                               
                                <td>{{$data->transfer_date}}</td>
                                <td>
                                    {{$data->fromStore->name ?? ''}}
                                </td>
                                <td>{{$data->toStore->name ?? ''}}</td>
                                <td>{{$data->total_amount}}</td>
                                <td>{{$data->total_quantity}}</td>
                                <td>
                                    <a class="me-3" href="{{route('admin.transfer.show',[$data->id])}}">
                                        View
                                        {{-- <img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img"> --}}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $transfers->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection