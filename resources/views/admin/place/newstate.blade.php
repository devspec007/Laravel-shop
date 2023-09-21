<?php $page="newstate";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Places Management @endslot
			@slot('title_1') Add/Update Places @endslot
		@endcomponent
        <!-- /add -->
        <form action="{{route('admin.state.store')}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>State Name</label>
                                <input type="text" name="name">
                                <div class="text-danger form-error" id="name_error"></div>
                            </div>
                        </div>
                        
                        
                        <div class="col-lg-12">
                            <button class="btn btn-submit me-2" type="submit">Submit</button>
                            <a href="{{route('admin.state.index')}}"  class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /add -->
    </div>
</div>
@endsection