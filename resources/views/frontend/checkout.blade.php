@extends('frontend.layout.layout')
@section('content')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{route('frontend.home')}}" rel="nofollow">Home</a>
            <span></span> Shop
            <span></span> Checkout
        </div>
    </div>
</div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                @if(!Auth::check())
                <div class="col-lg-6 mb-sm-15">
                    <div class="toggle_info">
                        <span><i class="fi-rs-user mr-10"></i><span class="text-muted">Already have an account?</span> <a href="#loginform" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click here to login</a></span>
                    </div>
                    <div class="panel-collapse collapse login_form" id="loginform">
                        <div class="panel-body">
                            <p class="mb-30 font-sm">If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.</p>
                            <form method="post" class="login-form" action="{{route('frontend.customer.customer-signin')}}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="email" placeholder="Username Or Email">
                                    <span class="from-error email_error">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="Password">
                                    <span class="from-error password_error">
                                </div>
                                {{-- <div class="login_footer form-group">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="remember" value="">
                                            <label class="form-check-label" for="remember"><span>Remember me</span></label>
                                        </div>
                                    </div>
                                    <a href="#">Forgot password?</a>
                                </div> --}}
                                <div class="form-group">
                                    <button type="submit" class="btn btn-md" name="login">Log in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-lg-6">
                    <div class="toggle_info">
                        <span><i class="fi-rs-label mr-10"></i><span class="text-muted">Have a coupon?</span> <a href="#coupon" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click here to enter your code</a></span>
                    </div>
                    <div class="panel-collapse collapse coupon_form " id="coupon">
                        <div class="panel-body">
                            <p class="mb-30 font-sm">If you have a coupon code, please apply it below.</p>
                            <form method="post">
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Coupon Code...">
                                </div>
                                <div class="form-group">
                                    <button class="btn  btn-md" name="login">Apply Coupon</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="divider mt-50 mb-50"></div>
                </div>
            </div>
            <form class="checkout-form" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-25">
                            <h4>Billing Details</h4>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Email <span class="required">*</span></label>
                            <input class="form-control square" name="email" type="text" value="{{Auth::check() ? Auth::user()->email : ''}}">
                            <span class="text-danger form-error email_error">

                        </div>
                        <input type="hidden" name="delivery_type" id="delivery_type" value="local delivery">
                        <div class="row">
                            <div class="col-6">
                                <div class="card delivery-card active-card" data-val="local delivery" data-target="#local-delivery">
                                    <div class="card-body ">
                                        <i class="fa fa-truck"></i>
                                        <span>Local Delivery</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card delivery-card " data-val="store pickup" data-target="#store-pickup">
                                    <div class="card-body">
                                        <i class="fa fa-store"></i>
                                        <span>Store Pickup</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="local-delivery" class="delivery-store-pickup-section">

                            @if(Auth::check())
                            <div class="form-group" @if (count($addresses) == 0) style="display: none;" @endif>
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="new_address" id="new_address" name="new_address" @if (count($addresses) == 0) checked @endif>
                                        <label class="form-check-label label_info"  for="new_address"><span>Add New Billing Address</span></label>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row checkout-billing-address" >
                                @foreach ($addresses as $data)
                                    
                                <div class="col-lg-6">
                                    <div class="card mb-3 mb-lg-0">
                                        <input type="radio" value="{{$data->id}}" name="billing_address" class="checkout-address">
                                        <div class="card-header">
                                            <h5 class="mb-0">Billing Address</h5>
                                        </div>
                                        <div class="card-body">
                                            <address>{{$data->address}}<br> {{$data->area}} {{$data->pincode}}</address>
                                            <p>{{$data->state->name ?? ''}} {{$data->city->name ?? ''}}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            
                            </div>
                            <span class="text-danger form-error billing_address_error"></span>
                            <div >
                                <div id="new-address-form" @if(\Auth::check())style="display: none;" @endif>
                                <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Name <span class="required">*</span></label>
                                            <input class="form-control square" name="name" type="text">
                                            <span class="text-danger form-error name_error">
    
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label>Phone No. <span class="required">*</span></label>
                                            <input class="form-control square" name="phone_no" type="text">
                                            <span class=" text-danger form-error phone_no_error">
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>Choose State</label>
                                                <select class="form-control square filter-state-city" name="state">
                                                    <option value="">Choose State</option>
                                                    @foreach($states as $state)
                                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="text-danger form-error state_error"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>City</label>
                                                <select class="form-control square state-city-list" name="city">
                                                    <option value="">Choose City</option>
                
                                                </select>
                                                <div class="text-danger form-error city_error"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>Pincode</label>
                                                <input type="text" class="form-control square" name="pincode">
                                                <div class="text-danger form-error pincode_error"></div>
    
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>Area</label>
                                                <input type="text" class="form-control square" name="area">
                                                <div class="text-danger form-error area_error"></div>
    
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control square" name="address">
                                                <div class="text-danger form-error address_error"></div>
    
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div>
                                @if(!\Auth::check())
                                <div class="form-group">
                                    <div class="checkbox">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="createaccount" id="createaccount">
                                            <label class="form-check-label label_info" data-bs-toggle="collapse" href="#collapsePassword" data-target="#collapsePassword" aria-controls="collapsePassword" for="createaccount"><span>Create an account?</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapsePassword" class="form-group create-account collapse in">
                                    <input required="" type="password" placeholder="Password" name="password">
                                </div>
                                @endif
                                <div class="ship_detail">
                                    <div class="form-group">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="differentaddress" id="differentaddress" name="is_shipping_different">
                                                <label class="form-check-label label_info" data-bs-toggle="collapse" data-target="#collapseAddress" href="#collapseAddress" aria-controls="collapseAddress" for="differentaddress"><span>Ship to a different address?</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseAddress" class="different_address collapse in row">
                                        <div class="form-group col-md-12">
                                            <label>Name <span class="required">*</span></label>
                                            <input class="form-control square" name="shipping_name" type="text">
                                            <span class="text-danger form-error shipping_name_error">
    
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label>Phone No. <span class="required">*</span></label>
                                            <input class="form-control square" name="shipping_phone_no" type="text">
                                            <span class=" text-danger form-error shipping_phone_no_error">
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>Choose State</label>
                                                <select class="form-control square shipping-filter-state-city" name="shipping_state">
                                                    <option value="">Choose State</option>
                                                    @foreach($states as $state)
                                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="text-danger form-error shipping_state_error"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>City</label>
                                                <select class="form-control square shipping-state-city-list" name="shipping_city">
                                                    <option value="">Choose City</option>
                
                                                </select>
                                                <div class="text-danger form-error shipping_city_error"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>Pincode</label>
                                                <input type="text" class="form-control square" name="shipping_pincode">
                                                <div class="text-danger form-error shipping_pincode_error"></div>
    
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>Area</label>
                                                <input type="text" class="form-control square" name="shipping_area">
                                                <div class="text-danger form-error shipping_area_error"></div>
    
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control square" name="shipping_address">
                                                <div class="text-danger form-error shipping_address_error"></div>
    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-20">
                                    <h5>Additional information</h5>
                                </div>
                                <div class="form-group mb-30">
                                    <textarea rows="5" placeholder="Order notes"></textarea>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div id="store-pickup" class="delivery-store-pickup-section" style="display: none;">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Name <span class="required">*</span></label>
                                    <input class="form-control square" name="customer_name" type="text">
                                    <span class="text-danger form-error customer_name_error">

                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Phone No. <span class="required">*</span></label>
                                    <input class="form-control square" name="customer_phone_no" type="text">
                                    <span class=" text-danger form-error customer_phone_no_error">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Store <span class="required">*</span></label>
                                    <select class="form-control square" name="store">
                                        <option value="">Choose Store</option>
                                        @foreach($stores as $store)
                                        <option value="{{$store->id}}" >{{$store->name. " ".$store->profile->address." ".($store->profile->city->name ?? '')." ".($store->profile->state->name ?? '')." ".$store->profile->pincode}}</option>
                                    @endforeach
                                    </select>
                                    <span class="text-danger form-error store_error">

                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Your Orders</h4>
                            </div>
                            <div class="table-responsive order_table text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (\Cart::instance('frontend_order')->content() as $cart )
                                        @php
                                        // print_r(json_encode($cart->options->options));
                                            $image = URL::asset('assets/imgs/shop/product-1-2.jpg');
                                            if($cart->options->preview != null) {
                                        
                                                $image = $cart->options->preview;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="image product-thumbnail"><img src="{{$image}}" alt="#"></td>
                                            <td>
                                                <h5><a href="shop-product-full.html">{{$cart->name}}</a></h5> <span class="product-qty">x {{$cart->qty}}</span>
                                            </td>
                                            <td>{{$cart->price * $cart->qty}}</td>
                                        </tr>
                                        @endforeach
                                    
                                        <tr>
                                            <th>SubTotal</th>
                                            <td class="product-subtotal" colspan="2">{{\Cart::instance('frontend_order')->subtotal}}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td colspan="2"><em>Free Shipping</em></td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">{{\Cart::instance('frontend_order')->total}}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Payment</h5>
                                </div>
                                <div class="payment_type">
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="payment_type" id="razor" value="razor">
                                        <label class="form-check-label" for="razor" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">Razor Pay</label>
                                        <div class="form-group collapse in" id="bankTranfer">
                                            <p class="text-muted mt-5">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration. </p>
                                        </div>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="payment_type" id="cod" checked="" value="cod">
                                        <label class="form-check-label" for="cod" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">COD</label>
                                        <div class="form-group collapse in" id="checkPayment">
                                            <p class="text-muted mt-5">Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode. </p>
                                        </div>
                                    </div>
                                    
                                </div>
                                <span class="text-danger form-error payment_type_error"></span>
                            </div>
                            <button type="button" class="btn btn-fill-out btn-block mt-30 checkout-form-btn">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>

            <form method="post" id="razorsubmission" action="{{ route('frontend.razorupdate') }}">
                @csrf
                <input type="hidden" class="" id="razor_order_number" name="order_number" value="">
                </form>

        </div>
    </section>
@endsection
@section('script')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(document).on('change', '.checkout-address', function(e){
      
        if($(this).is(':checked') == true) {
            $('.checkout-address').parent().removeClass('active')
            $(this).parent().addClass('active')
        }
       
    })
    $(document).on('change', '#new_address', function(e){
     
      if($(this).is(':checked') == true) {
        $('.checkout-billing-address').hide()
        $('#new-address-form').show()
      }
      else {
        $('.checkout-billing-address').show()
        $('#new-address-form').hide()

      }
     
  })

  $(document).on('click', '.checkout-form-btn', function(e){
    e.preventDefault();
    var this_var = $('.checkout-form');
    $('.form-error').html('');
    $.ajax({
        type : 'post',
        url : '{{route("frontend.place-order")}}',
        dataType : 'json',
        data : this_var.serialize(),
        success : function(response) {
            console.log(response, 'response')
            if(response.payment_type == 'cod') {
               window.location.href = response.url
            }
            else {
                rayzorpayment(response.order_number, response.amount, response.name, response.email, response.phone_no)
            }

        },
        error : function(error) {
            console.log(error, 'error')
            $.each(error.responseJSON.errors, function(key, item) {
				this_var.find('.'+key+"_error").html(item)
			});
        }
    })
  })

  function rayzorpayment(order_number,amount, name, email, mobile){
            // var totalAmount = $(this).attr("data-amount");
            // var product_id =  '';
            // var order_id = order_number;
            $('#razor_order_number').val(order_number)
            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}", // rzp_live_ILgsfZCZoFIKMb
                "amount": (amount*100), // 2000 paise = INR 20
                "name": "{{ env('APP_NAME') }}",
                "description": "Razor Payment",
                'prefill': {'contact': mobile, 'email':email,'name':name},
                "currency": "INR",
                "image": "",
                "notes":{'order_id':order_number},
                "handler": function(rason_result){
                 
                    console.log(order_number, " = order_number")
                    $('#razorsubmission').append('<input type="hidden" class="" name="razorpay_payment_id" value="'+rason_result.razorpay_payment_id+'"> <input type="hidden" class="" name="order_id" value="'+rason_result.order_id+'"> ');
                    $('#razorsubmission').submit();
                    $('.popup').css('display','block');
                
                },
                "modal": {
                    "ondismiss": function(){
                            $('.popup').css('display','none');
                            $('#proceed-to-payment').css("pointer-events", "visible");
                            $('#proceed-to-payment').css("opacity", "1");
                    }
                },

                "theme": {
                    "color": "#F9BF37"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response){
                var razorpay_paymentfail_id = response.error.metadata.payment_id;
                var razorpay_paymentfail_order_id = response.error.metadata.order_id
                $.ajax({
                    url:  "{{ route('frontend.razorupdate') }}",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        razorpay_payment_id: razorpay_paymentfail_id ,order_id : razorpay_paymentfail_id,paymet_fail:response
                    }, 
                    success: function (msg) {
                        saveshipping(); 
                    // window.location.href = "{{url('checkout/order-success')}}";
                    }
                });
            });
            rzp1.open();
            // e.preventDefault();
        } 
    
        $(document).on('click', '.delivery-card', function(e){
        var value = $(this).attr('data-val')
        var target = $(this).attr('data-target')

        $('#delivery_type').val(value)
        $('.delivery-card').removeClass('active-card')
        $(this).addClass('active-card')
        $('.delivery-store-pickup-section').hide()
        $(target).show()
    })
</script>
@endsection