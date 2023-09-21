<?php $page="addpage";?>
@extends('layout.mainlayout')
@section('content')		
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Page Edit @endslot
			@slot('title_1') Edit page @endslot
		@endcomponent
        <!-- /add -->
        @if(!empty($page_data)   )
       <form action="{{route('admin.pages.update',[$page_data->id])}}" method="post" class="submit-form" enctype="multipart/form-data">
        @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        
                       
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Page Name</label>
                                <input type="text" name="name" value="{{$page_data->type}}">
                                <div class="text-danger form-error" id="name_error"></div>
                             
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Url</label>
                                <input type="text" name="slug" value="{{$page_data->slug}}">
                                <div class="text-danger form-error" id="slug_error"></div>
                              
                            </div>
                        </div>

                       
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="page_description">{{$page_data->description}}</textarea>
                                <div class="text-danger form-error" id="page_description_error"></div>
                               
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input class="form-control" name="meta_title" value="{{$page_data->meta_title}}">
                                <div class="text-danger form-error" id="meta_title_error"></div>
                               
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Meta Keyword</label>
                                <textarea class="form-control" name="meta_keywords">{{$page_data->meta_keywords}}</textarea>
                                <div class="text-danger form-error" id="meta_keywords_error"></div>
                               
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea class="form-control" name="meta_description">{{$page_data->meta_description}}</textarea>
                                <div class="text-danger form-error" id="meta_description_error"></div>
                               
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label> Image</label>
                                <div class="image-upload">
                                    <input type="file" name="image" class="dropify" data-default-file="{{asset($page_data->image)}}">
                                    
                                </div>
                                <div class="text-danger form-error" id="image_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2 basicbtn">Update</button>
                            <a href="{{url('admin/pages')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
       </form>
       @endif
        <!-- /add -->
    </div>
</div>
@endsection
@section('scripts')
<script>
     CKEDITOR.replace( 'page_description' );
</script>
@endsection
  