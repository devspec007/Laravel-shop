<?php $page="userlist";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') User List @endslot
			@slot('title_1') Manage your User @endslot
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
                            <a class="btn btn-searchset">
                                <img src="{{ URL::asset('/assets/img/icons/search-white.svg')}}" alt="img">
                            </a>
                        </div>
                    </div>
                    <div class="wordset">
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
                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                               
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Customer Name" name="name" value="{{$request->name}}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Phone Number" name="contact" value="{{$request->contact}}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Email" name="email" value="{{$request->email}}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="status">
                                            <option value="">Choose Status</option>
                                            <option value="active" @if(isset($request->status) && $request->status == 'active') selected @endif>Active</option>
                                            <option value="active" @if(isset($request->status) && $request->status == 'inactive') selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-6 col-12  ms-auto">
                                    <div class="form-group">
                                        <button class="btn btn-filters ms-auto"><img src="{{ URL::asset('/assets/img/icons/search-whites.svg')}}" alt="img"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /Filter -->
                <div class="table-responsive">
                    <table class="table  datanew1">
                        <thead>
                            <tr>
                    
                                <th>Name</th>
                                <th>Phone</th>
                                <th>email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $data)
                            <tr>
                                <td class="productimgname">
                                    <a href="javascript:void(0);">{{$data->name}}</a>
                                </td>
                                <!-- {{-- <td>201</td> --}} -->
                                <td>{{$data->contact}}</td>
                                <td>{{$data->email}}</td>
                                <td><span class="{{strtolower($data->status) == 'active' ? 'text-success' : 'text-danger'}}">{{$data->status}}</span></td>
                                <td>

                                    <a class="me-3" href="{{route('admin.user.edit',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    <a class="me-3 confirm-text" data-href="{{route('admin.user.delete',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="img">
                                    </a> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@component('components.modal-popup')                
@endcomponent
@endsection