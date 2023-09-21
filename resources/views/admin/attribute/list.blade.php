<?php $page="brandlist";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Attribute List @endslot
			@slot('title_1') Manage your Attribute @endslot
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
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Lable" name="search" value="{{$request->search}}">
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
                                
                                <th>Lable</th>
                                <th>Options</th>
                                <th>Status</th>
                                @if (auth()->user()->can('attribute-delete') || auth()->user()->can('attribute-edit'))

                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attributes as $data)
                            <tr>
                               
                              
                                <td>
                                    <a href="javascript:void(0);">{{$data->lable}}</a>

                                </td>
                                <td>{{$data->options}}</td>
                                <td><span class="{{strtolower($data->status) == 'active' ? 'text-success' : 'text-danger'}}">{{$data->status}}</span></td>
                                @if (auth()->user()->can('attribute-delete') || auth()->user()->can('attribute-edit'))
                                
                                <td>
                                    <a class="me-3" href="{{route('admin.attribute.edit',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    {{-- <a class="me-3 confirm-text" href="javascript:void(0);">
                                        <img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="img">
                                    </a> --}}
                                </td>
                                @endif
                            </tr>
                                @endforeach
                               
                            
                        </tbody>
                    </table>
                    {{ $attributes->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection