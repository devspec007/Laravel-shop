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
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<h4 class="mb-20">{{ __('Edit Menu') }}</h4>
						<div class="row">
							<div class="col-lg-12">
								<div class="alert alert-danger none errorarea">
									<ul id="errors">

									</ul>
								</div>
								<form method="post" id="basicform" action="{{ route('admin.frontend-menu.update',$info->id) }}">
									@csrf
									@method('PUT')
									<div class="custom-form">
										<div class="form-group">
											<label for="name">{{ __('Menu Name') }}</label>
											<input type="text" name="name" class="form-control" id="name" value="{{ $info->name }}">

										</div>
										<div class="form-group">
											<label for="position">{{ __('Menu Position') }}</label>
											<select class="custom-select mr-sm-2" id="position" name="position">
												@if(!empty($positions))

												@foreach($positions as $key=>$row)
												<option value="{{ $key }}" @if($info->position == $key) selected="" @endif>{{ $row }}</option>
												@endforeach
												@else
												<option value="header" @if($info->position=='header') selected="" @endif>{{ __('Header') }}</option>
												<option value="footer" @if($info->position=='footer') selected="" @endif>{{ __('Footer') }}</option>
												@endif
											</select>
											
										</div>
										
										<div class="form-group">
											<label for="position">{{ __('Menu Status') }}</label>
											<select class="custom-select mr-sm-2" id="status" name="status">
												<option value="1" @if($info->status==1) selected="" @endif>{{ __('Active') }}</option>
												<option value="0"  @if($info->status==0) selected="" @endif>{{ __('Draft') }}</option>
											</select>
										</div>

										<button class="btn  btn-primary col-12 mt-10">{{ __('Update') }}</button>
										<a class="btn  btn-primary col-12 mt-10" href="{{ route('admin.frontend-menu.index') }}">{{ __('Back') }}</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('assets/js/admin_menu.js') }}"></script>
{{-- <script  src="{{ asset('assets//js/iconset/fontawesome5-3-1.min.js') }}"></script> --}}
<script  src="{{ asset('assets/js/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js') }}"></script>
<script  src="{{ asset('assets/js/jquery-menu-editor.min.js') }}"></script>
<script src="{{ asset('assets/js/menu.js') }}"></script>
@endsection