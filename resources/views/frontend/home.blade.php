@extends('frontend.layout.layout')
@section('content')
<style>
    .single-animation-wrap.slick-active .slider-animated-1 .single-slider-img img {
        bottom: 0px;
        position: unset;

    }
    
</style>
<section class="home-slider position-relative pt-502">
    <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
        @foreach ($banners as $banner)
            
        <div class="single-hero-slider single-animation-wrap">
            <div class="container1">
                <div class="row align-items-center slider-animated-1">
                    {{-- <div class="col-lg-5 col-md-6">
                        <div class="hero-slider-content-2">
                            <h4 class="animated">Trade-in offer</h4>
                            <h2 class="animated fw-900">Supper value deals</h2>
                            <h1 class="animated fw-900 text-brand">On all products</h1>
                            <p class="animated">Save more with coupons & up to 70% off</p>
                            <a class="animated btn btn-brush btn-brush-3" href="shop-product-right.html"> Shop Now </a>
                        </div>
                    </div> --}}
                    {{-- <div class="col-lg-7 col-md-12"> --}}
                        <div class="single-slider-img single-slider-img-1">
                            <a href="{{$banner->url}}">

                                <img class="animated slider-1-1" src="{{asset($banner->banner)}}" alt="{{$banner->alt_tag}}">
                            </a>
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <div class="slider-arrow hero-slider-1-arrow"></div>
</section>
<section class="featured section-padding position-relative">            
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                <div class="banner-features wow fadeIn animated hover-up">
                    <img src="{{('frontend/assets/imgs/theme/icons/feature-1.png')}}" alt="">
                    <h4 class="bg-1">Free Shipping</h4>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                <div class="banner-features wow fadeIn animated hover-up">
                    <img src="{{('frontend/assets/imgs/theme/icons/feature-2.png')}}" alt="">
                    <h4 class="bg-3">Online Order</h4>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                <div class="banner-features wow fadeIn animated hover-up">
                    <img src="{{('frontend/assets/imgs/theme/icons/feature-3.png')}}" alt="">
                    <h4 class="bg-2">Save Money</h4>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                <div class="banner-features wow fadeIn animated hover-up">
                    <img src="{{('frontend/assets/imgs/theme/icons/feature-4.png')}}" alt="">
                    <h4 class="bg-4">Promotions</h4>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                <div class="banner-features wow fadeIn animated hover-up">
                    <img src="{{('frontend/assets/imgs/theme/icons/feature-5.png')}}" alt="">
                    <h4 class="bg-5">Happy Sell</h4>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                <div class="banner-features wow fadeIn animated hover-up">
                    <img src="{{('frontend/assets/imgs/theme/icons/feature-6.png')}}" alt="">
                    <h4 class="bg-6">24/7 Support</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-tabs section-padding position-relative wow fadeIn animated">
    <div class="bg-square"></div>
    <div class="container">
        <div class="tab-header">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Featured</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two" type="button" role="tab" aria-controls="tab-two" aria-selected="false">Popular</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three" type="button" role="tab" aria-controls="tab-three" aria-selected="false">New Launch</button>
                </li>
            </ul>
            <a href="#" class="view-more d-none d-md-flex">View More<i class="fi-rs-angle-double-small-right"></i></a>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content wow fadeIn animated" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($featured_products as $item)
                    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                        
                        @include('frontend.component.product_card')
                    </div>
                    @endforeach
                </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab one (Featured)-->
            <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-two">
                <div class="row product-grid-4">
                    @foreach ($popular_products as $item)
                    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                        
                        @include('frontend.component.product_card')
                    </div>
                    @endforeach
                </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab two (Popular)-->
            <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="tab-three">
                <div class="row product-grid-4">
                    @foreach ($new_products as $item)
                    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                        
                        @include('frontend.component.product_card')
                    </div>
                    @endforeach
                    {{-- <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="hover-img" src="{{('frontend/assets/imgs/shop/product-3-1.jpg')}}" alt="">
                                        <img class="default-img" src="{{('frontend/assets/imgs/shop/product-3-2.jpg')}}" alt="">
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                    <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="new">New</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">Music</a>
                                </div>
                                <h2><a href="shop-product-right.html">Nullam dapibus pharetra</a></h2>
                                <div class="rating-result" title="90%">
                                    <span>
                                        <span>50%</span>
                                    </span>
                                </div>
                                <div class="product-price">
                                    <span>$138.85 </span>
                                    <span class="old-price">$255.8</span>
                                </div>
                                <div class="product-action-1 show">
                                    <a aria-label="Add To Cart" class="action-btn hover-up" href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                   
                </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab three (New added)-->
        </div>
        <!--End tab-content-->
    </div>
</section>
<section class="banner-2 section-padding pb-0">
    <div class="container">
        @foreach ($second_banners as $item)
                
            
            <div class="banner-img banner-big wow fadeIn animated f-none">
                <a href="{{$item->url}}">

                    <img class="box-shadow" src="{{asset($item->banner)}}" alt="">
                </a>
                {{-- <div class="banner-text d-md-block d-none">
                    <h4 class="mb-15 mt-40 text-brand">Repair Services</h4>
                    <h1 class="fw-600 mb-20">We're an Apple <br>Authorised Service Provider</h1>
                    <a href="shop-grid-right.html" class="btn">Learn More <i class="fi-rs-arrow-right"></i></a>
                </div> --}}
            </div>
            @endforeach

       
    </div>
</section>
<section class="popular-categories section-padding mt-15 mb-25">
    <div class="container wow fadeIn animated">
        <h3 class="section-title mb-20"><span>Popular</span> Categories</h3>
        <div class="carausel-6-columns-cover position-relative">
            <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
            <div class="carausel-6-columns" id="carausel-6-columns">
                @foreach ($popular_categories as $item)
                    
             @include('frontend.component.category_card')
                @endforeach
                
            </div>
        </div>
    </div>
</section>
<section class="banners mb-15">
    <div class="container">
        <div class="row">
            @foreach ($third_banners as $item)
                
            <div class="col-lg-6 col-md-6">
                <div class="banner-img wow fadeIn animated">
                    <a href="{{$item->url}}">

                        <img class="box-shadow" src="{{asset($item->banner)}}" alt="{{$item->alt}}">
                    </a>
                    
                </div>
            </div>
            @endforeach
          
        </div>
    </div>
</section>
<section class="section-padding">
    <div class="container wow fadeIn animated">
        <h3 class="section-title mb-20"><span>TOP</span> OFFERS</h3>
        <div class="carausel-6-columns-cover position-relative">
            <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows"></div>
            <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                @foreach ($offer_products as $item)
                    
                @include('frontend.component.product_card_2')
                
                @endforeach
            </div>
        </div>
    </div>
</section>
{{-- <section class="deals section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 deal-co">
                <div class="deal wow fadeIn animated mb-md-4 mb-sm-4 mb-lg-0" style="background-image: url('assets/imgs/banner/menu-banner-7.jpg');">
                    <div class="deal-top">
                        <h2 class="text-brand">Deal of the Day</h2>
                        <h5>Limited quantities.</h5>
                    </div>
                    <div class="deal-content">
                        <h6 class="product-title"><a href="shop-product-right.html">Summer Collection New Morden Design</a></h6>
                        <div class="product-price"><span class="new-price">$139.00</span><span class="old-price">$160.99</span></div>
                    </div>
                    <div class="deal-bottom">
                        <p>Hurry Up! Offer End In:</p>
                        <div class="deals-countdown" data-countdown="2025/03/25 00:00:00"></div>
                        <a href="shop-grid-right.html" class="btn hover-up">Shop Now <i class="fi-rs-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 deal-co">
                <div class="deal wow fadeIn animated" style="background-image: url('assets/imgs/banner/menu-banner-8.jpg');">
                    <div class="deal-top">
                        <h2 class="text-brand">Men Clothing</h2>
                        <h5>Shirt & Bag</h5>
                    </div>
                    <div class="deal-content">
                        <h6 class="product-title"><a href="shop-product-right.html">Try something new on vacation</a></h6>
                        <div class="product-price"><span class="new-price">$178.00</span><span class="old-price">$256.99</span></div>
                    </div>
                    <div class="deal-bottom">
                        <p>Hurry Up! Offer End In:</p>
                        <div class="deals-countdown" data-countdown="2026/03/25 00:00:00"></div>
                        <a href="shop-grid-right.html" class="btn hover-up">Shop Now <i class="fi-rs-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}


<section class="section-padding">
    <div class="container">
        <h3 class="section-title mb-20 wow fadeIn animated"><span>Featured</span> Brands</h3>
        <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
            <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows"></div>
            <div class="carausel-6-columns text-center" id="carausel-6-columns-3">
                @foreach ($brands as $item)
                    @include('frontend.component.brand_card')
                @endforeach
             
            </div>
        </div>
    </div>
</section>
<section class="bg-grey-9 section-padding">
    <div class="container pt-25 pb-25">
        <div class="heading-tab d-flex">
            <div class="heading-tab-left wow fadeIn animated">
                <h3 class="section-title mb-20"><span>Monthly</span> Best Sell</h3>
            </div>
            <div class="heading-tab-right wow fadeIn animated">
                <ul class="nav nav-tabs right no-border" id="myTab-1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="nav-tab-one-1" data-bs-toggle="tab" data-bs-target="#tab-one-1" type="button" role="tab" aria-controls="tab-one" aria-selected="true">REPAIRS TOOLS</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="nav-tab-two-1" data-bs-toggle="tab" data-bs-target="#tab-two-1" type="button" role="tab" aria-controls="tab-two" aria-selected="false">ACCESSORIES</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="nav-tab-three-1" data-bs-toggle="tab" data-bs-target="#tab-three-1" type="button" role="tab" aria-controls="tab-three" aria-selected="false">SPARE PARTS</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex">
                <div class="banner-img style-2 wow fadeIn animated">
                    <img src="{{('frontend/assets/imgs/banner/banner-9.jpg')}}" alt="">
                    <div class="banner-text">
                        <span>Woman Area</span>
                        <h4 class="mt-5">Save 17% on <br>Clothing</h4>
                        <a href="shop-grid-right.html" class="text-white">Shop Now <i class="fi-rs-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="tab-content wow fadeIn animated" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                @foreach ($repair_tools as $item)
                                    @include('frontend.component.product_card')
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--End tab-pane-->
                    <div class="tab-pane fade" id="tab-two-1" role="tabpanel" aria-labelledby="tab-two-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-2-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-2">
                                @foreach ($accessories as $item)
                                    @include('frontend.component.product_card')
                                @endforeach
                              
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-three-1" role="tabpanel" aria-labelledby="tab-three-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-3-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-3">
                                @foreach ($spair_parts as $item)
                                    @include('frontend.component.product_card')
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>
{{-- <section class="section-padding">
    <div class="container pt-25 pb-20">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="section-title mb-20"><span>From</span> blog</h3>
                <div class="post-list mb-4 mb-lg-0">
                    <article class="wow fadeIn animated">
                        <div class="d-md-flex d-block">
                            <div class="post-thumb d-flex mr-15">
                                <a class="color-white" href="blog-post-fullwidth.html">
                                    <img src="{{('frontend/assets/imgs/blog/blog-2.jpg')}}" alt="">
                                </a>
                            </div>
                            <div class="post-content">
                                <div class="entry-meta mb-10 mt-10">
                                    <a class="entry-meta meta-2" href="blog-category-fullwidth.html"><span class="post-in font-x-small">Fashion</span></a>
                                </div>
                                <h4 class="post-title mb-25 text-limit-2-row">
                                    <a href="blog-post-fullwidth.html">Qualcomm is developing a Nintendo Switch-like console, report says</a>
                                </h4>
                                <div class="entry-meta meta-1 font-xs color-grey mt-10 pb-10">
                                    <div>
                                        <span class="post-on">14 April 2022</span>
                                        <span class="hit-count has-dot">12M Views</span>
                                    </div>
                                    <a href="blog-post-right.html">Read More</a>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="wow fadeIn animated">
                        <div class="d-md-flex d-block">
                            <div class="post-thumb d-flex mr-15">
                                <a class="color-white" href="blog-post-fullwidth.html">
                                    <img src="{{('frontend/assets/imgs/blog/blog-1.jpg')}}" alt="">
                                </a>
                            </div>
                            <div class="post-content">
                                <div class="entry-meta mb-10 mt-10">
                                    <a class="entry-meta meta-2" href="blog-category-fullwidth.html"><span class="post-in font-x-small">Healthy</span></a>
                                </div>
                                <h4 class="post-title mb-25 text-limit-2-row">
                                    <a href="blog-post-fullwidth.html">Not even the coronavirus can derail 5G's global momentum</a>
                                </h4>
                                <div class="entry-meta meta-1 font-xs color-grey mt-10 pb-10">
                                    <div>
                                        <span class="post-on">14 April 2022</span>
                                        <span class="hit-count has-dot">12M Views</span>
                                    </div>
                                    <a href="blog-post-right.html">Read More</a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="banner-img banner-1 wow fadeIn animated">
                            <img src="{{('frontend/assets/imgs/banner/banner-5.jpg')}}" alt="">
                            <div class="banner-text">
                                <span>Accessories</span>
                                <h4>Save 17% on <br>Autumn Hat</h4>
                                <a href="shop-grid-right.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="banner-img mb-15 wow fadeIn animated">
                            <img src="{{('frontend/assets/imgs/banner/banner-6.jpg')}}" alt="">
                            <div class="banner-text">
                                <span>Big Offer</span>
                                <h4>Save 20% on <br>Women's socks</h4>
                                <a href="shop-grid-right.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="banner-img banner-2 wow fadeIn animated">
                            <img src="{{('frontend/assets/imgs/banner/banner-7.jpg')}}" alt="">
                            <div class="banner-text">
                                <span>Smart Offer</span>
                                <h4>Save 20% on <br>Eardrop</h4>
                                <a href="shop-grid-right.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
{{-- <section class="mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="banner-bg wow fadeIn animated" style="background-image: url('assets/imgs/banner/banner-8.jpg')">
                    <div class="banner-content">
                        <h5 class="text-grey-4 mb-15">Shop Today’s Deals</h5>
                        <h2 class="fw-600">Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to 40%</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mb-45">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-sm-5 mb-md-0">
                <div class="banner-img wow fadeIn animated mb-md-4 mb-lg-0">
                    <img src="{{('frontend/assets/imgs/banner/banner-10.jpg')}}" alt="">
                    <div class="banner-text">
                        <span>Shoes Zone</span>
                        <h4>Save 17% on <br>All Items</h4>
                        <a href="shop-grid-right.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-sm-5 mb-md-0">
                <h4 class="section-title style-1 mb-30 wow fadeIn animated">Deals & Outlet</h4>
                <div class="product-list-small wow fadeIn animated">
                    <article class="row align-items-center">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{('frontend/assets/imgs/shop/thumbnail-3.jpg')}}" alt=""></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h4 class="title-small">
                                <a href="shop-product-right.html">Fish Print Patched T-shirt</a>
                            </h4>
                            <div class="product-price">
                                <span>$238.85 </span>
                                <span class="old-price">$245.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{('frontend/assets/imgs/shop/thumbnail-4.jpg')}}" alt=""></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h4 class="title-small">
                                <a href="shop-product-right.html">Vintage Floral Print Dress</a>
                            </h4>
                            <div class="product-price">
                                <span>$238.85 </span>
                                <span class="old-price">$245.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{('frontend/assets/imgs/shop/thumbnail-5.jpg')}}" alt=""></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h4 class="title-small">
                                <a href="shop-product-right.html">Multi-color Stripe Circle Print T-Shirt</a>
                            </h4>
                            <div class="product-price">
                                <span>$238.85 </span>
                                <span class="old-price">$245.8</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-sm-5 mb-md-0">
                <h4 class="section-title style-1 mb-30 wow fadeIn animated">Top Selling</h4>
                <div class="product-list-small wow fadeIn animated">
                    <article class="row align-items-center">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{('frontend/assets/imgs/shop/thumbnail-6.jpg')}}" alt=""></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h4 class="title-small">
                                <a href="shop-product-right.html">Geometric Printed Long Sleeve Blosue</a>
                            </h4>
                            <div class="product-price">
                                <span>$238.85 </span>
                                <span class="old-price">$245.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{('frontend/assets/imgs/shop/thumbnail-7.jpg')}}" alt=""></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h4 class="title-small">
                                <a href="shop-product-right.html">Print Patchwork Maxi Dress</a>
                            </h4>
                            <div class="product-price">
                                <span>$238.85 </span>
                                <span class="old-price">$245.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{('frontend/assets/imgs/shop/thumbnail-8.jpg')}}" alt=""></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h4 class="title-small">
                                <a href="shop-product-right.html">Daisy Floral Print Straps Jumpsuit</a>
                            </h4>
                            <div class="product-price">
                                <span>$238.85 </span>
                                <span class="old-price">$245.8</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="section-title style-1 mb-30 wow fadeIn animated">Hot Releases</h4>
                <div class="product-list-small wow fadeIn animated">
                    <article class="row align-items-center">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{('frontend/assets/imgs/shop/thumbnail-9.jpg')}}" alt=""></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h4 class="title-small">
                                <a href="shop-product-right.html">Floral Print Casual Cotton Dress</a>
                            </h4>
                            <div class="product-price">
                                <span>$238.85 </span>
                                <span class="old-price">$245.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{('frontend/assets/imgs/shop/thumbnail-1.jpg')}}" alt=""></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h4 class="title-small">
                                <a href="shop-product-right.html">Ruffled Solid Long Sleeve Blouse</a>
                            </h4>
                            <div class="product-price">
                                <span>$238.85 </span>
                                <span class="old-price">$245.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{('frontend/assets/imgs/shop/thumbnail-2.jpg')}}" alt=""></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h4 class="title-small">
                                <a href="shop-product-right.html">Multi-color Print V-neck T-Shirt</a>
                            </h4>
                            <div class="product-price">
                                <span>$238.85 </span>
                                <span class="old-price">$245.8</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endsection