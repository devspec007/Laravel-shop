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
                                <div class="card">
                                    <div class="card-header">
                                        <h5>New Address</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="{{route('frontend.customer.address.store')}}" class="login-form">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Name <span class="required">*</span></label>
                                                    <input class="form-control square" name="name" type="text">
                                                    <span class="text-danger form-error name_error">

                                                </div>
                                              
                                                <div class="form-group col-md-6">
                                                    <label>Phone No. <span class="required">*</span></label>
                                                    <input class="form-control square" name="phone_no" type="text">
                                                    <span class=" text-danger form-error phone_no_error">
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Choose State</label>
                                                        <select class="form-control square filter-state-city" name="state">
                                                            <option>Choose State</option>
                                                            @foreach($states as $state)
                                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="text-danger form-error state_error"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <select class="form-control square state-city-list" name="city">
                                                            <option>Choose City</option>
                        
                                                        </select>
                                                        <div class="text-danger form-error city_error"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Pincode</label>
                                                        <input type="text" class="form-control square" name="pincode">
                                                        <div class="text-danger form-error pincode_error"></div>

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Area</label>
                                                        <input type="text" class="form-control square" name="area">
                                                        <div class="text-danger form-error area_error"></div>

                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control square" name="address">
                                                        <div class="text-danger form-error address_error"></div>

                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-fill-out submit" name="submit" value="Submit">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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