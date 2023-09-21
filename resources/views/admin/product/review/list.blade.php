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
                <form action="" class="filter d-none" id="filter-data">
                <div class="card mb-0" id="filter_inputs">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg col-sm-6 col-12">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="search by name" name="search" value="">
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Rating </th>
                                <th>Comment</th>
                              
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $data)
                                
                                <tr>
                                    <td>@php
                                        print_r(json_encode($data->product_id));
                                    @endphp</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->rating}}</td>
                                    <td>{{$data->comment}}</td>
                                    <td>{{Carbon\Carbon::parse($data->created_at)->format('M d, Y')}} at {{Carbon\Carbon::parse($data->created_at)->format('g:i A')}}</td>


                                </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection