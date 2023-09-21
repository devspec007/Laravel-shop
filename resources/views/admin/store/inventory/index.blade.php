<?php $page="purchaselist";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Store  @endslot
			@slot('title_1') Store Inventory @endslot
		@endcomponent
        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        {{-- <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="{{ URL::asset('/assets/img/icons/filter.svg')}}" alt="img">
                                <span><img src="{{ URL::asset('/assets/img/icons/closes.svg')}}" alt="img"></span>
                            </a>
                        </div> --}}
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
                               
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Brand</th>
                                <th>SKU</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventories as $data)
                            <tr>
                               
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{ $data->product && $data->product->primaryImage ? asset('uploads/products/'.$data->product->primaryImage->image) : URL::asset('/assets/img/product/product1.jpg')}}" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">{{$data->product ? $data->product->name : ''}}</a>
                                </td>
                                {{-- <td>PT001</td> --}}
                                <td>{{$data->product && $data->product->category? $data->product->category->name : ''}}</td>
                                <td>{{$data->product && $data->product->subcategory ? $data->product->subcategory->name : ''}}</td>

                                <td>{{$data->product && $data->product->brand ? $data->product->brand->name : ''}}</td>
                                <td>{{$data->sku ? $data->sku->sku : ''}}</td>

                                <td>{{$data->left_quantity}}</td>
                                <td>{{$data->unit_price}}</td>
                               
                            </tr>
                            @endforeach
                          
                           
                        </tbody>
                    </table>
                 
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection