<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Fikry</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/imgs/theme/favicon.svg')}}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/main.css?v=3.4')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .checkout-billing-address input {
            position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        }

        .checkout-billing-address .active {
            border: 2px solid;
        }
    </style>
</head>

<body>
  
    
    @include('frontend.layout.header')
    
    <main class="main">       
      @yield('content')
    </main>
    
    @include('frontend.layout.footer')
    <!-- Preloader Start -->
    @include('frontend.layout.loader')
     <!-- Vendor JS-->
    <script src="{{asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/slick.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.syotimer.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/wow.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery-ui.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/select2.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/waypoints.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/counterup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/images-loaded.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/isotope.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/scrollup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.vticker-min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.theia.sticky.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.elevatezoom.js')}}"></script>
    <!-- Template  JS -->
    <script src="{{asset('frontend/assets/js/main.js?v=3.4')}}"></script>
    <script src="{{asset('frontend/assets/js/shop.js?v=3.4')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.all.min.js" integrity="sha512-4tvE14sHIcdIHl/dUdMHp733PI6MpYA7BDnDfndQmx7aIovEkW+LfkonVO9+NPWP1jYzmrqXJMIT2tECv1TsEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @if(Session::has('success')) 
    <script>
        Swal.fire(
    'Success',
    '{{Session::get("success")}}',
    'success'
    )
    </script>
@elseif(Session::has('error')) 
    <script>
        Swal.fire(
    'Error',
    '{{Session::get("error")}}',
    'success'
    )
    </script>
@endif

    <script>
        var add_cart_url = '{{url("add-to-cart")}}';
      var base_url = "{{url('/')}}"

      $(document).on('submit', '.add-to-cart-form', function(e){
            e.preventDefault();
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url : add_cart_url,
                type : 'post',
                dataType : 'json',
                data : $(this).serialize(),
                headers: { 'X-CSRF-TOKEN': token },
                success : function(response) {
                    $('.cart-dropdown-wrap').find('ul').html(response.mini_cart)
                    $('.pro-count').html(response.quantity);
                    $('.shopping-cart-total').find('span').html(response.total)
                    Swal.fire(
                    'Success',
                    response.message,
                    'success'
                    )
                },
                error : function(error) {
                    
                }
            })
        })
    </script>
   @yield('script')
   <script>
     $(document).on('submit', '.login-form',function(e) {
        e.preventDefault();
        $('.form-error').html('')
        var btnhtml = $('.basicbtn').html();	
        var this_var = $(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.basicbtn').attr('disabled', '')
                $('.basicbtn').html('Please Wait....')
            },
            success: function(response) {
                $('.basicbtn').removeAttr('disabled')
                // Sweet('success', response)
                $('.basicbtn').html(btnhtml)
            
                    if(response.status == 'success') {

                        // Sweet('success', response.message);
                        if( response.url) {
        
                            window.location.href = response.url;
                        }
                        else {
                            window.location.reload()
                        }
                    }
                    else {
                        Swal.fire(
                            '',
                            response.message,
                            'error'
                        )
                        // console.log(response)
                    }
                
            },
            error: function(xhr, status, error) {
                $('.basicbtn').removeAttr('disabled');
                $('.basicbtn').html(btnhtml);
                $.each(xhr.responseJSON.errors, function(key, item) {
                    this_var.find('.'+key+"_error").html(item)
                });
            }
        })
    });

    
    
    $(document).on('change', '.shipping-filter-state-city',function(e) {
        e.preventDefault();
        var this_var = $(this)
        $.ajax({
            type: 'get',
            url: base_url+"/filter-city",
            data: {state_id : $(this).val()},
            dataType: 'json',
        
            success: function(response) {
                var list = '<option value="">Choose City</option>'
                $.each(response.cities, function(index, value){
                    list += `<option value="${value.id}">${value.name}</option>`
                })
                // console.log(list)
                this_var.parents().eq(4).find('.shipping-state-city-list').html(list)
            },
            error: function(xhr, status, error) {
            }
                
        })
    });

    $(document).on('change', '.filter-state-city',function(e) {
        e.preventDefault();
        var this_var = $(this)
        $.ajax({
            type: 'get',
            url: base_url+"/filter-city",
            data: {state_id : $(this).val()},
            dataType: 'json',
        
            success: function(response) {
                var list = '<option value="">Choose City</option>'
                $.each(response.cities, function(index, value){
                    list += `<option value="${value.id}">${value.name}</option>`
                })
                // console.log(list)
                this_var.parents().eq(4).find('.state-city-list').html(list)
            },
            error: function(xhr, status, error) {
            }
                
        })
    });
   </script>
</body>

</html>