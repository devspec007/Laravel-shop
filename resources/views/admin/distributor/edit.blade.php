<?php $page="editdistributor";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Distributor Management @endslot
			@slot('title_1') Edit/Update Distributor @endslot
		@endcomponent
        <!-- /add -->
        <form action="{{route('admin.distributor.update',[$user->id])}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Distributor Name</label>
                                <input type="text" name="name" value="{{$user->name}}">
                                <div class="text-danger form-error" id="name_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}">
                                <div class="text-danger form-error" id="email_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="contact" value="{{$user->contact}}">
                                <div class="text-danger form-error" id="contact_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>commission per order</label>
                                <input type="text" name="commission" value="{{$user->profile ? $user->profile->commission : ''}}">
                                <div class="text-danger form-error" id="commission_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Choose State</label>
                                <select class="select filter-state-city" name="state">
                                    <option value="">Choose State</option>
                                    @foreach ($states as $state)
                                        <option value="{{$state->id}}" {{$user->profile && ($user->profile->state_id == $state->id) ? 'selected' : ''}}>{{$state->name}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="state_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>City</label>
                                <select  name="city" class="select state-city-list">
                                    <option value="">Choose City</option>
                                    @if ($user->profile && $user->profile->state)
                                        @foreach ($user->profile->state->child as $city)
                                            <option value="{{$city->id}}" {{$user->profile && ($user->profile->city_id == $city->id) ? 'selected' : ''}}>{{$city->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="text-danger form-error" id="city_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select type="text" name="status" class="form-control">
                                    <option value="active" {{$user->status == 'active' ? 'selected' : ''}}>Active</option>
                                    <option value="inactive"  {{$user->status == 'inactive' ? 'selected' : ''}}>Inactive</option>

                                </select>
                                <div class="text-danger form-error" id="status_error"></div>
                        
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password">
                                <div class="text-danger form-error" id="password_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" value="{{$user->profile ? $user->profile->address : ''}}">
                                <div class="text-danger form-error" id="address_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description">{{$user->profile ? $user->profile->description : ''}}</textarea>
                                <div class="text-danger form-error" id="description_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>	Profile Image</label>
                                <div class="image-upload">
                                    <input type="file" name="image" class="dropify" data-default-file="{{$user->profile ? asset($user->profile->image) : ''}}">
                                    
                                </div>
                                <div class="text-danger form-error" id="image_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('admin.store.index')}}"  class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /add -->
    </div>
</div>
@endsection