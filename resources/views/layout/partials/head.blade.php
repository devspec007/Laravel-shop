<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="Fikry">
<meta name="keywords" content="Fikry">
<meta name="author" content="Fikry">
<meta name="robots" content="noindex, nofollow">
<title>Fikry</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Favicon -->
<link rel="shortcut icon" href="{{url('assets/img/favicon.png')}}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap" rel="stylesheet"> 

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">

<!-- Fontawesome CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
<link rel="stylesheet" href="{{url('assets/plugins/fontawesome/css/all.min.css')}}">

<!-- animation CSS -->
<link rel="stylesheet" href="{{url('assets/css/animate.css')}}">
@if(Route::is(['icon-feather']))
<!-- Feather CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/icons/feather/feather.css')}}">
@endif
@if(Route::is(['icon-flag']))
<!-- Pe7 CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/icons/flags/flags.css')}}">
@endif
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="{{url('assets/css/bootstrap-datetimepicker.min.css')}}">
@if(Route::is(['calendar']))
<!-- Full Calander CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/fullcalendar/fullcalendar.min.css')}}">
@endif
@if(Route::is(['icon-ionic']))
<!-- Ionic CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/icons/ionic/ionicons.css')}}">
@endif
@if(Route::is(['icon-material']))
<!-- Material CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/icons/material/materialdesignicons.css')}}">
@endif
@if(Route::is(['icon-pe7']))
<!-- Pe7 CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/icons/pe7/pe-icon-7.css')}}">
@endif
@if(Route::is(['icon-simpleline']))
<link rel="stylesheet" href="{{url('assets/plugins/icons/simpleline/simple-line-icons.css')}}">
@endif
@if(Route::is(['icon-themify']))
<link rel="stylesheet" href="{{url('assets/plugins/icons/themify/themify.css')}}">
@endif
@if(Route::is(['icon-typicon']))
<link rel="stylesheet" href="{{url('assets/plugins/icons/typicons/typicons.css')}}">
@endif
@if(Route::is(['icon-weather']))
<link rel="stylesheet" href="{{url('assets/plugins/icons/weather/weathericons.css')}}">
@endif
@if(Route::is(['lightbox']))
 <!-- Lightbox CSS -->
 <link rel="stylesheet" href="{{url('assets/plugins/lightbox/glightbox.min.css')}}">
 @endif
 @if(Route::is(['notification']))
 <link rel="stylesheet" href="{{url('assets/plugins/alertify/alertify.min.css')}}">
 @endif
 @if(Route::is(['rating']))
 <!-- Rangeslider CSS -->
 <link rel="stylesheet" href="{{url('assets/plugins/ion-rangeslider/ion.rangeSlider.min.css')}}">
 @endif
 @if(Route::is(['scrollbar']))
 <link rel="stylesheet" href="{{url('assets/plugins/scrollbar/scroll.min.css')}}">
 @endif
 @if(Route::is(['stickynote']))
 <!-- Sticky CSS -->
 <link rel="stylesheet" href="{{url('assets/plugins/stickynote/sticky.css')}}">
 @endif
 @if(Route::is(['text-editor']))
 <!-- Summernote CSS -->
 <link rel="stylesheet" href="{{url('assets/plugins/summernote/dist/summernote-bs4.css')}}">
 @endif
 @if(Route::is(['timeline']))
 <!-- Sticky CSS -->
 <link rel="stylesheet" href="{{url('assets/plugins/stickynote/sticky.css')}}">
 @endif
 @if(Route::is(['toastr']))
 <link rel="stylesheet" href="{{url('assets/plugins/toastr/toatr.css')}}">
 @endif
 @if(Route::is(['rangeslider']))
 <!-- Rangeslider CSS -->
 <link rel="stylesheet" href="assets/plugins/ion-rangeslider/ion.rangeSlider.min.css">
 @endif
 <!-- Owl Carousel CSS -->
 <link rel="stylesheet" href="{{url('assets/plugins/owlcarousel/owl.carousel.min.css')}}">
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/select2/css/select2.min.css')}}">

<!-- Dragula CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/dragula/dragula.min.css')}}">
@if(Route::is(['form-wizard']))
<!-- Wizard CSS -->
<link rel="stylesheet" href="{{url('assets/plugins/twitter-bootstrap-wizard/form-wizard.css')}}">
@endif
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{url('assets/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<!-- Main CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{url('assets/css/style.css')}}">

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="{{ URL::asset('/assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel='stylesheet' href='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.1/css/fontawesome.min.css" integrity="sha512-fZR38yq4xO90wo6TP7f0IltoS2HxJD3HmXEEt4cGU3BXPDjGZ6nun24myAgfajbfO1TOigLZT/ylZGRhA8vtZQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    span.tag.label.label-info {
    color: black;
    background: orange;
    padding: 2px 10px;
    border-radius: 20px;
}
    .customizer-links {
        display: none;
    }
.form-group input[type=text], .form-group input[type=password] {
        height: calc(2.2125rem + 2px);
    padding: 5px;
    font-size: .875rem;
    line-height: 1.5;
}
.form-group {
    margin-bottom: 10px;
}
.w-20 {
    width: 20%;
}
.font-bold {
    font-weight: 700;
}

.sidebar-tabing li {
    padding: 7px 10px;
    margin-bottom: 10px;

}
.sidebar-tabing li:hover {
    background: orange;
    border-radius: 10px;    
}
.sidebar-tabing li:hover a {
    color: white;
}
.sidebar-tabing li.active {
    background: orange;
    border-radius: 10px;

}
.sidebar-tabing li.active a {
    color: white;
}


</style>
