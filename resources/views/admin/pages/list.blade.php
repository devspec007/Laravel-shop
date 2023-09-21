<?php $page="categorylist";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
            @slot('title') Page list @endslot
            @slot('title_1') Page @endslot
        @endcomponent
        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            {{-- <a class="btn btn-filter" id="filter_search">
                                <img src="{{ URL::asset('/assets/img/icons/filter.svg')}}" alt="img">
                                <span><img src="{{ URL::asset('/assets/img/icons/closes.svg')}}" alt="img"></span>
                            </a> --}}
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img src="{{ URL::asset('/assets/img/icons/search-white.svg')}}" alt="img"></a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a class="btn btn-sm btn-primary" href="{{route('admin.pages.create')}}">Add New Page</a>
                            </li>
                            {{-- <li>
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
                    <table class="table  ">
                        <thead>
                            <tr>
                                {{-- <th>
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th> --}}
                                <th>Title </th>
                                <th>Slug</th>
                                {{-- @if (auth()->user()->can('category-delete') || auth()->user()->can('category-edit')) --}}

                                <th>Action</th>
                                {{-- @endif --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $data)
                            <tr>
                              
                                <td>{{$data->type}}</td>
                                <td>{{$data->slug ?? ''}}</td>
                                
                                {{-- @if (auth()->user()->can('category-delete') || auth()->user()->can('category-edit')) --}}

                                <td>
                                    {{-- @if (auth()->user()->can('category-edit')) --}}
                                    <a class="me-3" href="{{route('admin.pages.edit',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    {{-- @endif
                                    @if (auth()->user()->can('category-delete')) --}}

                                    <a class="me-3 confirm-text" data-href="{{route('admin.pages.delete',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="img">
                                    </a>
                                    {{-- @endif --}}
                                </td>
                                {{-- @endif --}}
                            </tr>
                                @endforeach
                               
                            
                        </tbody>
                    </table>
                    {{ $pages->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection