<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layout.partials.head')
  </head>
  @if(!Route::is(['error-404','error-500']))
<body>
 @endif 
@if(Route::is(['error-404','error-500']))
<body class="error-page">
@endif 
@if(Route::is(['forgetpassword','resetpassword','signin','signup']))
<body class="account-page">
@endif 
@include('layout.partials.loader')
  <!-- Main Wrapper -->
<div class="main-wrapper">
  @if(Auth::check())
  @if(\Request::route()->getName() != 'login')
    @include('layout.partials.header')
    @endif
    @if(\Request::route()->getName() != 'admin.sales.create' && \Request::route()->getName() != 'login')
    @include('layout.partials.sidebar')
    @endif
  @endif 
    @yield('content')
</div>		
<!-- /Main Wrapper -->
  
    @include('layout.partials.footer-scripts')
    @yield('scripts')
  </body>
</html>