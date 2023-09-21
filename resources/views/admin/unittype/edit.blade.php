<?php $page="addbrand";?>
@extends('layout.mainlayout')
@section('content')		
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Department Edit @endslot
			@slot('title_1') Update Department @endslot
		@endcomponent
        <!-- /add -->
        <form action="{{route('admin.department.update', [$department->id])}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Department Name</label>
                                <input type="text" name="name" value="{{$department->name}}">
                                <div class="text-danger form-error" id="name_error"></div>

                            </div>
                        </div>
                        
                        

                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select type="text" name="status" class="form-control">
                                    <option value="active" {{$department->status == 'active' ? 'selected' : ''}}>Active</option>
                                    <option value="inactive"  {{$department->status == 'inactive' ? 'selected' : ''}}>Inactive</option>

                                </select>
                                <div class="text-danger form-error" id="status_error"></div>
                        
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
	  