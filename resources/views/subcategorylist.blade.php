<?php $page="subcategorylist";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Product Sub Category list @endslot
			@slot('title_1') View/Search product Category @endslot
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
                    {{-- <div class="wordset">
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
                    </div> --}}
                </div>
                <!-- /Filter -->
                <div class="card" id="filter_inputs">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Search</label>

                                    <input type="text" name="search" class="form-control" placeholder="Search by category name and code"  value="{{$request->search}}">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Status</label>

                                    <select class="select" name="status">
                                        <option value="">Select Status</option>
                                        <option value="active" {{$request->status == 'active' ? 'selected' : ''}}>Active</option>
                                        <option value="inactive" {{$request->status == 'inactive' ? 'selected' : ''}}>Inactive</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="select" class="parent">
                                        <option value="">Choose Category</option>
                                        @foreach ($parent_categories as $p_category)
                                            <option value="{{$p_category->id}}">{{$p_category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Sub Category</label>
                                    <select class="select">
                                        <option>Choose Sub Category</option>
                                        <option>Fruits</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Category Code</label>
                                    <select class="select">
                                        <option>CT001</option>
                                        <option>CT002</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <a class="btn btn-filters ms-auto"><img src="{{ URL::asset('/assets/img/icons/search-whites.svg')}}" alt="img"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Filter -->
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                            <tr>
                             
                                <th>Image</th>
                                <th>Category</th>
                                <th>Parent category</th>
                                <th>Category Code</th>
                                <th>Description</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $data)
                            <tr>
                               
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{asset($data->image)}}" alt="product">
                                    </a>
                                 
                                </td>
                                <td>   <a href="javascript:void(0);">{{$data->name}}</a></td>
                                <td>{{$data->parentCategory->name ?? ''}}</td>
                                <td>{{$data->code}}</td>
                                <td>{{$data->description}}</td>
                                <td>{{$data->user->name ?? ''}}</td>
                                <td>
                                    <a class="me-3" href="{{route('admin.sub-category.edit',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    <a class="me-3 confirm-text"  data-href="{{route('admin.sub-category.delete',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="img">
                                    </a>
                                </td>
                            </tr>
                                @endforeach
                               
                        </tbody>
                    </table>
                </div>
                {{ $categories->links() }}
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection