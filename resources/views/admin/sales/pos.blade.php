<?php $page="pos";?>
@extends('layout.mainlayout')
@section('content')
<div class="header">
    <!-- Logo -->
        <div class="header-left border-0 ">
        <a href="{{url('index')}}" class="logo">
            <img src="{{ URL::asset('/assets/img/logo.png')}}" alt="">
        </a>
        <a href="{{url('index')}}" class="logo-small">
            <img src="{{ URL::asset('/assets/img/logo-small.png')}}" alt="">
        </a>
    </div>
    <!-- /Logo -->
    
    <!-- Header Menu -->
    <ul class="nav user-menu">
    
        <!-- Search -->
        <li class="nav-item">
            <div class="top-nav-search">
                
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
            </a>
                <form action="#">
                    <div class="searchinputs">
                        <input type="text" placeholder="Search Here ...">
                        <div class="search-addon">
                            <span><img src="{{ URL::asset('/assets/img/icons/closes.svg')}}" alt="img"></span>
                        </div>
                    </div>
                    <a class="btn" id="searchdiv"><img src="{{ URL::asset('/assets/img/icons/search.svg')}}" alt="img"></a>
                </form>
            </div>
        </li>
        <!-- /Search -->
    
        <!-- Flag -->
        <li class="nav-item dropdown has-arrow flag-nav">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">
                <img src="{{ URL::asset('/assets/img/flags/us1.png')}}" alt="" height="20">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ URL::asset('/assets/img/flags/us.png')}}" alt="" height="16"> English
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ URL::asset('/assets/img/flags/fr.png')}}" alt="" height="16"> French
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ URL::asset('/assets/img/flags/es.png')}}" alt="" height="16"> Spanish
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ URL::asset('/assets/img/flags/de.png')}}" alt="" height="16"> German
                </a>
            </div>
        </li>
        <!-- /Flag -->
    
        <!-- Notifications -->
        <li class="nav-item dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <img src="{{ URL::asset('/assets/img/icons/notification-bing.svg')}}" alt="img"> <span class="badge rounded-pill">4</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        <li class="notification-message">
                            <a href="{{url('activities')}}">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt="" src="{{ URL::asset('/assets/img/profiles/avatar-02.jpg')}}">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
                                        <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="{{url('activities')}}">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt="" src="{{ URL::asset('/assets/img/profiles/avatar-03.jpg')}}">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
                                        <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="{{url('activities')}}">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt="" src="{{ URL::asset('/assets/img/profiles/avatar-06.jpg')}}">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
                                        <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="{{url('activities')}}">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt="" src="{{ URL::asset('/assets/img/profiles/avatar-17.jpg')}}">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
                                        <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="{{url('activities')}}">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt="" src="{{ URL::asset('/assets/img/profiles/avatar-13.jpg')}}">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
                                        <p class="noti-time"><span class="notification-time">2 days ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="{{url('activities')}}">View all Notifications</a>
                </div>
            </div>
        </li>
        <!-- /Notifications -->
        
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-img"><img src="{{ URL::asset('/assets/img/profiles/avator1.jpg')}}" alt="">
                <span class="status online"></span></span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img"><img src="{{ URL::asset('/assets/img/profiles/avator1.jpg')}}" alt="">
                        <span class="status online"></span></span>
                        <div class="profilesets">
                            <h6>John Doe</h6>
                            <h5>Admin</h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="{{url('profile')}}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user me-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> My Profile</a>
                    <a class="dropdown-item" href="{{url('generalsettings')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings me-2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>Settings</a>
                    <hr class="m-0">
                    <a class="dropdown-item logout pb-0" href="{{url('signin')}}"><img src="{{ URL::asset('/assets/img/icons/log-out.svg')}}" class="me-2" alt="img">Logout</a>
                </div>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->
    
    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{url('profile')}}">My Profile</a>
            <a class="dropdown-item" href="{{url('generalsettings')}}">Settings</a>
            <a class="dropdown-item" href="{{url('signin')}}">Logout</a>
        </div>
    </div>
    <!-- /Mobile Menu -->
</div>
<div class="page-wrapper ms-0">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 col-sm-12 tabs_wrapper" >
                
               <form class="filter-data">
                <div class="page-header ">
                    <div class="page-title">
                        <h4>Categories</h4>
                        <h6>Manage your purchases</h6>
                    </div>
                </div>
                  
                        <div class="row">
                            <div class="col-md-3 mt-2">
                                <input type="text" class="form-control search-product" name="filter_category" placeholder="search category">
                            </div>
                            <div class="col-md-3 mt-2">
                                <input type="text" class="form-control search-product" name="filter_subcategory" placeholder="search subcategory">
                            </div>
                            <div class="col-md-3 mt-2">
                                <input type="text" class="form-control search-product" name="filter_brand" placeholder="search brand">
                            </div>
                            <div class="col-md-3 mt-2">
                                <input type="text" class="form-control search-product" name="filter_sub_brand" placeholder="search brand">
                            </div>
                           
                            <div class="col-md-12 mt-2">
                                <input type="text" class="form-control search-product" name="filter_product" placeholder="search product">
                            </div>
                          
                        </div>
                  
                    {{-- <ul class=" tabs owl-carousel owl-theme owl-product  border-0 owl-category" >
                        @foreach ($categories as $key => $category)
                            
                        <li  id="{{str_replace(' ', '-', strtolower($category->name))}}">
                            <input type="checkbox" name="category[]" class="pos-brand-category-checkbox" value="{{$category->id}}">
                            <div class="product-details " >
                                <img src="{{ URL::asset($category->image)}}" alt="img"  class="icon">
                                <h6>{{$category->name}}</h6>
                            </div>
                        </li>
                        @endforeach
                    
                    
                    </ul> --}}
                    
                {{-- <h4>Brands</h4>
                <ul class=" tabs owl-carousel owl-theme owl-product owl-brand border-0 " >
                    @foreach ($brands as $key => $brand)
                        
                    <li  id="{{str_replace(' ', '-', strtolower($brand->name))}}">
                        <input type="checkbox" name="brand[]" class="pos-brand-category-checkbox" value="{{$brand->id}}">

                        <div class="product-details " >
                            <img src="{{ URL::asset($brand->image)}}" alt="img"  class="icon">
                            <h6>{{$brand->name}}</h6>
                        </div>
                    </li>
                    @endforeach
                   
                  
                </ul> --}}
               </form>

                <div class="tabs_container mt-3" >
                    <div  class="" >
                        <div class="row " id="pos-product-list">
                            
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 ">
                {{-- <div class="order-list">
                    <div class="orderid">
                        <h4>Order List</h4>
                        <h5>Transaction id : #65565</h5>
                    </div>
                    <div class="actionproducts">
                        <ul>
                            <li>
                                <a href="javascript:void(0);" class="deletebg confirm-text"><img src="{{ URL::asset('/assets/img/icons/delete-2.svg')}}" alt="img"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset" >
                                    <img src="{{ URL::asset('/assets/img/icons/ellipise1.svg')}}" alt="img">
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" data-popper-placement="bottom-end">
                                    <li>
                                        <a href="#" class="dropdown-item">Action</a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item">Another Action</a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item">Something Elses</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div> --}}
                <form action="{{route('admin.place-order')}}" method="post" class="submit-form">
                    @csrf
                    <input type="hidden" class="final-checkout-total-input" value="{{Cart::instance('pos_order')->total()}}">
                    <div class="card card-order">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-12">
                                    <a href="javascript:void(0);" class="btn btn-adds" data-bs-toggle="modal" data-bs-target="#create"><i class="fa fa-plus me-2"></i>Add Customer</a>
                                </div> --}}
                                <div class="col-lg-12">
                                    <div class="select-split ">
                                        <div class="select-group w-100">
                                            <select class="select" name="customer_type">
                                                <option value="">Walk-in Customer</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->name}} >> {{$customer->contact}}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-error" id="customer_type_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <hr>
                                    <div class="row">
                                       
                                        <div class="col-lg-12">
                                            <div class="select-split">
                                                <div class="select-group w-100">
                                                    <input class="form-control" name="customer_name" placeholder="Name">
                                                    <div class="form-error" id="customer_name_error"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="select-split">
                                                <div class="select-group w-100">
                                                    <input class="form-control" name="mobile_no" placeholder="Mobile No.">
                                                    <div class="form-error" id="mobile_no_error"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12">
                                    <div class="select-split">
                                        <div class="select-group w-100">
                                            <select class="select">
                                                <option>Product </option>
                                                <option>Barcode</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="text-end">
                                        <a class="btn btn-scanner-set"><img src="{{ URL::asset('/assets/img/icons/scanner1.svg')}}" alt="img" class="me-2">Scan bardcode</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="split-card">
                        </div>
                        <div class="card-body pt-0">
                            <div class="totalitem">
                                <h4>Total items : <span class="total-cart-quantity">{{\Cart::instance('pos_order')->count()}}</span></h4>
                                <a href="javascript:void(0);" class="cart-confirm-text" data-id="">Clear all</a>
                            </div>
                            <div class="product-table" id="cart-list">
                                @include('admin.sales.cart_list')
                            </div>
                        </div>
                        <div class="split-card">
                        </div>
                        <div class="card-body pt-0 pb-2">
                            <div class="setvalue">
                               
                                <ul>
                                    <li class="total-value">
                                        <h5>Discount </h5>
                                        <h6 >
                                            <input class="form-control discount_amount" name="discount_amount" value="0" placeholder="Enter Discount Amount">
                                            <span class="form-error" id="discount_amount_error"></span>
                                        </h6>
                                    </li>
                                    <li class="total-value">
                                        <h5>GST (%)</h5>
                                        <h6 >
                                            <input class="form-control gst_amount" name="gst_amount" value="0" placeholder="Enter GST">
                                            <span class="form-error" id="gst_amount_error"></span>
                                        </h6>
                                    </li>

                                    <li>
                                        <h5>Subtotal </h5>
                                        <h6 id="final-subtotal">{{Cart::instance('pos_order')->subtotal()}}</h6>
                                    </li>
                                    <li>
                                        <h5>Discount </h5>
                                        <h6 id="discounted-amount">-0</h6>
                                    </li>
                                    <li>
                                        <h5>GST </h5>
                                        <h6 id="gst-amount">+0</h6>
                                    </li>
                                    <li class="total-value">
                                        <h5>Total  </h5>
                                        <h6 id="final-total">{{Cart::instance('pos_order')->total()}}</h6>
                                    </li>
                                    <li class="total-value">
                                        <h5>Total Paid </h5>
                                        <h6 >
                                            <input type="text" class="form-control" name="paid_amount">
                                            <span class="form-error" id="paid_amount_error"></span>
                                        </h6>
                                    </li>
                                </ul>

                            </div>
                            <div class="setvaluecash">
                                <ul>
                                    <li>
                                        <input type="radio" value="cash" name="payment_type" checked class="payment-type-option">
                                        <a href="javascript:void(0);" class="paymentmethod active">
                                            <img src="{{ URL::asset('/assets/img/icons/cash.svg')}}" alt="img" class="me-2">
                                            Cash
                                        </a>
                                    </li>
                                    <li>
                                        <input type="radio" value="online" name="payment_type" class="payment-type-option">
    
                                        <a href="javascript:void(0);" class="paymentmethod">
                                            <img src="{{ URL::asset('/assets/img/icons/debitcard.svg')}}" alt="img" class="me-2">
                                            Online
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="javascript:void(0);" class="paymentmethod">
                                            <img src="{{ URL::asset('/assets/img/icons/scan.svg')}}" alt="img" class="me-2">
                                            Scan
                                        </a>
                                    </li> --}}
                                </ul>
                            </div>		
                            {{-- <div class="btn-totallabel"> --}}
                                <button type="submit" class="btn-totallabel w-100">Checkout
                                    <h6 id="final-checkout-total">{{Cart::instance('pos_order')->total()}}</h6>
                                </button>
                                
                            {{-- </div>							 --}}
                            <div class="btn-pos">
                                {{-- <ul>
                                    <li>
                                        <a class="btn"><img src="{{ URL::asset('/assets/img/icons/pause1.svg')}}" alt="img" class="me-1">Hold</a>
                                    </li>
                                    <li>
                                        <a class="btn"><img src="{{ URL::asset('/assets/img/icons/edit-6.svg')}}" alt="img" class="me-1">Quotation</a>
                                    </li>
                                    <li>
                                        <a class="btn"><img src="{{ URL::asset('/assets/img/icons/trash12.svg')}}" alt="img" class="me-1">Void</a>
                                    </li>
                                    <li>
                                        <a class="btn"><img src="{{ URL::asset('/assets/img/icons/wallet1.svg')}}" alt="img" class="me-1">Payment</a>
                                    </li>
                                    <li>
                                        <a class="btn"  data-bs-toggle="modal" data-bs-target="#recents"><img src="{{ URL::asset('/assets/img/icons/transcation.svg')}}" alt="img" class="me-1"> Transaction</a>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@component('components.modal-popup')                
@endcomponent
@endsection