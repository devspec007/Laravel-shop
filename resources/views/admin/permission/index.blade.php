<?php $page="brandlist";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Department List @endslot
			@slot('title_1') Manage your Department @endslot
		@endcomponent

        <!-- /product list -->
        <div class="card">
            <div class="card-body" >
                <div id="jstree"></div>
                <div class="col-md-12 form-group"><br><button class="btn btn-success" onclick="funSync()">Save</button></div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection
@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

    <script src="{{asset('assets/js/jstree.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
		$(function () {
                $('#jstree').jstree({
                    "plugins" : ["checkbox" ],
                    'core' : {
                        'data' : <?php echo json_encode($permission_list) ?>
                    }
                });
        });

        function funSync(){
			let selectedElmsIds=[];
            var selectedElms = $('#jstree').jstree("get_checked", true);
            $.each(selectedElms, function(a,b) {
				console.log(b);
                if((this.children).length == 0){
                    selectedElmsIds.push(this.id);
                }
            });
            $('#panel').html('<div class="row"><div class="col-md-12" style="color:red">Loading........</div></div>');
            $('#panel').show();
            $.ajax({
                url: '{{url("admin/permission")}}/{{$role->id}}',
                type: 'PATCH',
                data: {
                    _token:'{{csrf_token()}}',
                    permission:selectedElmsIds
                },
                cache: false,
                success: function (data) {
                    $('#panel').html('<div class="row"><div class="col-md-12" style="color:green">Success</div></div>');
                    $('#panel').hide(1000);
                    window.location.reload()
                },
                error: function () {
                    $('#panel').hide(500);
                }
            });
        }
    </script>
@endsection