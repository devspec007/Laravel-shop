<div class="header-middle header-middle-ptb-1 d-none d-lg-block">
    <div class="container">
        <div class="header-wrap">
            <div class="logo logo-width-1">
                <a href="{{route('frontend.home')}}"><img src="{{asset('frontend/assets/imgs/theme/logo.png')}}" alt="logo"></a>
            </div>
            <div class="header-right">
                <div class="search-style-2">
                    <form action="#">
                        {{-- <select class="select-active">
                            <option>All Categories</option>
                            @foreach ($header as $data)
                                
                            <option>{{$data->name}}</option>
                            @endforeach
                           
                        </select> --}}
                        <input type="text" class="search-product" placeholder="Search for items...">
                    </form>
                    <ul class="search-list-suggestion">
                    </ul>
                </div>
                <div class="header-action-right">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="shop-wishlist.html">
                                <img class="svgInject" alt="Evara" src="{{asset('frontend/assets/imgs/theme/icons/icon-heart.svg')}}">
                                <span class="pro-count blue">0</span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="{{route('frontend.cart')}}">
                                <img alt="Evara" src="{{asset('frontend/assets/imgs/theme/icons/icon-cart.svg')}}">
                                <span class="pro-count blue">{{\Cart::instance('frontend_order')->count()}}</span>
                            </a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                <ul>
                                    @include('frontend.component.mini_card')
                                    
                                </ul>
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span>{{\Cart::instance('frontend_order')->total()}}</span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="{{route('frontend.cart')}}" class="outline">View cart</a>
                                        <a href="{{route('frontend.checkout')}}">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-bottom header-bottom-bg-color sticky-bar">
    <div class="container">
        <div class="header-wrap header-space-between position-relative">
            <div class="logo logo-width-1 d-block d-lg-none">
                <a href="{{route('frontend.home')}}"><img src="{{asset('frontend/assets/imgs/theme/logo.png')}}" alt="logo"></a>
            </div>
            <div class="header-nav d-none d-lg-flex">
                {{-- <div class="main-categori-wrap d-none d-lg-block">
                    <a class="categori-button-active" href="#">
                        <span class="fi-rs-apps"></span> Browse Categories
                    </a>
                    <div class="categori-dropdown-wrap categori-dropdown-active-large">
                        <ul>
                            @foreach ($header as $data)
                            @if ($data->activeChildCategory && count($data->activeChildCategory) > 0)
                            <li class="has-children">
                                <a href="shop-grid-right.html"><i class="evara-font-dress"></i>{{$data->name}}</a>
                                <div class="dropdown-menu">
                                    <ul class="mega-menu d-lg-flex">
                                        <li class="mega-menu-col col-lg-12">
                                            <ul class="d-lg-flex">
                                               
                                                <li class="mega-menu-col col-lg-6">
                                                    <ul>
                                                        @foreach ($data->activeChildCategory as $sub_category)
                                                        <li><a class="dropdown-item nav-link nav_item" href="{{route('frontend.shop',[$sub_category->slug])}}">{{$sub_category->name}}</a></li>
                                                        @endforeach
                                                      
                                                    </ul>
                                                </li>
                                               

                                               
                                            </ul>
                                        </li>
                                       
                                    </ul>
                                </div>
                            </li>
                            @else
                            <li><a href="{{route('frontend.shop',[$data->slug])}}"><i class="evara-font-desktop"></i>{{$data->name}}</a></li>
                                
                            @endif
                           
                            @endforeach
                           
                           
                        </ul>
                        
                    </div>
                </div> --}}
                <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                    <nav>
                        {!! CollapseAbleMenu('header') !!}
                        {{-- <ul>
                            <li><a class="active" href="{{route('frontend.home')}}">Home <i class="fi-rs-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('frontend.home')}}">Home 1</a></li>
                                    <li><a href="index-2.html">Home 2</a></li>
                                    <li><a href="index-3.html">Home 3</a></li>
                                    <li><a href="index-4.html">Home 4</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('frontend.about')}}">About</a>
                            </li>
                            
                            <li class="position-static"><a href="{{route('frontend.shop',['shop'])}}">Shop <i class="fi-rs-angle-down"></i></a>
                                <ul class="mega-menu">
                                    @foreach ($header as $data)
                                        @if ($data->activeChildCategory && count($data->activeChildCategory) > 0)


                                        <li class="sub-mega-menu sub-mega-menu-width-22">
                                            <a class="menu-title" href="#">{{$data->name}}</a>
                                            <ul>
                                                @foreach ($data->activeChildCategory as $sub_category)
                                                <li><a href="{{route('frontend.shop',[$data->slug])}}">{{$sub_category->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endif
                                    @endforeach

                                 
                                   
                                </ul>
                            </li>
                            <li><a href="blog-category-grid.html">Blog <i class="fi-rs-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                    <li><a href="blog-category-list.html">Blog Category List</a></li>
                                    <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                    <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                    <li><a href="#">Single Post <i class="fi-rs-angle-right"></i></a>
                                        <ul class="level-menu level-menu-modify">
                                            <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                            <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                            <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#">Pages <i class="fi-rs-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="page-about.html">About Us</a></li>
                                    <li><a href="page-contact.html">Contact</a></li>
                                    <li><a href="page-account.html">My Account</a></li>
                                    <li><a href="page-login-register.html">login/register</a></li>
                                    <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                                    <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                    <li><a href="page-terms.html">Terms of Service</a></li>
                                    <li><a href="page-404.html">404 Page</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="page-contact.html">Contact</a>
                            </li>
                        </ul> --}}
                    </nav>
                </div>
            </div>
            <div class="hotline d-none d-lg-block">
                {{-- <p><a href=""><i class="fi-rs-user"></i><span>Signin</span></a>  </p> --}}
            </div>
            <p class="mobile-promotion">Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to 40%</p>
            <div class="header-action-right d-block d-lg-none">
                <div class="header-action-2">
                    <div class="header-action-icon-2">
                        <a href="shop-wishlist.html">
                            <img alt="Evara" src="{{asset('frontend/assets/imgs/theme/icons/icon-heart.svg')}}">
                            <span class="pro-count white">4</span>
                        </a>
                    </div>
                    <div class="header-action-icon-2">
                        <a class="mini-cart-icon" href="{{route('frontend.cart')}}">
                            <img alt="Evara" src="{{asset('frontend/assets/imgs/theme/icons/icon-cart.svg')}}">
                            <span class="pro-count white">2</span>
                        </a>
                        <div class="cart-dropdown-wrap cart-dropdown-hm2">
                            <ul>
                                <li>
                                    <div class="shopping-cart-img">
                                        <a href="shop-product-right.html"><img alt="Evara" src="{{asset('frontend/assets/imgs/shop/thumbnail-3.jpg')}}"></a>
                                    </div>
                                    <div class="shopping-cart-title">
                                        <h4><a href="shop-product-right.html">Plain Striola Shirts</a></h4>
                                        <h3><span>1 × </span>$800.00</h3>
                                    </div>
                                    <div class="shopping-cart-delete">
                                        <a href="#"><i class="fi-rs-cross-small"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="shopping-cart-img">
                                        <a href="shop-product-right.html"><img alt="Evara" src="{{asset('frontend/assets/imgs/shop/thumbnail-4.jpg')}}"></a>
                                    </div>
                                    <div class="shopping-cart-title">
                                        <h4><a href="shop-product-right.html">Macbook Pro 2022</a></h4>
                                        <h3><span>1 × </span>$3500.00</h3>
                                    </div>
                                    <div class="shopping-cart-delete">
                                        <a href="#"><i class="fi-rs-cross-small"></i></a>
                                    </div>
                                </li>
                            </ul>
                            <div class="shopping-cart-footer">
                                <div class="shopping-cart-total">
                                    <h4>Total <span>$383.00</span></h4>
                                </div>
                                <div class="shopping-cart-button">
                                    <a href="{{route('frontend.cart')}}">View cart</a>
                                    <a href="shop-checkout.html">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>