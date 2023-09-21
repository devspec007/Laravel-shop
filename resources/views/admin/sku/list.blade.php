<?php $page="productlist";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Product List @endslot
			@slot('title_1') Manage your products @endslot
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
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img src="{{ URL::asset('/assets/img/icons/search-white.svg')}}" alt="img"></a>
                        </div> --}}
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a href="{{route('admin.sku.create',[$product_id, 'edit'])}}" class="btn btn-sm btn-primary">Bulk Update</a>
                            </li>
                            <li>
                                <a href="{{route('admin.sku.create',[$product_id])}}" class="btn btn-sm btn-primary">Add New</a>
                            </li>
                            {{-- <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="{{ URL::asset('/assets/img/icons/pdf.svg')}}" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{ URL::asset('/assets/img/icons/excel.svg')}}" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{ URL::asset('/assets/img/icons/printer.svg')}}" alt="img"></a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <!-- /Filter -->
               
                <!-- /Filter -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                               <th></th>
                                <th>SKU</th>
                                <th>price (C)</th>
                                <th>price (W)</th>
                                <th>Discount (C)</th>
                                <th>Discount (W)</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($skus as $data)
                                
                            <tr>
                              
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{ $data->primaryImage ? asset('uploads/products/'.$data->primaryImage->image) : URL::asset('/assets/img/product/product1.jpg')}}" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">{{$data->name}}</a>
                                </td>
                                <td>{{$data->sku}}</td>
                                <td>{{$data->regular_price}}</td>
                                <td>{{$data->wholesale_regular_price}}</td>
                                <td>{{$data->discount}} @if(!empty($data->discount_type))({{$data->discount_type == 1 ? 'F' : 'P'}})@endif</td>
                                <td>{{$data->wholesale_discount}} @if(!empty($data->wholesale_discount_type))({{$data->wholesale_discount_type == 1 ? 'F' : 'P'}})@endif</td>

                                <td>
                                  
                                    <a class="me-3" href="{{route('admin.sku.edit',[$product_id,$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    <a class="confirm-text" href="javascript:void(0);">
                                        <img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="img">
                                    </a>
                                </td>
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