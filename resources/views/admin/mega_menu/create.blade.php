<?php $page="frontendmenu";?>
@extends('layout.mainlayout')
<style>
	.none{
		display:none;
	}
	</style>

@section('content')
<div class="page-wrapper">
    <div class="content">
		<div class="row" id="category_body">
			<div class="col-lg-4">      
				<div class="card">
					<div class="card-body">
						<div class="alert alert-danger none">
							<ul id="errors">
							</ul>
						</div>
						<div class="alert alert-success none">
							<ul id="success">
							</ul>
						</div>
						<form id="basicform" method="post" action="{{ route('admin.frontend-menu.store') }}">
							@csrf
							<div class="custom-form">
								<div class="form-group">
									<label for="name">{{ __('Menu Name') }}</label>
									<input type="text" name="name" class="form-control" id="name" placeholder="Menu Name">
								</div>
								<div class="form-group">
									<label for="position">{{ __('Menu Position') }}</label>
									<select class="form-control" id="position" name="position">
										@if(!empty($positions))
										
										@foreach($positions as $key=>$row)
										<option value="{{ $key }}">{{ $row }}</option>
										@endforeach
										@else
										<option value="header">{{ __('Header') }}</option>
										<option value="footer">{{ __('Footer') }}</option>
										@endif
									</select>
								</div>
								
								<div class="form-group">
									<label for="position">{{ __('Menu Status') }}</label>
									<select class="form-control" id="status" name="status">
										<option value="1">{{ __('Active') }}</option>
										<option value="0" selected="">{{ __('Draft') }}</option>
									</select>
								</div>
								<div class="form-group mt-20">
									<button class="btn btn-primary col-12" type="submit">{{ __('Add New Menu') }}</button>
								</div>
							</div>
						</form>
						
					</div>
				</div>
			</div>

			<div class="col-lg-8" >      
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<div class="card-action-filter">
								<form id="basicform1" method="post" action="{{ route('admin.frontend-menu.destroy') }}">
									@csrf
									<div class="card-filter-content d-flex">
										<div class="single-filter">
											<div class="form-group">
												<select class="form-control" name="method">
													<option >{{ __('Select Actions') }}</option>
													<option value="delete">{{ __('Delete Permanently') }}</option>
												</select>
											</div>
										</div>
										<div class="single-filter mt-1 ml-1">
											<button type="submit" class="btn btn-primary">{{ __('Apply') }}</button>
										</div>
									</div>
								</div>
								<div id="menuArea">
									<table class="table text-center category">
										<thead>
											<tr>
												<th class="am-select">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input checkAll" id="checkAll">
														<label class="custom-control-label" for="checkAll"></label>
													</div>
												</th>
												<th class="am-title">{{ __('Title') }}</th>
												<th class="am-title">{{ __('Postion') }}</th>
												<th class="am-title">{{ __('Status') }}</th>
												<th class="am-title">{{ __('Customize') }}</th>
												<th class="am-title">{{ __('Action') }}</th>

											</tr>
										</thead>
										<tbody>
											@foreach($menus as $menu)
											<td>

												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="ids[]" class="custom-control-input" id="customCheck{{ $menu->id }}" value="{{ $menu->id }}">
													<label class="custom-control-label" for="customCheck{{ $menu->id }}"></label>
												</div>
											</td>
											<td>{{ $menu->name }} </td>
											<td>{{ $menu->position }}</td>
											<td>@if($menu->status==1) <p class="badge badge-success">{{ __('Active Menu') }}</p> @else <p class="badge badge-danger">{{ __('Draft Menu') }}</p> @endif</td>
											
											<td><a href="{{ route('admin.frontend-menu.show',$menu->id) }}"><i class="fas fa-arrows-alt"></i> {{ __('Customize') }}</a></td>
											<td><a  class="text-success" href="{{ route('admin.frontend-menu.edit',$menu->id) }}" ><i class="far fa-edit"></i></a></td>
										</tr>
										@endforeach
									</tbody>
								</form>	
								<tfoot>
									<tr>
										<th class="am-select">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input checkAll" id="checkAll">
												<label class="custom-control-label" for="checkAll"></label>
											</div>
										</th>
										<th class="am-title">{{ __('Title') }}</th>
										<th class="am-author">{{ __('Postion') }}</th>
										<th class="am-author">{{ __('Status') }}</th>
										<th class="am-title">{{ __('Customize') }}</th>
										<th class="am-author">{{ __('Action') }}</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>	
<div>
	<h5>Upload Images</h5>
<form action="{{route('admin.frontend-menu.upload-media')}}" enctype="multipart/form-data" method="post">
	@csrf
	<input type="file" name="images[]" multiple>

	<button type="submit" class="btn btn-sm btn-primary">Upload</button>
	</form>	

	<table class="table">
		<tr>
			<th>#</th>
			<th>Image</th>
			<th>Path</th>
		</tr>
		@php
		$all_files = glob("uploads/media/*.*");
		  @endphp
@for ($i=0; $i<count($all_files); $i++)
<tr>
	<td>{{$i+1}}</td>
	<td>
 <img width="50" src="{{asset($all_files[$i])}}" alt="{{asset($all_files[$i])}}" />

	</td>
	<th>{{$all_files[$i]}}</th>

</tr>
 @endfor
 
		
	</table>

</div>	
	</div>
</div>		
@endsection
@push('js')
<script src="{{ asset('assets/js/backend/form.js') }}"></script>
<script src="{{ asset('assets/js/backend/admin_menu.js') }}"></script>
@endpush