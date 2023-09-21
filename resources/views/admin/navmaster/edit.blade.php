<?php $page="addbrand";?>
@extends('layout.mainlayout')
@section('content')		
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Menu Edit @endslot
			@slot('title_1') Update Menu @endslot
		@endcomponent
        <!-- /add -->
        <form action="{{route('admin.menus.update', [$menu->id])}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{$menu->name}}">
                                <div class="text-danger form-error" id="name_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Icon</label>
                                <input type="text" name="icons" value="{{$menu->icons}}">
                                <div class="text-danger form-error" id="icons_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Path</label>
                                <input type="text" name="path" value="{{$menu->path}}">
                                <div class="text-danger form-error" id="path_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Parent</label>
                                <select type="text" class="form-control" name="parent_id">
                                    <option value="0">Parent</option>
                                    @foreach ($menus as $data)
                                        <option value="{{$data->id}}" {{$data->id == $menu->parent_id ? 'selected' : ''}}>{{$data->name}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="parent_id_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Permissions</label>
                                <textarea type="text" name="permissions">{{$menu->permissions}}</textarea>
                                <div class="text-danger form-error" id="permissions_error"></div>

                            </div>
                        </div>
                        
                        
                        
                        
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('admin.department.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /add -->
    </div>
</div>		
@endsection
	  