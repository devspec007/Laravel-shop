<?php $page="subaddcategory";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Product Add sub Category @endslot
			@slot('title_1') Create new product Category @endslot
		@endcomponent
        <!-- /add -->
        <form action="{{route('admin.sub-category.store')}}" method="post" class="submit-form" enctype="multipart/form-data">
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
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="parent_id_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="name">
                                <div class="text-danger form-error" id="name_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category Code</label>
                                <input type="text" name="code">
                                <div class="text-danger form-error" id="code_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description"></textarea>
                                <div class="text-danger form-error" id="description_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>	Product Image</label>
                                <div class="image-upload">
                                    <input type="file" name="image" class="dropify">
                                
                                </div>
                                <div class="text-danger form-error" id="image_error"></div>
                                @error('image')
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('admin.sub-category.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /add -->
    </div>
</div>
@endsection