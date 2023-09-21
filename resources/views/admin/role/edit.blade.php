<?php $page="addbrand";?>
@extends('layout.mainlayout')
@section('content')		
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Role Edit @endslot
			@slot('title_1') Update Role @endslot
		@endcomponent
        <!-- /add -->
        <form action="{{route('admin.role.update', [$role->id])}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{$role->name}}">
                                <div class="text-danger form-error" id="name_error"></div>

                            </div>
                        </div>
                        @foreach ($permissions as $item)
                            
                        <div class="row">
                            <div class="col-md-2"><strong>{{$item->lable}}</strong></div>
                        <div class="col md-10">
                            @php
                            $child_permissions = Spatie\Permission\Models\Permission::where('parent_id', $item->id)->get();
                            @endphp
                            <ul style="display: flex;">

                                @foreach ($child_permissions as $cp)
                                    <li style="padding:10px"><input {{in_array($cp->id,$aPermission) ? 'checked' : ''}} type="checkbox" name="permission" value="{{$cp->id}}">{{$cp->lable}}</li>
                                @endforeach
                            </ul>
                        </div>
                        </div>
                        @endforeach
                        
                        

                        
                        
                        
                        
                        <div class="col-lg-12 mt-5">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('admin.role.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /add -->
    </div>
</div>		
@endsection
	  