<?php $page="brandlist";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Brand List @endslot
			@slot('title_1') Manage your Brand @endslot
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
                                <form action="{{route('admin.brand.import')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" class="">
                                    <button type="submit" name="btn btn-sm btn-primary">Import</button>
                                <a class="btn btn-submit w-100" href="{{asset('sample/brand-sample.xlsx')}}" target="blank">Download Sample File</a>

                                </form>
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
               <form action="" class="filter" id="filter-data">

                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Brand Name" name="brand_name" value="{{$request->brand_name}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Brand Description" name="description"{{$request->description}}>
                                    </div>
                                </div>
                                
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="status">
                                            <option value="">Select Status</option>
                                            <option value="active" {{$request->status == 'active' ? 'selected' : ''}}>Active</option>
                                            <option value="inactive" {{$request->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
    
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-filters ms-auto"><img src="{{ URL::asset('/assets/img/icons/search-whites.svg')}}" alt="img"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               </form>  
                <!-- /Filter -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                
                                <th>Image</th>
                                <th>Brand Name</th>
                                <th>Status</th>
                                <th>Parent</th>
                                {{-- @if (auth()->user()->can('brand-delete') || auth()->user()->can('brand-edit')) --}}

                                <th>Action</th>
                                {{-- @endif --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $data)
                            <tr>
                               
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{asset($data->image)}}" alt="product">
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:void(0);">{{$data->name}}</a>

                                </td>
                                <td><span class="{{strtolower($data->status) == 'active' ? 'text-success' : 'text-danger'}}">{{$data->status}}</span></td>

                                <td>{{$data->parent ? $data->parent->name : ''}}</td>
                                {{-- @if (auth()->user()->can('brand-delete') || auth()->user()->can('brand-edit')) --}}
                                <td>
                                    {{-- @if (auth()->user()->can('brand-edit')) --}}
                                    <a class="me-3" href="{{route('admin.brand.edit',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    {{-- @endif --}}
                                    {{-- @if (auth()->user()->can('brand-delete')) --}}

                                    <a class="me-3 confirm-text delete-btn" data-href="{{route('admin.brand.delete',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="img">
                                    </a>
                                    {{-- @endif --}}
                                </td>
                                {{-- @endif --}}
                            </tr>
                                @endforeach
                               
                            
                        </tbody>
                    </table>
                    {{ $brands->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection