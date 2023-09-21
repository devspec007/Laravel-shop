<?php $page = "adduser"; ?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')
        @slot('title') User Management @endslot
        @slot('title_1') Add/Update User @endslot
        @endcomponent
        <!-- /add -->
        <form action="{{route('admin.user.store')}}" method="post" class="submit-form" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name">
                            <div class="text-danger form-error" id="name_error"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Password</label>
                            <div class="pass-group">
                                <input type="password" class=" pass-input" name="password">
                                <div class="text-danger form-error" id="password_error"></div>
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="contact">
                            <div class="text-danger form-error" id="contact_error"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email">
                            <div class="text-danger form-error" id="email_error"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Role</label>
                            <select type="text" class="form-control" name="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>

                            <div class="text-danger form-error" id="role_id_error"></div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Role</label>
                            <select class="select">
                                <option>Select</option>
                                <option>Owner</option>
                            </select>
                        </div>
                    </div> -->
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>	Profile Image</label>
                            <div class="image-upload">
                                <input type="file" name="image" class="dropify">
                                
                            </div>
                            <div class="text-danger form-error" id="image_error"></div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2">Submit</button>
                        <a href="{{route('admin.user.index')}}" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /add -->
    </div>
</div>
@endsection