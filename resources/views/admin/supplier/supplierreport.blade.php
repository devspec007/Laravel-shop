<?php $page="supplierreport";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Supplier Report @endslot
			@slot('title_1') Manage your Supplier Report @endslot
		@endcomponent
        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <div class="tabs-set">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="purchase-tab" data-bs-toggle="tab" data-bs-target="#purchase" type="button" role="tab" aria-controls="purchase" aria-selected="true">Purchase</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button" role="tab" aria-controls="payment" aria-selected="false">Payment</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="return-tab" data-bs-toggle="tab" data-bs-target="#return" type="button" role="tab" aria-controls="return" aria-selected="false">Return</button>
                        </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="purchase" role="tabpanel" aria-labelledby="purchase-tab">
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
                            <div class="card" id="filter_inputs">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-lg-2 col-sm-6 col-12">
                                            <div class="form-group">
                                                <div class="input-groupicon">
                                                    <input type="text" placeholder="From Date" class="datetimepicker">
                                                    <div class="addonset">
                                                        <img src="{{ URL::asset('/assets/img/icons/calendars.svg')}}" alt="img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-6 col-12">
                                            <div class="form-group">
                                                <div class="input-groupicon">
                                                    <input type="text" placeholder="To Date" class="datetimepicker">
                                                    <div class="addonset">
                                                        <img src="{{ URL::asset('/assets/img/icons/calendars.svg')}}" alt="img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                            <div class="form-group">
                                                <a class="btn btn-filters ms-auto"><img src="{{ URL::asset('/assets/img/icons/search-whites.svg')}}" alt="img"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Filter -->
                            <div class="table-responsive">
                                <table class="table datanew">
                                    <thead>
                                        <tr>
                                           
                                            <th>purchased Date</th>
                                            <th>Supplier</th>
                                            <th>Inoice</th>
                                            <th>Purchased amount</th>
                                            <th>purchased QTY</th>
                                            <th>Paid</th>
                                            <th>balance</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($purchases as $data)
                                            
                                      
                                        <tr>
                                           
                                            <td>{{$data->purchase_date}}</td>
                                            <td>{{$data->supplier->name ?? ''}}</td>
                                            <td>{{$data->refrence_number}}</td>
                                            <td>{{$data->total_amount}}</td>
                                            <td>{{$data->total_quantity}}</td>
                                            <td>{{$data->total_amount_paid}}</td>
                                            <td>{{$data->due_amount}}</td>
                                            <td>
                                                <a href="{{route('admin.supplier.payments',[$data->id])}}">Payments</a>
                                                {{-- <span class="badges bg-lightgrey">Recieved</span> --}}
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="payment" role="tabpanel" >
                            <div class="table-top">
                                <div class="search-set">
                                    <div class="search-path">
                                        <a class="btn btn-filter" id="filter_search2">
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
                            <div class="card" id="filter_inputs2">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-lg-2 col-sm-6 col-12">
                                            <div class="form-group">
                                                <div class="input-groupicon">
                                                    <input type="text" placeholder="From Date" class="datetimepicker">
                                                    <div class="addonset">
                                                        <img src="{{ URL::asset('/assets/img/icons/calendars.svg')}}" alt="img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-6 col-12">
                                            <div class="form-group">
                                                <div class="input-groupicon">
                                                    <input type="text" placeholder="To Date" class="datetimepicker">
                                                    <div class="addonset">
                                                        <img src="{{ URL::asset('/assets/img/icons/calendars.svg')}}" alt="img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                            <div class="form-group">
                                                <a class="btn btn-filters ms-auto"><img src="{{ URL::asset('/assets/img/icons/search-whites.svg')}}" alt="img"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Filter -->
                            <div class="table-responsive">
                                <table class="table datanew">
                                    <thead>
                                        <tr>
                                            <th>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </th>
                                            <th>DATE</th>
                                            <th>Purchase</th>
                                            <th>Reference</th>
                                            <th>Supplier name </th>
                                            <th>Amount</th>
                                            <th>Paid</th>
                                            <th>paid by</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>2022-03-10	</td>
                                            <td>PR_1001</td>
                                            <td>INV/PR_1001</td>
                                            <td>Thomas21</td>
                                            <td>1500.00</td>
                                            <td>1500.00</td>
                                            <td>Cash</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>2022-03-10	</td>
                                            <td>PR_1002</td>
                                            <td>INV/PR_1002</td>
                                            <td>504Benjamin</td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                            <td>Cash</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>2022-03-10	</td>
                                            <td>PR_1003</td>
                                            <td>INV/PR_1003</td>
                                            <td>James 524</td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                            <td>Cash</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>2022-03-10	</td>
                                            <td>PR_1004</td>
                                            <td>INV/PR_1004</td>
                                            <td>Bruklin2022 </td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                            <td>Cash</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>2022-03-10	</td>
                                            <td>PR_1005</td>
                                            <td>INV/PR_1005</td>
                                            <td>BeverlyWIN25 </td>
                                            <td>150.00</td>
                                            <td>150.00</td>
                                            <td>Cash</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>2022-03-10	</td>
                                            <td>PR_1006</td>
                                            <td>INV/PR_1006</td>
                                            <td>BHR256 </td>
                                            <td>100.00</td>
                                            <td>100.00</td>
                                            <td>Cash</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>2022-03-10	</td>
                                            <td>PR_1007</td>
                                            <td>INV/PR_1007</td>
                                            <td>Alwin243 </td>
                                            <td>5.00</td>
                                            <td>5.00</td>
                                            <td>Cash</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>2022-03-10	</td>
                                            <td>PR_1008</td>
                                            <td>INV/PR_1008</td>
                                            <td>FredJ25 </td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                            <td>Cash</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>2022-03-10	</td>
                                            <td>PR_1009</td>
                                            <td>INV/PR_1009</td>
                                            <td>Cras56 </td>
                                            <td>15.00</td>
                                            <td>15.00</td>
                                            <td>Cash</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>2022-03-10	</td>
                                            <td>PR_1010</td>
                                            <td>INV/PR_1010</td>
                                            <td>Cras56 </td>
                                            <td>15.00</td>
                                            <td>15.00</td>
                                            <td>Cash</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>2022-03-10	</td>
                                            <td>PR_1011</td>
                                            <td>INV/PR_1011</td>
                                            <td>FredJ25 </td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                            <td>Cash</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>2022-03-10	</td>
                                            <td>PR_1012</td>
                                            <td>INV/PR_1012</td>
                                            <td>Cras56 </td>
                                            <td>15.00</td>
                                            <td>15.00</td>
                                            <td>Cash</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>2022-03-10	</td>
                                            <td>PR_1013</td>
                                            <td>INV/PR_1013</td>
                                            <td>Cras56 </td>
                                            <td>15.00</td>
                                            <td>15.00</td>
                                            <td>Cash</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="return" role="tabpanel" >
                            <div class="table-top">
                                <div class="search-set">
                                    <div class="search-path">
                                        <a class="btn btn-filter" id="filter_search1">
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
                            <div class="card" id="filter_inputs1">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-lg-2 col-sm-6 col-12">
                                            <div class="form-group">
                                                <div class="input-groupicon">
                                                    <input type="text" placeholder="From Date" class="datetimepicker">
                                                    <div class="addonset">
                                                        <img src="{{ URL::asset('/assets/img/icons/calendars.svg')}}" alt="img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-6 col-12">
                                            <div class="form-group">
                                                <div class="input-groupicon">
                                                    <input type="text" placeholder="To Date" class="datetimepicker">
                                                    <div class="addonset">
                                                        <img src="{{ URL::asset('/assets/img/icons/calendars.svg')}}" alt="img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                            <div class="form-group">
                                                <a class="btn btn-filters ms-auto"><img src="{{ URL::asset('/assets/img/icons/search-whites.svg')}}" alt="img"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Filter -->
                            <div class="table-responsive">
                                <table class="table datanew">
                                    <thead>
                                        <tr>
                                            <th>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </th>
                                            <th>Reference</th>
                                            <th>Supplier name </th>
                                            <th>Amount</th>
                                            <th>Paid</th>
                                            <th>Amount due</th>
                                            <th>Status</th>
                                            <th>Paument Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>RT_1001</td>
                                            <td>Thomas21</td>
                                            <td>1500.00</td>
                                            <td>1500.00</td>
                                            <td>1500.00</td>
                                            <td><span class="badges bg-lightgreen">Completed</span></td>
                                            <td><span class="badges bg-lightgreen">Paid</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>RT_1002</td>
                                            <td>504Benjamin</td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                            <td><span class="badges bg-lightgreen">Completed</span></td>
                                            <td><span class="badges bg-lightred">Overdue</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>RT_1003</td>
                                            <td>James 524</td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                            <td><span class="badges bg-lightgreen">Completed</span></td>
                                            <td><span class="badges bg-lightred">Overdue</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>RT_1004</td>
                                            <td>Bruklin2022</td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                            <td><span class="badges bg-lightgreen">Completed</span></td>
                                            <td><span class="badges bg-lightgreen">Paid</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>RT_1005</td>
                                            <td>BeverlyWIN25</td>
                                            <td>150.00</td>
                                            <td>150.00</td>
                                            <td>150.00</td>
                                            <td><span class="badges bg-lightgreen">Completed</span></td>
                                            <td><span class="badges bg-lightred">Overdue</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>RT_1006</td>
                                            <td>BHR256</td>
                                            <td>100.00</td>
                                            <td>100.00</td>
                                            <td>100.00</td>
                                            <td><span class="badges bg-lightgreen">Completed</span></td>
                                            <td><span class="badges bg-lightred">Overdue</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>RT_1007</td>
                                            <td>Alwin243</td>
                                            <td>5.00</td>
                                            <td>5.00</td>
                                            <td>5.00</td>
                                            <td><span class="badges bg-lightgreen">Completed</span></td>
                                            <td><span class="badges bg-lightgreen">Paid</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>RT_1008</td>
                                            <td>FredJ25</td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                            <td><span class="badges bg-lightgreen">Completed</span></td>
                                            <td><span class="badges bg-lightgrey">Unpaid</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>RT_1009</td>
                                            <td>FredJ25</td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                            <td><span class="badges bg-lightgreen">Completed</span></td>
                                            <td><span class="badges bg-lightgrey">Unpaid</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>RT_1010</td>
                                            <td>Cras56</td>
                                            <td>15.00</td>
                                            <td>15.00</td>
                                            <td>15.00</td>
                                            <td><span class="badges bg-lightgreen">Completed</span></td>
                                            <td><span class="badges bg-lightgrey">Unpaid</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>RT_1010</td>
                                            <td>Grace2022</td>
                                            <td>15.00</td>
                                            <td>15.00</td>
                                            <td>15.00</td>
                                            <td><span class="badges bg-lightgreen">Completed</span></td>
                                            <td><span class="badges bg-lightgrey">Unpaid</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>RT_1011</td>
                                            <td>Cras56</td>
                                            <td>15.00</td>
                                            <td>15.00</td>
                                            <td>15.00</td>
                                            <td><span class="badges bg-lightgreen">Completed</span></td>
                                            <td><span class="badges bg-lightgrey">Unpaid</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>RT_1012</td>
                                            <td>Grace2022</td>
                                            <td>15.00</td>
                                            <td>15.00</td>
                                            <td>15.00</td>
                                            <td><span class="badges bg-lightgreen">Completed</span></td>
                                            <td><span class="badges bg-lightgrey">Unpaid</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>	
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
<div class="searchpart">
    <div class="searchcontent">
        <div class="searchhead">
            <h3>Search </h3>
            <a id="closesearch"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
        </div>
        <div class="searchcontents">
            <div class="searchparts">
                <input type="text" placeholder="search here">
                <a class="btn btn-searchs" >Search</a>
            </div>
            <div class="recentsearch">
                <h2>Recent Search</h2>
                <ul>
                    <li>
                        <h6><i class="fa fa-search me-2"></i> Settings</h6>
                    </li>
                    <li>
                        <h6><i class="fa fa-search me-2"></i> Report</h6>
                    </li>
                    <li>
                        <h6><i class="fa fa-search me-2"></i> Invoice</h6>
                    </li>
                    <li>
                        <h6><i class="fa fa-search me-2"></i> Sales</h6>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection