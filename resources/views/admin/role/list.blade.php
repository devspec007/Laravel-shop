<?php $page="brandlist";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Role List @endslot
			@slot('title_1') Manage your Role @endslot
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
                                <a href="{{route('admin.role.create')}}">Add</a>
                            </li>
                           
                        </ul>
                    </div>
                </div>
                <!-- /Filter -->
              
                <!-- /Filter -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                
                                <th>Name</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $data)
                            <tr>
                               
                                <td>
                                    <a href="javascript:void(0);">{{$data->name}}</a>

                                </td>
                                <td><a href="{{route('admin.permission.index',[$data->id])}}">Permissions</a></td>

                                <td>
                                    <a class="me-3" href="{{route('admin.role.edit',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    <a class="me-3 confirm-text delete-btn" data-href="{{route('admin.role.destroy',[$data->id])}}">
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