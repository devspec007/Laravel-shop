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
                            @if ($product_id)
                            <li>
                                <a href="{{route('admin.product-inventory.create',[$product_id])}}">Add Inventory</a>
                            </li>
                            @endif
                        </ul>
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
                    <div class="card mb-0" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg col-sm-6 col-12">
                                            <div class="form-group">
                                                <input class="form-control" placeholder="search by name" name="search" value="{{$request->search}}">
                                            </div>
                                        </div>
                                        

                                        {{-- <div class="col-lg col-sm-6 col-12">
                                            <div class="form-group">
                                                <select name="store[]" class="select">
                                                    <option value="">Select Store</option>
                                                    @foreach ($stores as $store)
                                                                                
                                                    <option value="{{$store->id}}"  {{$request->store == $store->id ? 'selected' :''}}>{{$store->name}} >> {{$store->email}} >> {{$store->contact}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg col-sm-6 col-12">
                                            <div class="form-group">
                                                <select class="select filter-category" name="category" id="filter-category">
                                                    <option value="">Choose Category</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" {{$request->category == $category->id ? 'selected' :''}}>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg col-sm-6 col-12">
                                            <div class="form-group">
                                                <select class="select sub-category-list" name="subcategory" id="sub-category-list">
                                                    <option value="">Choose Sub Category</option>
                                                    @foreach ($subcategories as $subcategory)
                                                    <option value="{{$subcategory->id}}" {{$request->subcategory == $subcategory->id ? 'selected' :''}}>{{$subcategory->name}}</option>
    
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg col-sm-6 col-12">
                                            <div class="form-group">
                                                <select class="select" name="brand">
                                                    <option value="">Choose Brand</option>
                                                    @foreach ($brands as $brand)
                                                    <option value="{{$brand->id}}" {{$request->brand == $brand->id ? 'selected' :''}}>{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg col-sm-6 col-12 ">
                                            <div class="form-group">
                                                <select class="select">
                                                    <option>Price</option>
                                                    <option>150.00</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-1 col-sm-6 col-12">
                                            <div class="form-group">
                                                <button class="btn btn-filters ms-auto"><img src="{{ URL::asset('/assets/img/icons/search-whites.svg')}}" alt="img"></button>
                                            </div>
                                        </div>
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
                               <th>Sr. No.</th>
                                <th>Code</th>
                                <th>Product Name</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Left Quantity</th>
                                <th>MRP</th>
                                <th>Stock Value</th>
                                {{-- <th>Landing Cost Value</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventories as $index => $data)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$data->sku ? $data->sku->sku : ''}}</td>
                                <td>{{$data->product->name ?? ''}}</td>
                                <td>{{$data->product && $data->product->brand ? $data->product->brand->name : ''}}</td>
                                <td>{{$data->unit_price}}</td>
                                <td>{{$data->quantity}}</td>

                                <td>{{$data->left_quantity}}</td>
                                <td>{{$data->sku->mrp ?? ''}}</td>
                                <td>{{$data->left_quantity * $data->sku->mrp}}</td>
                                {{-- <td>{{$data->left_quantity * $data->sku->landing_cost}}</td> --}}

                               
                            </tr>
                            @endforeach
                          
                           
                        </tbody>
                    </table>
                    {{$inventories->links()}}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection