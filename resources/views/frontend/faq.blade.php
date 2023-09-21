@extends('frontend.layout.layout')
@section('content')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="/" rel="nofollow">Home</a>
            <span></span> FAQ
        </div>
    </div>
</div>
<section class="section-padding">
    <div class="container pt-25">
        <div class="row">
            <div class="col-lg-12 align-self-center mb-lg-0 mb-4">
                <div class="card-wrapper  | content-cc">
                    <div class="faq-card">
                  
                      
                  
                      <main class="faq-content">
                        <h1>FAQ</h1>
                  
                        <div class="faq-articles">
                        @foreach ($faqs as $key => $faq)
                            
                        <article class="faq-accordion">
                
                          <input type="checkbox" class="tgg-title" id="tgg-title-{{$key}}">
                
                          <div class="faq-accordion-title">
                            <label for="tgg-title-{{$key}}">
                              <h2><strong>{{$faq->question}}</strong></h2>
                              <span class="arrow-icon">
                                <img src="{{asset('frontend/assets/imgs/icon-arrow-down.svg')}}">
                              </span>
                            </label>
                          </div>
                
                          <div class="faq-accordion-content">
                            {!! $faq->answer !!}
                          </div>
                
                        </article> 
                        @endforeach
                  
                  
                        </div> <!-- faq articles -->
                  
                      </main> <!-- faq -->
                  
                    </div> <!-- faq card -->
                  
                  </div> <!-- card wrapper -->
              
            </div>
          
        </div>
    </div>
</section>

@endsection