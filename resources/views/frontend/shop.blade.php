@extends('frontend.layout.layout')
@section('content')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="/" rel="nofollow">Home</a>
            <span></span> Shop
        </div>
    </div>
</div>
<section class="mt-50 mb-50">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9 product-list-sec">
                <a href="" class="filter-screen" id="open-filter"><img width="20" src="{{asset('frontend\assets\imgs\theme\icons\filter.png')}}" alt=""></a>
                <form action="" class="product-filter">

                    {{-- <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p> We found <strong class="text-brand">688</strong> items for you!</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">50</a></li>
                                        <li><a href="#">100</a></li>
                                        <li><a href="#">150</a></li>
                                        <li><a href="#">200</a></li>
                                        <li><a href="#">All</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">Featured</a></li>
                                        <li><a href="#">Price: Low to High</a></li>
                                        <li><a href="#">Price: High to Low</a></li>
                                        <li><a href="#">Release Date</a></li>
                                        <li><a href="#">Avg. Rating</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                   
                  
                </form>
                <div class="row product-grid-3" id="filter-product-list">
                  

                    
                  
                </div>
                <!--pagination-->
                <div class="pagination-area mt-15 mb-sm-5 mb-lg-0 text-center">
                    <nav aria-label="Page navigation example">
                      
                    </nav>
                </div>
            </div>
            <div class="col-lg-3 primary-sidebar sticky-sidebar" id="filter-list">
                <form action="" class="filter-form">


                    <select name="categories[]" hidden multiple>
                        @foreach ($filter_categories as $item)
                            <option value="{{$item}}" selected>{{$item}}</option>
    
                        @endforeach
                    </select>
                    <div class="widget-category mb-30">
                        <div class="close-filter-sec"><a href="" class="filter-screen">X</a></div>

                        <h5 class="section-title style-1 mb-30 wow1 fadeIn1 animated1">Category</h5>
                        <ul class="categories">
                            @php
                                $categories = App\Models\Category::getParentCategories();
                            @endphp
                            @foreach ($categories as $category)
                                
                            <li><a href="{{route('frontend.shop',[$category->slug])}}">{{$category->name}}</a></li>
                            @endforeach
    
                        </ul>
                    </div>
                    <!-- Fillter By Price -->
                    <div class="sidebar-widget price_range range mb-30">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">Fill by price</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="price-filter">
                            <div class="price-filter-inner">
                                <div id="slider-range"></div>
                                <div class="price_slider_amount">
                                    <div class="label-input">
                                        <span>Range:</span>
                                        <input type="text" id="amount"  placeholder="Add Your Price" />
                                        <input type="hidden" id="start_price" name="start_price" placeholder="Add Your Price" /> <input type="hidden" id="end_price" name="end_price" placeholder="Add Your Price" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="list-group">
                            <div class="list-group-item mb-10 mt-10">
                                
                               
                                <label class="fw-900">Brands</label>
                                <div class="custome-checkbox">
                                    @foreach ($brands as $brand)
                                        {{-- <input hidden name="brands[]" value="{{$brand->id}}"> --}}
                                    <input class="form-check-input filter-data" id="{{$brand->id}}brand" name="brands[]" type="checkbox" name="checkbox"  value="{{$brand->id}}">
                                    <label class="form-check-label" for="{{$brand->id}}brand"><span>{{$brand->name}}</span></label>
                                    <br>
                                    @endforeach
                                    
                                </div>
    
    
                                @foreach ($filters as $filter)
                                @if($filter->options != null) 

                                    @php
                                        $options = [];
                                            if($filter)  {
                                               
                                                $options = explode(',', $filter->options);
                                            }
                                    @endphp
                                    <label class="fw-900">{{$filter->lable}}</label>
                                    <div class="custome-checkbox">
                                        <input hidden name="filters[]" value="{{$filter->id}}">

                                            @foreach ($options as $key => $option)
                                            <input class="form-check-input filter-data" id="{{$filter->id.$key}}" name="filter{{$filter->id}}[]" type="checkbox" name="checkbox"  value="{{$option}}">
                                            <label class="form-check-label" for="{{$filter->id.$key}}"><span>{{$option}}</span></label>
                                            <br>
                                            @endforeach
                                            
                                        </div>
                                        @endif
                                @endforeach
                                
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                    </div>
                    <!-- Product sidebar Widget -->
                    <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10" style="display:none;">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">New products</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{asset('frontend/assets/imgs/shop/thumbnail-3.jpg')}}" alt="#">
                            </div>
                            <div class="content pt-10">
                                <h5><a href="shop-product-detail.html">Chen Cardigan</a></h5>
                                <p class="price mb-0 mt-5">$99.50</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width:90%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{asset('frontend/assets/imgs/shop/thumbnail-4.jpg')}}" alt="#">
                            </div>
                            <div class="content pt-10">
                                <h6><a href="shop-product-detail.html">Chen Sweater</a></h6>
                                <p class="price mb-0 mt-5">$89.50</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width:80%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{asset('frontend/assets/imgs/shop/thumbnail-5.jpg')}}" alt="#">
                            </div>
                            <div class="content pt-10">
                                <h6><a href="shop-product-detail.html">Colorful Jacket</a></h6>
                                <p class="price mb-0 mt-5">$25</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width:60%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="banner-img1 wow1 fadeIn1 mb-45 animated1 d-lg-block1 d-none" style="display: none;" >
                        <img src="{{asset('frontend/assets/imgs/banner/banner-11.jpg')}}" alt="">
                        <div class="banner-text">
                            <span>Women Zone</span>
                            <h4>Save 17% on <br>Office Dress</h4>
                            <a href="shop-grid-right.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<div id="quick-view-section d-none">  </div>
@endsection

@section('script')
    <script>
        $(document).on('click', '.filter-screen', function(e){
            e.preventDefault();
            $('#filter-list').toggle('show')
        })
        get_shop_products()
        var page=0
        function get_shop_products() {
            $('.pagination-area').html('');
            
            $.ajax({
                type : 'get',
                url : base_url+'/get_shop_products',
                dataType : 'json',
                data : $('.filter-form').serialize()+"&page="+page,
                success:function(response) {
                    console.log(response)
                    var current_page = response.products.current_page
                    var last_page = response.products.last_page

                    if(parseInt(current_page) < parseInt(last_page)) {
                            $('.pagination-area').html(`<button class="btn btn-sm btn-primary load-more" data-target="${current_page+1}">Load More</button>`);
                    }
                    else {
                        $('.pagination-area').html();
                    }
                    
                    render_shop_products(response.products.data)
                }
            })
        }

        $(document).on('change', '.filter-data', function(e){
            e.preventDefault();
            page =0;
            $('#filter-product-list').html('')
            get_shop_products()
        })
        $(document).on('click', '.load-more', function(e){
            e.preventDefault();
            page = $(this).attr('data-target');
            get_shop_products()
        })

        $(document).on('submit', '.filter-form', function(e){
            e.preventDefault();
            $('#filter-product-list').html('')
            get_shop_products()
        })
        $(document).on('click', '.product-quick-view', function(e){
            e.preventDefault();
          
            var product_id = $(this).attr('data-key')
            quick_view(product_id)
        })
        function quick_view(product_id) {
            $.ajax({
                type : 'get',
                url : base_url+'/product-quick-view/'+product_id,
                dataType : 'json',
                success:function(response) {
                    console.log(response)
                    $('#quick-view-section').html(response.data)
                    $('#quickViewModal').modal('show')
                }
            })
        }
        function render_shop_products(list) {
            $.each(list, function(key, value){
                console.log(value)
                var product_name = '';
                // if(value.brand) {
                //     product_name += value.brand.name;
                // }
                product_name += value.product?.name;
                var discount_percent = 0;
                var price = 0;
                var discounted_price = 0;
                var discount_percent = 0;
                var discount_tag = '';
                var discount_price_tag = '';

                price = value.price;
                discounted_price = parseFloat(value.discount)+ parseFloat(price);
                discount_percent = ( parseFloat(value.discount)/ parseFloat(discounted_price))*100;

                if(parseFloat(discount_percent) > 0) {
                    discount_tag = ` <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">-${discount_percent}%</span>
                                </div>`;
                    discount_price_tag = `<span class="old-price">&#8377;${discounted_price}</span>`;
                }
                var varaints  = value.active_variant;
                if((value.product_attributes).length > 0) {

                    product_name += " ( ";
                    $.each(value.product_attributes, function(v_key, v_value){

                        product_name += v_value.attribute_value;
                        if(((value.product_attributes).length -1) != v_key)  {
                            product_name += ',';
                        }

                    })
                    product_name += " )";
                }


                var sub_category = '';
                if(value.subcategory) {
                    sub_category = value.subcategory.name;
                }
                var image = base_url+'/frontend/assets/imgs/shop/product-2-1.jpg';
                if(value.product.primary_image) {
                    image = base_url+'/uploads/products/'+value.product.primary_image.image
                }

    
                // $('#filter-product-list').append(`<div class="col-lg-4 col-md-4 col-12 col-sm-6">
                //     <div class="product-cart-wrap mb-30">
                //         <div class="product-img-action-wrap">
                //             <div class="product-img product-img-zoom">
                //                 <a href="${base_url}/product/${value.product?.slug}">
                //                     <img class="default-img" src="${image}" alt="">
                //                     <img class="hover-img" src="${image}" alt="">
                //                 </a>
                //             </div>
                //             <div class="product-action-1">
                //                 <a aria-label="Quick view" data-key="${value.product_id}" class="action-btn hover-up product-quick-view" ><i class="fi-rs-search"></i></a>
                //                 <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                //                 <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                //             </div>
                //             ${discount_tag}
                //         </div>
                //         <div class="product-content-wrap">
                //             <div class="product-category">
                //                 <a href="${base_url}/product/${value.product?.slug}">${sub_category}</a>
                //             </div>
                //             <h2><a href="shop-product-right.html">${product_name}</a></h2>
                            
                //             <div class="product-price">
                //                 <span>&#8377; ${price} </span>
                //                 ${discount_price_tag}
                //             </div>
                //             <div class="product-action-1 show">
                //                 <form action="" class="add-to-cart-form">

                //                     <div class="detail-extralink">
                                        
                //                         <div class="product-extra-link2">
                //                             <input name="variant_id" hidden value="${value.id }">
                //                             <button type="submit" aria-label="Add To Cart" class="action-btn hover-up  button-add-to-cart card-add-to-cart "><i class="fi-rs-shopping-bag-add"></i></button>
                //                         </div>
                //                     </div>
                //                 </form>
                //             </div>
                //         </div>
                //     </div>
                // </div>`)
            })
        }
        function oldrender_shop_products(list) {
            $.each(list, function(key, value){
                console.log(value)
                var product_name = '';
                // if(value.brand) {
                //     product_name += value.brand.name;
                // }
                product_name += value.name;
                var discount_percent = 0;
                var price = 0;
                var discounted_price = 0;
                var discount_percent = 0;
                var discount_tag = '';
                var discount_price_tag = '';
                if(value.varaints && value.active_variant) {

                    price = value.active_variant.price;
                    discounted_price = parseFloat(value.active_variant.discount)+ parseFloat(price);
                    discount_percent = ( parseFloat(value.active_variant.discount)/ parseFloat(discounted_price))*100;

                    if(parseFloat(discount_percent) > 0) {
                        discount_tag = ` <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="hot">-${discount_percent}%</span>
                                    </div>`;
                        discount_price_tag = `<span class="old-price">&#8377;${discounted_price}</span>`;
                    }
                    var varaints  = value.active_variant;
                    if((value.active_variant.product_attributes).length > 0) {

                        product_name += " ( ";
                        $.each(value.active_variant.product_attributes, function(v_key, v_value){
    
                            product_name += v_value.attribute_value;
                            if(((value.active_variant.product_attributes).length -1) != v_key)  {
                                product_name += ',';
                            }

                        })
                        product_name += " )";
                    }

                }

                var sub_category = '';
                if(value.subcategory) {
                    sub_category = value.subcategory.name;
                }
                var image = base_url+'/frontend/assets/imgs/shop/product-2-1.jpg';
                if(value.primary_image) {
                    image = base_url+'/uploads/products/'+value.primary_image.image
                }

    
                $('#filter-product-list').append(`<div class="col-lg-4 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="${base_url}/product/${value.slug}">
                                            <img class="default-img" src="${image}" alt="">
                                            <img class="hover-img" src="${image}" alt="">
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Quick view" data-key="${value.id}" class="action-btn hover-up product-quick-view" ><i class="fi-rs-search"></i></a>
                                        <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                    </div>
                                    ${discount_tag}
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="${base_url}/product/${value.slug}">${sub_category}</a>
                                    </div>
                                    <h2><a href="shop-product-right.html">${product_name}</a></h2>
                                   
                                    <div class="product-price">
                                        <span>&#8377; ${price} </span>
                                        ${discount_price_tag}
                                    </div>
                                    <div class="product-action-1 show">
                                        <form action="" class="add-to-cart-form">

                                            <div class="detail-extralink">
                                                
                                                <div class="product-extra-link2">
                                                    <input name="variant_id" hidden value="${value.varaints && value.active_variant ? value.active_variant.id : '' }">
                                                    <button type="submit" aria-label="Add To Cart" class="action-btn hover-up  button-add-to-cart card-add-to-cart "><i class="fi-rs-shopping-bag-add"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>`)
            })
        }
        </script>
@endsection