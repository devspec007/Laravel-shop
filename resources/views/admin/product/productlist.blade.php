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
                            <li><a href="{{route('admin.multiple-products')}}">Add Multiple Products</a></li>
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
                    <table class="table ">
                        <thead>
                            <tr>
                                {{-- <th>
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th> --}}
                                <th>Product Name</th>
                                {{-- <th>SKU</th> --}}
                                <th>Category </th>
                                <th>Brand</th>
                                {{-- <th>price</th>
                                <th>Unit</th>
                                <th>Qty</th> --}}
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $data)
                                
                            <tr>
                                {{-- <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td> --}}
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{ $data->primaryImage ? asset('uploads/products/'.$data->primaryImage->image) : URL::asset('/assets/img/product/product1.jpg')}}" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">{{$data->name}} ({{$data->product_type}})</a>
                                </td>
                                {{-- <td>PT001</td> --}}
                                <td>{{$data->category->name ?? ''}}</td>
                                <td>{{$data->brand->name ?? ''}}</td>
                                {{-- <td>1500.00</td>
                                <td>pc</td>
                                <td>100.00</td> --}}
                                <td>{{$data->user->name ?? ''}}</td>
                                <td>
                                    <a class="me-3" href="{{route('admin.sku.index',[$data->id])}}">
                                        SKU
                                    </a>

                                    <a class="me-3" href="{{route('admin.product-inventory',[$data->id])}}">
                                        I
                                    </a>
                                    
                                    {{-- <a class="me-3" href="{{route('admin.product.show',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/eye.svg')}}" alt="img">
                                    </a> --}}
                                    {{-- @if (auth()->user()->can('product-edit')) --}}

                                    <a class="me-3" href="{{route('admin.product.edit',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    {{-- @endif --}}
                                    @if (auth()->user()->can('product-delete'))
                                    <a class="confirm-text" href="javascript:void(0);">
                                        <img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="img">
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection