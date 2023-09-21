<?php $page="addbanners";?>
@extends('layout.mainlayout')
@section('content')		
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Banner ADD @endslot
			@slot('title_1') Create new Banner @endslot
		@endcomponent
        <!-- /add -->
        <form action="{{route('admin.banners.store')}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Alt Tag</label>
                                <input type="text" name="alt_tag">
                                <div class="text-danger form-error" id="alt_tag_error"></div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Banner Type</label>
                                <select type="text" class="form-control" name="type">
                                    @foreach (bannerType() as $key=>$item)
                                        <option value="{{$key}}">{{$item['name']}}</option>
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
                                        <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="section_error"></div>

                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Redirect To</label>
                                <input type="text" name="url" >
                                <div class="text-danger form-error" id="url_error"></div>

                            </div>
                        </div>
                      
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>	Banner</label>
                                <div class="image-upload">
                                    <input type="file" name="image" class="dropify">
                                    
                                </div>
                                <div class="text-danger form-error" id="image_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submut" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('admin.banners.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /add -->
    </div>
</div>		
@endsection
	  