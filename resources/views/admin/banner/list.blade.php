<?php $page="bannerlist";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Banner List @endslot
			@slot('title_1') Manage your Banner @endslot
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
                                <a class="btn btn-sm btn-primary" href="{{route('admin.banners.create')}}">Add Banner</a>

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

                  
               </form>  
                <!-- /Filter -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                
                                <th>Image</th>
                                <th>Alt Tag</th>
                                <th>Type</th>

                                <th>Status</th>
                                {{-- @if (auth()->user()->can('banner-delete') || auth()->user()->can('banner-edit')) --}}

                                <th>Action</th>
                                {{-- @endif --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $data)
                            <tr>
                               
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{asset($data->banner)}}" alt="product">
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:void(0);">{{$data->alt_tag}}</a>

                                </td>
                                <td>{{$data->type}}</td>
                                <td><span class="{{strtolower($data->status) == 'active' ? 'text-success' : 'text-danger'}}">{{$data->status}}</span></td>

                                {{-- @if (auth()->user()->can('banner-delete') || auth()->user()->can('banner-edit')) --}}
                                <td>
                                    {{-- @if (auth()->user()->can('banner-edit')) --}}
                                    <a class="me-3" href="{{route('admin.banners.edit',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    {{-- @endif --}}
                                    {{-- @if (auth()->user()->can('banner-delete')) --}}

                                    <a class="me-3 confirm-text delete-btn" data-href="{{route('admin.banners.destroy',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="img">
                                    </a>
                                    {{-- @endif --}}
                                </td>
                                {{-- @endif --}}
                            </tr>
                                @endforeach
                               
                            
                        </tbody>
                    </table>
                    {{ $banners->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection