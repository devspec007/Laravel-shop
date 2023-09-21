<?php $page="salesreport";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Sales Report @endslot
			@slot('title_1') Manage your Sales Report @endslot
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
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="{{ URL::asset('/assets/img/icons/pdf.svg')}}" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{ URL::asset('/assets/img/icons/excel.svg')}}" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{ URL::asset('/assets/img/icons/printer.svg')}}" alt="img"></a>
                            </li>
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
                               <th>Order Number</th>
                               <th>Order Date</th>
                                <th>Product Name</th>
                                <th>SKU</th>
                                <th> Category</th>
                                <th>Brand</th>
                                <th>Sold amount</th>
                                <th>Sold qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $data)
                            <tr>
                               <td>{{$data->order->order_number ?? ''}}</td>
                               <td>{{Carbon\Carbon::parse($data->order->order_date)->format('d M, Y')}}</td>
                                <td class="productimgname">
                                    
                                    <a href="javascript:void(0);">{{$data->inventory->product->name ?? ''}}</a>
                                </td>
                                <td>{{$data->sku_code}}</td>
                                <td>{{$data->inventory->product->category->name ?? ''}} {{$data->inventory->product->subcategory->name ?? ''}}</td>
                                <td>{{$data->inventory->product->brand->name ?? ''}}</td>
                                
                                <td>{{$data->quantity*$data->amount ?? ''}}</td>
                              
                                <td>{{$data->quantity }}</td>
                               
                            </tr>
                            @endforeach
                          
                        </tbody>
                        
                    </table>
                    {{ $items->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection