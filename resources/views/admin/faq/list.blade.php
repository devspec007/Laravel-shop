<?php $page="faqlist";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') FAQ List @endslot
			@slot('title_1') Manage your FAQ @endslot
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
                        {{-- <div class="search-input">
                            <a class="btn btn-searchset"><img src="{{ URL::asset('/assets/img/icons/search-white.svg')}}" alt="img"></a>
                        </div> --}}
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a href="{{route('admin.faqs.create')}}" class="btn btn-sm btn-primary">{{__('Add New')}}</a>
                            </li>
                           {{--  <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{ URL::asset('/assets/img/icons/excel.svg')}}" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{ URL::asset('/assets/img/icons/printer.svg')}}" alt="img"></a>
                            </li>--}}
                        </ul>
                    </div> 
                </div>
                <!-- /Filter -->
               
                <!-- /Filter -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                
                                <th>{{__('Question')}}</th>
                                {{-- @if (auth()->user()->can('faqs-delete') || auth()->user()->can('faqs-edit')) --}}

                                <th>Action</th>
                                {{-- @endif --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faqs as $data)
                            <tr>
                               
                              
                                <td>
                                    <a href="javascript:void(0);">{{$data->question}}</a>

                                </td>
                                {{-- @if (auth()->user()->can('faqs-delete') || auth()->user()->can('faqs-edit')) --}}
                                
                                <td>
                                    <a class="me-3" href="{{route('admin.faqs.edit',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    <a class="me-3 confirm-text"  data-href="{{route('admin.faqs.destroy',[$data->id])}}">
                                        <img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="img">
                                    </a>
                                </td>
                                {{-- @endif --}}
                            </tr>
                                @endforeach
                               
                            
                        </tbody>
                    </table>
                    {{ $faqs->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection