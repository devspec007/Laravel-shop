<footer class="main">
    <section class="newsletter p-30 text-white wow fadeIn animated">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-md-3 mb-lg-0">
                    <div class="row align-items-center">
                        <div class="col flex-horizontal-center">
                            <img class="icon-email" src="{{('frontend/assets/imgs/theme/icons/icon-email.svg')}}" alt="">
                            <h4 class="font-size-20 mb-0 ml-3">Sign up to Newsletter</h4>
                        </div>
                        <div class="col my-4 my-md-0 des">
                            <h5 class="font-size-15 ml-4 mb-0">...and receive <strong>$25 coupon for first shopping.</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Subscribe Form -->
                    <form class="form-subcriber d-flex wow fadeIn animated">
                        <input type="email" class="form-control bg-white font-small" placeholder="Enter your email">
                        <button class="btn bg-dark text-white" type="submit">Subscribe</button>
                    </form>
                    <!-- End Subscribe Form -->
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col-lg-4">
                    {{-- <div class="logo logo-width-1 wow fadeIn animated">
                        <a href="/"><img src="{{('frontend/assets/imgs/theme/logo.png')}}" alt="logo"></a>
                    </div> --}}
                    <h5 class="widget-title wow fadeIn animated">
                        <a href="/"><img src="{{('frontend/assets/imgs/theme/logo.png')}}" width="150" alt="logo"></a>
                    </h5>
                    <div class="row">
                        <div class="col-md-8 col-lg-12">
                            <p class="wow fadeIn animated">Manisale India is a top online retailer for mobile phone spare parts, repairing tools, and accessories. Based in Delhi,</p>
                           
                        </div>
                       
                        <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">Follow Us</h5>
                        <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                            <a href="#"><img src="{{('frontend/assets/imgs/theme/icons/icon-facebook.svg')}}" alt=""></a>
                            <a href="#"><img src="{{('frontend/assets/imgs/theme/icons/icon-twitter.svg')}}" alt=""></a>
                            <a href="#"><img src="{{('frontend/assets/imgs/theme/icons/icon-instagram.svg')}}" alt=""></a>
                            <a href="#"><img src="{{('frontend/assets/imgs/theme/icons/icon-pinterest.svg')}}" alt=""></a>
                            <a href="#"><img src="{{('frontend/assets/imgs/theme/icons/icon-youtube.svg')}}" alt=""></a>
                        </div>
                    </div>
                </div>
             
                <div class="col-lg-2 col-md-3">
                    <h5 class="widget-title wow fadeIn animated">About</h5>
                    <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                        <li><a href="/about-us">About Us</a></li>
                        <li><a href="/faqs">FAQ</a></li>
                        <li><a href="/terms-condition">Terms &amp; Conditions</a></li>
                        <li><a href="/contact-us">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-3">
                    <h5 class="widget-title wow fadeIn animated">My Account</h5>
                    <ul class="footer-list wow fadeIn animated">
                        <li><a href="{{route('frontend.customer.login')}}">Sign In</a></li>
                        <li><a href="{{route('frontend.cart')}}">View Cart</a></li>
                        {{-- <li><a href="#">My Wishlist</a></li>
                        <li><a href="#">Track My Order</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Order</a></li> --}}
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="widget-about font-md mb-md-5 mb-lg-0">
                        {{-- <div class="logo logo-width-1 wow fadeIn animated">
                            <a href="/"><img src="{{('frontend/assets/imgs/theme/logo.png')}}" alt="logo"></a>
                        </div> --}}
                        {{-- <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Contact</h5> --}}
                        <p class="wow fadeIn animated">
                            <strong>Address: </strong>2863, 4th floor Gali No. 17, Bidhanpura, Karol Bagh, Delhi - 110005
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>Phone: </strong><a href="tel:+918787777907">+918787777907</a> 
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>Email: </strong> <a href="mailto:info@fikry.in">info@fikry.in</a>
                        </p>
                        <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                            <p class="mb-20 wow fadeIn animated">Secured Payment Gateways</p>
                            <img class="wow fadeIn animated" src="{{('frontend/assets/imgs/theme/payment-method.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container pb-20 wow fadeIn animated">
        <div class="row">
            <div class="col-12 mb-20">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-lg-6">
                <p class="float-md-left font-sm text-muted mb-0">&copy; {{Carbon\Carbon::now()->format('Y')}}, <strong class="text-brand">Fikry</strong> </p>
            </div>
            <div class="col-lg-6">
                <p class="text-lg-end text-start font-sm text-muted mb-0">
                    <a href="/" target="_blank">Fikry.com</a>. All rights reserved
                </p>
            </div>
        </div>
    </div>
</footer>