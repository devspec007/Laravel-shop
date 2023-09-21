<?php $page="addfaq";?>
@extends('layout.mainlayout')
@section('content')		
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') FAQ ADD @endslot
			@slot('title_1') Create new FAQ @endslot
		@endcomponent
        <!-- /add -->
        <form action="{{route('admin.faqs.store')}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>{{__('Question')}}</label>
                                <textarea class="form-control" name="question"></textarea>
                                <div class="text-danger form-error" id="question_error"></div>

                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>{{__('Answer')}}</label>
                                <textarea class="form-control" name="answer"></textarea>
                                <div class="text-danger form-error" id="answer_error"></div>

                            </div>
                        </div>
                        
                        
                        <div class="col-lg-12">
                            <button type="submut" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('admin.faqs.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /add -->
    </div>
</div>		
@endsection
@section('scripts')
    <script>
       CKEDITOR.replace( 'answer' );

        </script>
@endsection
	  