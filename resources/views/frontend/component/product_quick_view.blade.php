<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">              
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>       
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-gallery">
                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                            <!-- MAIN SLIDES -->
                            <div class="product-image-slider">
                                <figure class="border-radius-10">
                                    <img src="assets/imgs/shop/product-16-2.jpg" alt="product image">
                                </figure>
                                <figure class="border-radius-10">
                                    <img src="assets/imgs/shop/product-16-1.jpg" alt="product image">
                                </figure>
                                <figure class="border-radius-10">
                                    <img src="assets/imgs/shop/product-16-3.jpg" alt="product image">
                                </figure>
                                <figure class="border-radius-10">
                                    <img src="assets/imgs/shop/product-16-4.jpg" alt="product image">
                                </figure>
                                <figure class="border-radius-10">
                                    <img src="assets/imgs/shop/product-16-5.jpg" alt="product image">
                                </figure>
                                <figure class="border-radius-10">
                                    <img src="assets/imgs/shop/product-16-6.jpg" alt="product image">
                                </figure>
                                <figure class="border-radius-10">
                                    <img src="assets/imgs/shop/product-16-7.jpg" alt="product image">
                                </figure>
                            </div>
                            <!-- THUMBNAILS -->
                            <div class="slider-nav-thumbnails pl-15 pr-15">
                                <div><img src="assets/imgs/shop/thumbnail-3.jpg" alt="product image"></div>
                                <div><img src="assets/imgs/shop/thumbnail-4.jpg" alt="product image"></div>
                                <div><img src="assets/imgs/shop/thumbnail-5.jpg" alt="product image"></div>
                                <div><img src="assets/imgs/shop/thumbnail-6.jpg" alt="product image"></div>
                                <div><img src="assets/imgs/shop/thumbnail-7.jpg" alt="product image"></div>
                                <div><img src="assets/imgs/shop/thumbnail-8.jpg" alt="product image"></div>
                                <div><img src="assets/imgs/shop/thumbnail-9.jpg" alt="product image"></div>
                            </div>
                        </div>
                        <!-- End Gallery -->
                        <div class="social-icons single-share">
                            <ul class="text-grey-5 d-inline-block">
                                <li><strong class="mr-10">Share this:</strong></li>
                                <li class="social-facebook"><a href="#"><img src="assets/imgs/theme/icons/icon-facebook.svg" alt=""></a></li>
                                <li class="social-twitter"> <a href="#"><img src="assets/imgs/theme/icons/icon-twitter.svg" alt=""></a></li>
                                <li class="social-instagram"><a href="#"><img src="assets/imgs/theme/icons/icon-instagram.svg" alt=""></a></li>
                                <li class="social-linkedin"><a href="#"><img src="assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info">
                            <h3 class="title-detail mt-30">{{$product->brand->name ?? ''}} {{$product->name}}</h3>
                            <div class="product-detail-rating">
                                <div class="pro-details-brand">
                                    <span> Brands: <a href="shop-grid-right.html">Bootstrap</a></span>
                                </div>
                                <div class="product-rate-cover text-end">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width:90%">
                                        </div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (25 reviews)</span>
                                </div>
                            </div>
                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    @if (!empty($product->varaints[0]->price))
                                    <ins><span class="text-brand">@if(count($product->varaints) > 0) ₹ {{$product->varaints[0]->price}} @endif</span></ins>
                                    <ins><span class="old-price font-md ml-15">$200.00</span></ins>
                                        
                                    <span class="save-price  font-md color3 ml-15">@if(!empty($product->varaints->discount) && $product->varaints->discount > 0) {{$product->varaints[0]->discount}}% Off @endif</span>
                                    @endif
                                </div>
                            </div>
                            <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                            <div class="short-desc mb-30">
                                <p class="font-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi,!</p>
                            </div>
                            @foreach ($product->attributes as $attribute)
                            @php
                            $options = [];
                                if($attribute)  {
                                   
                                    $options = explode(',', $attribute->options);
                                }
                            @endphp 
                            <div class="attr-detail attr-color mb-15">
                                <strong class="mr-10">{{$attribute->lable}}</strong>
                                <ul class="list-filter size-filter font-small">
                                    @foreach ($options as $option) 

                                    <li><a href="#">{{$option}}</a></li>
                                        
                                    {{-- <li><a href="#" data-color="Red"><span class="product-color-red"></span></a></li> --}}
                                    @endforeach
                               
                                </ul>
                            </div>
                            @endforeach
                            {{-- <div class="attr-detail attr-size">
                                <strong class="mr-10">Size</strong>
                                <ul class="list-filter size-filter font-small">
                                    <li><a href="#">S</a></li>
                                    <li class="active"><a href="#">M</a></li>
                                    <li><a href="#">L</a></li>
                                    <li><a href="#">XL</a></li>
                                    <li><a href="#">XXL</a></li>
                                </ul>
                            </div> --}}
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="detail-extralink">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <span class="qty-val">1</span>
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">
                                    <button type="submit" class="button button-add-to-cart">Add to cart</button>
                                    <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                </div>
                            </div>
                            <ul class="product-meta font-xs color-grey mt-50">
                                <li class="mb-5">SKU: <a href="#">FWM15VKT</a></li>
                                <li class="mb-5">Tags: <a href="#" rel="tag">Cloth</a>, <a href="#" rel="tag">Women</a>, <a href="#" rel="tag">Dress</a> </li>
                                <li>Availability:<span class="in-stock text-success ml-5">8 Items In Stock</span></li>
                            </ul>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
            </div>        
    </div>
    </div>
</div>