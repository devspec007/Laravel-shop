<?php $page="salesreturnlist";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Sales Return List @endslot
			@slot('title_1') Manage your Returns @endslot
		@endcomponent
        @include('admin.supplier.add_pyament')
        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                
                <!-- /Filter -->
                {{-- <div class="card" id="filter_inputs">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" class="datetimepicker cal-icon" placeholder="Choose Date" >
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Reference">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Customer</option>
                                        <option>Customer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Status</option>
                                        <option>Inprogress</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Payment Status</option>
                                        <option>Payment Status</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <a class="btn btn-filters ms-auto"><img src="{{ URL::asset('/assets/img/icons/search-whites.svg')}}" alt="img"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- /Filter -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                {{-- <th>Reference</th> --}}
                                <th>Amount	</th>
                                <th>Paid By	</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $data)
                                
                                <tr class="bor-b1">
                                    <td>{{Carbon\Carbon::parse($data->transaction_date)->format('d M, Y')}}	</td>
                                    {{-- <td>INV/SL0101</td> --}}
                                    <td>{{$data->paid_amount}}	</td>
                                    <td>{{$data->payment_type}}</td>
                                    <td>{{$data->note}}</td>
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