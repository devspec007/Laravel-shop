@extends('frontend.layout.layout')
@section('content')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="/" rel="nofollow">Home</a>
            <span></span> {{$page->type}}
        </div>
    </div>
</div>
<section class="section-padding">
    <div class="container pt-25">
        <div class="row">
            <div class="col-lg-12 align-self-center mb-lg-0 mb-4">
               
                {!! $page->description !!}
            </div>
        
        </div>
    </div>
</section>

@endsection