<?php $page="addbrand";?>
@extends('layout.mainlayout')
@section('content')		
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Expense Category Edit @endslot
			@slot('title_1') Update Expense Category @endslot
		@endcomponent
        <!-- /add -->
        <form action="{{route('admin.expense-category.update', [$category->id])}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="name" value="{{$category->name}}">
                                <div class="text-danger form-error" id="name_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select type="text" name="status" class="form-control">
                                    <option value="active" {{$category->status == 'active' ? 'selected' : ''}}>Active</option>
                                    <option value="inactive"  {{$category->status == 'inactive' ? 'selected' : ''}}>Inactive</option>

                                </select>
                                <div class="text-danger form-error" id="status_error"></div>
                        
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description">{{$category->description}}</textarea>
                                <div class="text-danger form-error" id="drescription_error"></div>

                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>	Product Image</label>
                                <div class="image-upload">
                                    <input type="file" name="image" class="dropify"  data-default-file="{{asset($category->image)}}">
                                    
                                </div>
                                <div class="text-danger form-error" id="image_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submut" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('admin.expense-category.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /add -->
    </div>
</div>		
@endsection
	  