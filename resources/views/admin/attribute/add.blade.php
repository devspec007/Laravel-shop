<?php $page="addbrand";?>
@extends('layout.mainlayout')
@section('content')		
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Attribute ADD @endslot
			@slot('title_1') Create new Attribute @endslot
		@endcomponent
        <!-- /add -->
        <form action="{{route('admin.attribute.store')}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Lable</label>
                                <input type="text" name="lable">
                                <div class="text-danger form-error" id="lable_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Values (, separation)</label>
                                <textarea class="form-control" name="options"></textarea>
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
	  