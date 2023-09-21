<?php $page="categorylist";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
            @slot('title') Product Category list @endslot
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
               <form action="" class="filter" id="filter-data">
                <div class="card" id="filter_inputs">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search by category name and code"  value="{{$request->search}}">
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
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select" class="parent">
                                        <option value="">Choose Category</option>
                                        @foreach ($parent_categories as $p_category)
                                            <option value="{{$p_category->id}}" {{isset($request->parent) && $request->parent == $p_category->id ? 'selected' : ''}}>{{$p_category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select" class="parent">
                                        <option value="">Choose Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{$department->id}}" {{isset($request->department) && $request->department == $department->id ? 'selected' : ''}}>{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Category</option>
                                        <option>Computers</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Sub Category</option>
                                        <option>Fruits</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Sub Brand</option>
                                        <option>Iphone</option>
                                    </select>
                                </div>
                            </div> --}}
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
                    <table class="table  ">
                        <thead>
                            <tr>
                                {{-- <th>
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th> --}}
                                <th>Category name</th>
                                <th>Category Code</th>
                                <th>Department</th>
                                <th>Parent Category</th>
                                <th>Description</th>
                                <th>Created By</th>
                                {{-- @if (auth()->user()->can('category-delete') || auth()->user()->can('category-edit')) --}}

                                <th>Action</th>
                                {{-- @endif --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $data)
                            <tr>
                                {{-- <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td> --}}
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{asset($data->image)}}" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">{{$data->name}}</a>
                                </td>
                                <td>{{$data->code}}</td>
                                <td>{{$data->department->name ?? ''}}</td>
                                <td>{{$data->parentCategory->name ?? ''}}</td>
                                <td>{{$data->description}}</td>
                                <td>{{$data->user->name ?? ''}}</td>
                                {{-- @if (auth()->user()->can('category-delete') || auth()->user()->can('category-edit')) --}}

                                <td>
                                    {{-- @if (auth()->user()->can('category-edit')) --}}
                                    <a class="me-3" href="{{route('admin.category.edit',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    {{-- @endif
                                    @if (auth()->user()->can('category-delete')) --}}

                                    <a class="me-3 confirm-text" data-href="{{route('admin.category.delete',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="img">
                                    </a>
                                    {{-- @endif --}}
                                </td>
                                {{-- @endif --}}
                            </tr>
                                @endforeach
                               
                            
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection