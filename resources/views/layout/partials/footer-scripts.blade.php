<!-- jQuery -->


<!-- Bootstrap Core JS -->
<script src="{{ URL::asset('/assets/js/bootstrap.bundle.min.js')}}"></script>

<!-- Feather Icon JS -->
<script src="{{ URL::asset('/assets/js/feather.min.js')}}"></script>

<!-- Slimscroll JS -->
<script src="{{ URL::asset('/assets/js/jquery.slimscroll.min.js')}}"></script>

<!-- Datatable JS -->
<script src="{{ URL::asset('/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables/datatables.min.js')}}"></script>

<!-- Select2 JS -->
@if(Route::is(['form-select2']))
<script src="{{ URL::asset('/assets/plugins/select2/js/custom-select.js')}}"></script>
@endif
<!-- Datetimepicker JS -->
<script src="{{ URL::asset('/assets/js/moment.min.js')}}"></script>
<script src="{{ URL::asset('/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
@if(Route::is(['calendar']))
<!-- Full Calendar JS -->
<script src="{{ URL::asset('/assets/js/jquery-ui.min.js')}}"></script>
<script src="{{ URL::asset('/assets/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{ URL::asset('/assets/plugins/fullcalendar/jquery.fullcalendar.js')}}"></script>
@endif


@if(Route::is(['rating']))
<!-- Raty JS -->
<script src="{{ URL::asset('/assets/plugins/raty/jquery.raty.js')}}"></script>
<script src="{{ URL::asset('/assets/plugins/raty/custom.raty.js')}}"></script>
@endif

@if(Route::is(['text-editor']))
<!-- Summernote JS -->
<script src="{{ URL::asset('/assets/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
@endif
@if(Route::is(['timeline']))
<!-- Stickynote JS -->
<script src="{{ URL::asset('/assets/js/jquery-ui.min.js')}}"></script>
<script src="{{ URL::asset('/assets/plugins/stickynote/sticky.js')}}"></script>
@endif
@if(Route::is(['toastr']))
<script src="{{ URL::asset('/assets/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{ URL::asset('/assets/plugins/toastr/toastr.js')}}"></script>
@endif
@if(Route::is(['rangeslider']))
<!-- Rangeslider JS -->
<script src="assets/plugins/ion-rangeslider/ion.rangeSlider.min.js"></script>
<script src="assets/plugins/ion-rangeslider/custom-rangeslider.js"></script>
@endif
<!-- Owl JS -->
<script src="{{ URL::asset('/assets/plugins/owlcarousel/owl.carousel.min.js')}}"></script>
<!-- Fileupload JS -->
<script src="{{ URL::asset('/assets/plugins/fileupload/fileupload.min.js')}}"></script>
<!-- Sweetalert 2 -->
<script src="{{ URL::asset('/assets/plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
<script src="{{ URL::asset('/assets/plugins/sweetalert/sweetalerts.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<!-- Custom JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.all.min.js" integrity="sha512-4tvE14sHIcdIHl/dUdMHp733PI6MpYA7BDnDfndQmx7aIovEkW+LfkonVO9+NPWP1jYzmrqXJMIT2tECv1TsEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js'></script>
<script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script>
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
    var base_url = '{{url("/")}}'

   
    // ClassicEditor
    //                             .create( document.querySelector( '.editor' ) )
    //                             .then( editor => {
    //                                     console.log( editor );
    //                             } )
    //                             .catch( error => {
    //                                     console.error( error );
    //                             } );
    //                             ClassicEditor
    //                             .create( document.querySelector( '.ck-editor' ) )
    //                             .then( editor => {
    //                                     console.log( editor );
    //                             } )
    //                             .catch( error => {
    //                                     console.error( error );
    //                             } );
</script>
<script src="{{ URL::asset('/assets/js/script.js')}}"></script>

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