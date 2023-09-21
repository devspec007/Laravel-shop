@extends('frontend.layout.layout')
@section('content')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow">Home</a>
            <span></span> Pages
            <span></span> Account
        </div>
    </div>
</div>
<section class="pt-150 pb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="row">
                    @include('frontend.customer.sidebar')
                    <div class="col-md-8">
                        <div class="tab-content dashboard-content">
                           
                           
                          
                            <div class="tab-pane fade active show" id="address" role="tabpanel" aria-labelledby="address-tab">
                                <a href="{{route('frontend.customer.address.create')}}">Add New Address</a>
                                <div class="row">
                                    @foreach ($addresses as $data)
                                        
                                    <div class="col-lg-6">
                                        <div class="card mb-3 mb-lg-0">
                                            <div class="card-header">
                                                <h5 class="mb-0">Billing Address</h5>
                                            </div>
                                            <div class="card-body">
                                                <address>{{$data->address}}<br> {{$data->area}} {{$data->pincode}}</address>
                                                <p>{{$data->state->name ?? ''}} {{$data->city->name ?? ''}}</p>
                                                <a href="{{route('frontend.customer.address.edit',[$data->id])}}" class="btn-small">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                 
                                </div>
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection