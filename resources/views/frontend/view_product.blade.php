@extends('frontend.layout.layout')

@section('content')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow">Home</a>
            <span></span> {{$product->display_name}}
        </div>
    </div>
</div>
<section class="mt-50 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    @foreach ($product->productImages as $img)
                                        
                                    <figure class="border-radius-10">
                                        <img src="{{asset('/uploads/products/'.$img->image)}}" alt="product image">
                                    </figure>
                                    @endforeach
                                    
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails pl-15 pr-15">
                                    @foreach ($product->productImages as $img)

                                    <div><img src="{{asset('/uploads/products/'.$img->image)}}" alt="product image"></div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info">
                                <h2 class="title-detail">{{$product->name}} </h2>
                                <div class="product-detail-rating">
                                    <div class="pro-details-brand">
                                        <span> Brands: <a href="shop-grid-right.html">{{$product->brand->name ?? ''}}</a></span>
                                    </div>
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width:90%">
                                            </div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> ({{count($product->reviews)}} reviews)</span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    @php
                                        // $price = 0;
                                        // $discount_percent = 0;
                                        // $discounted_price = 0;
                                        // if($product->activeVariant) {
                                        //     $price = $product->activeVariant->price;
                                        //     $discounted_price =  $product->activeVariant->discount+$price;
                                        //     $discount_percent = ($product->activeVariant->discount/$discounted_price)*100;
                                        // }
                                        $price_data = variantProductPrice($product->activeSKU);
                                    @endphp     
                                    @if($product->activeVariant)
                                    <div class="product-price primary-color float-left">
                                        <ins><span class="text-brand" id="">{{ $price_data['price']  }}</span></ins>
                                        @if($price_data['discount_percent'] != 0 )
                                        <ins><span class="old-price font-md ml-15">{{ $price_data['discounted_price']}}</span></ins>
                                        <span class="save-price  font-md color3 ml-15">{{$price_data['discount_percent']}}% Off</span>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                <div class="mb-3">
                                    {!! $product->short_description !!}
                                </div>
                                {{-- <div class="short-desc mb-30">
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!</p>
                                </div>
                                <div class="product_sort_info font-xs mb-30">
                                    <ul>
                                        <li class="mb-10"><i class="fi-rs-crown mr-5"></i> 1 Year AL Jazeera Brand Warranty</li>
                                        <li class="mb-10"><i class="fi-rs-refresh mr-5"></i> 30 Day Return Policy</li>
                                        <li><i class="fi-rs-credit-card mr-5"></i> Cash on Delivery available</li>
                                    </ul>
                                </div> --}}
                                <form action="" class="changes-variant">
                                    <input type="hidden" id="product-slug" name="slug" value="{{$product->slug}}">
                                    @if(count($product->availableVaraints) > 1)
                                        @foreach ($varaint_options as $key => $attribute)
                                       
                                            <div class="attr-detail attr-color mb-15">
                                               
                                            <strong class="mr-10">{{$attribute[0]['lable']}}</strong>
                                            <ul class="list-filter size-filter font-small">
                                                <input type="hidden" value="{{$key}}" name="options[]">
                                                <input type="hidden" id="options{{$key}}" value="{{$activeVariant_options[$key] ?? ''}}" name="options{{$key}}">
                                                @foreach ($attribute as $option) 
            
                                                <li class="{{isset($activeVariant_options[$key]) && strtolower($activeVariant_options[$key]) == strtolower($option['option']) ? 'active' : ''}}"  ><a href="#" data-key="{{$key}}" data-value="{{$option['option']}}">{{$option['option']}}</a></li>
                                                    
                                                {{-- <li><a href="#" data-color="Red"><span class="product-color-red"></span></a></li> --}}
                                                @endforeach
                                            
                                            </ul>
                                        </div>
                                        @endforeach
                                    @endif
                                </form>
                              
                                <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                <form action="" class="add-to-cart-form">
                                    @csrf

                                    <div class="detail-extralink">
                                        <div class="detail-qty border radius">
                                            <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                            <span class="qty-val">1</span>
                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                        <div class="product-extra-link2">
                                            <input name="variant_id" id="variant_id" hidden value="{{$product->activeVariant->id }}">
                                            <button type="submit" class="button button-add-to-cart">Add to cart</button>
                                            {{-- <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a> --}}
                                            {{-- <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a> --}}
                                        </div>
                                    </div>
                                </form>
                                <ul class="product-meta font-xs color-grey mt-50">
                                    <li class="mb-5">SKU: <a href="#" id="variant-sku">{{$product->activeVariant->sku}}</a></li>
                                    {{-- <li>Availability:<span class="in-stock text-success ml-5">8 Items In Stock</span></li> --}}
                                </ul>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 m-auto entry-main-content">
                            <h2 class="section-title style-1 mb-30">Description</h2>
                            <div class="description mb-50">
                                {!! $product->description !!}
                            </div>
                            <h3 class="section-title style-1 mb-30">Additional info</h3>
                            <table class="font-md mb-30">
                                <tbody>
                                    <tr class="stand-up">
                                        <th>Stand Up</th>
                                        <td>
                                            <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                        </td>
                                    </tr>
                                    <tr class="folded-wo-wheels">
                                        <th>Folded (w/o wheels)</th>
                                        <td>
                                            <p>32.5″L x 18.5″W x 16.5″H</p>
                                        </td>
                                    </tr>
                                    <tr class="folded-w-wheels">
                                        <th>Folded (w/ wheels)</th>
                                        <td>
                                            <p>32.5″L x 24″W x 18.5″H</p>
                                        </td>
                                    </tr>
                                    <tr class="door-pass-through">
                                        <th>Door Pass Through</th>
                                        <td>
                                            <p>24</p>
                                        </td>
                                    </tr>
                                    <tr class="frame">
                                        <th>Frame</th>
                                        <td>
                                            <p>Aluminum</p>
                                        </td>
                                    </tr>
                                    <tr class="weight-wo-wheels">
                                        <th>Weight (w/o wheels)</th>
                                        <td>
                                            <p>20 LBS</p>
                                        </td>
                                    </tr>
                                    <tr class="weight-capacity">
                                        <th>Weight Capacity</th>
                                        <td>
                                            <p>60 LBS</p>
                                        </td>
                                    </tr>
                                    <tr class="width">
                                        <th>Width</th>
                                        <td>
                                            <p>24″</p>
                                        </td>
                                    </tr>
                                    <tr class="handle-height-ground-to-handle">
                                        <th>Handle height (ground to handle)</th>
                                        <td>
                                            <p>37-45″</p>
                                        </td>
                                    </tr>
                                    <tr class="wheels">
                                        <th>Wheels</th>
                                        <td>
                                            <p>12″ air / wide track slick tread</p>
                                        </td>
                                    </tr>
                                    <tr class="seat-back-height">
                                        <th>Seat back height</th>
                                        <td>
                                            <p>21.5″</p>
                                        </td>
                                    </tr>
                                    <tr class="head-room-inside-canopy">
                                        <th>Head room (inside canopy)</th>
                                        <td>
                                            <p>25″</p>
                                        </td>
                                    </tr>
                                    <tr class="pa_color">
                                        <th>Color</th>
                                        <td>
                                            <p>Black, Blue, Red, White</p>
                                        </td>
                                    </tr>
                                    <tr class="pa_size">
                                        <th>Size</th>
                                        <td>
                                            <p>M, S</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="social-icons single-share">
                                <ul class="text-grey-5 d-inline-block">
                                    <li><strong class="mr-10">Share this:</strong></li>
                                    <li class="social-facebook"><a href="#"><img src="assets/imgs/theme/icons/icon-facebook.svg" alt=""></a></li>
                                    <li class="social-twitter"> <a href="#"><img src="assets/imgs/theme/icons/icon-twitter.svg" alt=""></a></li>
                                    <li class="social-instagram"><a href="#"><img src="assets/imgs/theme/icons/icon-instagram.svg" alt=""></a></li>
                                    <li class="social-linkedin"><a href="#"><img src="assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a></li>
                                </ul>
                            </div>
                            <h3 class="section-title style-1 mb-30 mt-30">Reviews ({{count($product->reviews)}})</h3>
                            <!--Comments-->
                            <div class="comments-area style-2">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="mb-30">Customer questions & answers</h4>
                                        <div class="comment-list">
                                            @foreach($product->reviews as $review)
                                            <div class="single-comment justify-content-between d-flex">
                                                <div class="user justify-content-between d-flex">
                                                    <div class="thumb text-center">
                                                        <img src="{{asset('frontend/assets/imgs/avatar-6.png')}}" alt="">
                                                        <h6><a href="#">{{$review->name}}</a></h6>
                                                        <p class="font-xxs">{{Carbon\Carbon::parse($review->created_at)->format('d M, Y')}}</p>
                                                    </div>
                                                    <div class="desc">
                                                        <div class="product-rate1 d-inline-block">
                                                            <div class="product-rating1">
                                                                <ul class="rating-list">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i < $review->rating) 
                                                                        <li class="star-fill"><i class="fa fa-star"></i></li>
                                                                        @else
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        
                                                                        @endif
                                                                    @endfor
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <p>{{$review->comment}}</p>
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex align-items-center">
                                                                <p class="font-xs mr-30">{{Carbon\Carbon::parse($review->created_at)->format('M d, Y')}} at {{Carbon\Carbon::parse($review->created_at)->format('g:i A')}} </p>
                                                                {{-- <a href="#" class="text-brand btn-reply">Reply <i class="fi-rs-arrow-right"></i> </a> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="comment-form">
                                            <h4 class="mb-15">Add a review</h4>
                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <form class="form-contact post-review">
                                                        @csrf
                                                        <input hidden name="product_id" value="{{$product->slug}}">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <div class="rating">
                                                                        <input type="radio" id="star5" name="rating" value="5" />
                                                                        <label class="star" for="star5" title="5" aria-hidden="true"></label>
                                                                        <input type="radio" id="star4" name="rating" value="4" />
                                                                        <label class="star" for="star4" title="4" aria-hidden="true"></label>
                                                                        <input type="radio" id="star3" name="rating" value="3" />
                                                                        <label class="star" for="star3" title="3" aria-hidden="true"></label>
                                                                        <input type="radio" id="star2" name="rating" value="2" />
                                                                        <label class="star" for="star2" title="2" aria-hidden="true"></label>
                                                                        <input type="radio" id="star1" name="rating" value="1" />
                                                                        <label class="star" for="star1" title="1" aria-hidden="true"></label>
                                                                      </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                                    <span class="text-danger comment_error form-error" ></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                                                    <span class="text-danger name_error form-error" ></span>
            
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                                                                    <span class="text-danger email_error form-error" ></span>
            
                                                                </div>
                                                            </div>
                                                          
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="button button-contactForm">Submit
                                                                Review</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-4">
                                        <h4 class="mb-30">Customer reviews</h4>
                                        <div class="d-flex mb-30">
                                            <div class="product-rate d-inline-block mr-15">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            <h6>4.8 out of 5</h6>
                                        </div>
                                        <div class="progress">
                                            <span>5 star</span>
                                            <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                        </div>
                                        <div class="progress">
                                            <span>4 star</span>
                                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                        </div>
                                        <div class="progress">
                                            <span>3 star</span>
                                            <div class="progress-bar" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                        </div>
                                        <div class="progress">
                                            <span>2 star</span>
                                            <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                        </div>
                                        <div class="progress mb-30">
                                            <span>1 star</span>
                                            <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                        </div>
                                        <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                    </div> --}}
                                </div>
                            </div>
                            <!--comment form-->
                            <div class="comment-form">
                                <h4 class="mb-15">Add a review</h4>
                                
                                <div class="row">
                                    <div class="col-lg-8 col-md-12">
                                        <form class="form-contact post-review">
                                            @csrf
                                            <input hidden name="product_id" value="{{$product->slug}}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="rating">
                                                            <input type="radio" id="star5" name="rating" value="5" />
                                                            <label class="star" for="star5" title="5" aria-hidden="true"></label>
                                                            <input type="radio" id="star4" name="rating" value="4" />
                                                            <label class="star" for="star4" title="4" aria-hidden="true"></label>
                                                            <input type="radio" id="star3" name="rating" value="3" />
                                                            <label class="star" for="star3" title="3" aria-hidden="true"></label>
                                                            <input type="radio" id="star2" name="rating" value="2" />
                                                            <label class="star" for="star2" title="2" aria-hidden="true"></label>
                                                            <input type="radio" id="star1" name="rating" value="1" />
                                                            <label class="star" for="star1" title="1" aria-hidden="true"></label>
                                                          </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                        <span class="text-danger comment_error form-error" ></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                                        <span class="text-danger name_error form-error" ></span>

                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                                                        <span class="text-danger email_error form-error" ></span>

                                                    </div>
                                                </div>
                                              
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="button button-contactForm">Submit
                                                    Review</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-60">
                        <div class="col-12">
                            <h3 class="section-title style-1 mb-30">Related products</h3>
                        </div>
                        <div class="col-12">
                            <div class="row related-products">
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap small hover-up">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="shop-product-right.html" tabindex="0">
                                                    <img class="default-img" src="assets/imgs/shop/product-2-1.jpg" alt="">
                                                    <img class="hover-img" src="assets/imgs/shop/product-2-2.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Hot</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <h2><a href="shop-product-right.html" tabindex="0">Ulstra Bass Headphone</a></h2>
                                            <div class="rating-result" title="90%">
                                                <span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                <span>$238.85 </span>
                                                <span class="old-price">$245.8</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap small hover-up">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="shop-product-right.html" tabindex="0">
                                                    <img class="default-img" src="assets/imgs/shop/product-3-1.jpg" alt="">
                                                    <img class="hover-img" src="assets/imgs/shop/product-4-2.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="sale">-12%</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <h2><a href="shop-product-right.html" tabindex="0">Smart Bluetooth Speaker</a></h2>
                                            <div class="rating-result" title="90%">
                                                <span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                <span>$138.85 </span>
                                                <span class="old-price">$145.8</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap small hover-up">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="shop-product-right.html" tabindex="0">
                                                    <img class="default-img" src="assets/imgs/shop/product-4-1.jpg" alt="">
                                                    <img class="hover-img" src="assets/imgs/shop/product-4-2.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="new">New</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <h2><a href="shop-product-right.html" tabindex="0">HomeSpeak 12UEA Goole</a></h2>
                                            <div class="rating-result" title="90%">
                                                <span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                <span>$738.85 </span>
                                                <span class="old-price">$1245.8</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap small hover-up mb-0">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="shop-product-right.html" tabindex="0">
                                                    <img class="default-img" src="assets/imgs/shop/product-5-1.jpg" alt="">
                                                    <img class="hover-img" src="assets/imgs/shop/product-3-2.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Hot</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <h2><a href="shop-product-right.html" tabindex="0">Dadua Camera 4K 2022EF</a></h2>
                                            <div class="rating-result" title="90%">
                                                <span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                <span>$89.8 </span>
                                                <span class="old-price">$98.8</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="banner-img banner-big wow fadeIn f-none animated mt-50 d-none" >
                        <img class="border-radius-10" src="frontend/assets/imgs/banner/banner-4.png" alt="">
                        <div class="banner-text">
                            <h4 class="mb-15 mt-40">Repair Services</h4>
                            <h2 class="fw-600 mb-20">We're an Apple <br>Authorised Service Provider</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
        // $(document).on('submit', '.add-to-cart-form', function(e){
        //     e.preventDefault();
        //     $.ajax({
        //         url : '{{url("add-to-cart")}}',
        //         type : 'post',
        //         dataType : 'json',
        //         data : $(this).serialize(),
        //         success : function(response) {
        //             Swal.fire(
        //             'Success',
        //             response.message,
        //             'success'
        //             )
        //         },
        //         error : function(error) {
                    
        //         }
        //     })
        // })
        </script>
@endsection