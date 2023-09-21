<?php $page="addcategory";?>
@extends('layout.mainlayout')
@section('content')		
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Product Edit Category @endslot
			@slot('title_1') Edit product Category @endslot
		@endcomponent
        <!-- /add -->
       <form action="{{route('admin.category.update',[$category->id])}}" method="post" class="submit-form" enctype="multipart/form-data">
        @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Parent Category</label>
                                <select class="select" name="parent_id">
                                    <option value="">Choose Category</option>
                                    @foreach($categories as $data)
                                    <option value="{{$data->id}}" {{$category->p_id == $data->id ? 'selected' :''}}>{{$data->name}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="parent_id_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Department</label>
                                <select class="select" name="department">
                                    <option value="">Choose Department</option>
                                    @foreach($departments as $data)
                                    <option value="{{$data->id}}" {{$category->department_id == $data->id ? 'selected' :''}}>{{$data->name}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="department_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="name" value="{{$category->name}}">
                                <div class="text-danger form-error" id="name_error"></div>
                        
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category Code</label>
                                <input type="text" name="code" value="{{$category->code}}">
                                <div class="text-danger form-error" id="code_error"></div>
                             
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="col-form-label"><input type="checkbox" name="is_popular" {{$category->is_popular == 1 ? 'checked' : ''}}> :is_popular</label>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select type="text" name="status" class="form-control">
                                    <option value="active" {{$category->status == 'active' ? 'selected' : ''}}>Active</option>
                                    <option value="inactive"  {{$category->status == 'inactive' ? 'selected' : ''}}>Inactive</option>

                                </select>
                                <div class="text-danger form-error" id="name_error"></div>
                        
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description">{{$category->description}}</textarea>
                                <div class="text-danger form-error" id="description_error"></div>
                            
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label> Image</label>
                                <div class="image-upload">
                                    <input type="file" name="image" class="dropify" data-default-file="{{asset($category->image)}}">
                                    
                                </div>
                                <div class="text-danger form-error" id="image_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2 basicbtn">Submit</button>
                            <a href="{{url('admin/category')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
       </form>
        <!-- /add -->
    </div>
</div>
@endsection
	  