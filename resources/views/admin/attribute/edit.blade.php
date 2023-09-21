<?php $page="addbrand";?>
@extends('layout.mainlayout')
@section('content')		
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Attribute Edit @endslot
			@slot('title_1') Update Attribute @endslot
		@endcomponent
        <!-- /add -->
        <form action="{{route('admin.attribute.update',[$attribute->id])}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Lable</label>
                                <input type="text" name="lable" value="{{$attribute->lable}}">
                                <div class="text-danger form-error" id="lable_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select type="text" name="status" class="form-control">
                                    <option value="active" {{$attribute->status == 'active' ? 'selected' : ''}}>Active</option>
                                    <option value="inactive"  {{$attribute->status == 'inactive' ? 'selected' : ''}}>Inactive</option>

                                </select>
                                <div class="text-danger form-error" id="name_error"></div>
                        
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Values (, separation)</label>
                                <textarea class="form-control" name="options">{{$attribute->options}}</textarea>
                                <div class="text-danger form-error" id="options_error"></div>

                            </div>
                        </div>
                        
                        
                        <div class="col-lg-12">
                            <button type="submut" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('admin.attribute.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /add -->
    </div>
</div>		
@endsection
	  