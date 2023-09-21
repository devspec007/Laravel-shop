<?php $page="addbanners";?>
@extends('layout.mainlayout')
@section('content')		
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Banner Edit @endslot
			@slot('title_1') Update Banner @endslot
		@endcomponent
        <!-- /add -->
        <form action="{{route('admin.banners.update', [$banner->id])}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Alt Tag</label>
                                <input type="text" name="alt_tag" value="{{$banner->alt_tag}}">
                                <div class="text-danger form-error" id="alt_tag_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Redirect To</label>
                                <input type="text" name="url" value="{{$banner->url}}">
                                <div class="text-danger form-error" id="url_error"></div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Banner Type</label>
                                <select type="text" class="form-control" name="type">
                                    @foreach (bannerType() as $key=>$item)
                                        <option value="{{$key}}" {{$banner->type == $key ? 'selected' : ''}}>{{$item['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="type_error"></div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Banner Section</label>
                                <select type="text" class="form-control" name="section">
                                    @foreach (bannerSection() as $key=>$item)
                                        <option value="{{$key}}" {{$banner->section == $key ? 'selected' : ''}}>{{$item}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="section_error"></div>

                            </div>
                        </div>
                        
                      
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select type="text" name="status" class="form-control">
                                    <option value="active" {{$banner->status == 'active' ? 'selected' : ''}}>Active</option>
                                    <option value="inactive"  {{$banner->status == 'inactive' ? 'selected' : ''}}>Inactive</option>

                                </select>
                                <div class="text-danger form-error" id="status_error"></div>
                        
                            </div>
                        </div>
                       
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>	Banner</label>
                                <div class="image-upload">
                                    <input type="file" name="image" class="dropify"  data-default-file="{{asset($banner->banner)}}">
                                    
                                </div>
                                <div class="text-danger form-error" id="image_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submut" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('admin.brand.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /add -->
    </div>
</div>		
@endsection
	  