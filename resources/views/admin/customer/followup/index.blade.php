<?php $page="followuplist";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Followup List @endslot
			@slot('title_1') Manage Followup @endslot
		@endcomponent
        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="{{ URL::asset('/assets/img/icons/filter.svg')}}" alt="img">
                                <span><img src="{{ URL::asset('/assets/img/icons/closes.svg')}}" alt="img"></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img src="{{ URL::asset('/assets/img/icons/search-white.svg')}}" alt="img"></a>
                        </div>
                    </div>
                    <div class="wordset">
                         <ul>
                           
                           {{--
                              <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="{{ URL::asset('/assets/img/icons/pdf.svg')}}" alt="img"></a>
                            </li>
                             <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{ URL::asset('/assets/img/icons/excel.svg')}}" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{ URL::asset('/assets/img/icons/printer.svg')}}" alt="img"></a>
                            </li>--}}
                        </ul> 
                    </div>
                </div>
                <!-- /Filter -->
                <form action="" class="filter" id="filter-data">
                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="date" class="form-control" placeholder="Choose Date" name="start_date" value="{{$request->start_date}}">
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="date" class=" form-control" placeholder="Choose Date" name="end_date" value="{{$request->end_date}}">
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group" >
                                        <input type="text" placeholder="Enter Order No." name="refrence_number" value="{{$request->refrence_number}}">
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="search" placeholder="Search By Customer name and phone no." value="{{$request->search}}">
                                    </div>
                                </div>
                               
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="filter_type">
                                            <option value="" selected>Choose Filter Type</option>
                                            <option value="pickup" @if(isset($request->filter_type) && strtolower($request->filter_type) == 'pickup') selected @endif>Pickup</option>
                                            <option value="notes" @if(isset($request->filter_type) && strtolower($request->filter_type) == 'notes') selected @endif>Notes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-6 col-12">
                                    <div class="form-group">
                                        <button class="btn btn-filters ms-auto"><img src="{{ URL::asset('/assets/img/icons/search-whites.svg')}}" alt="img"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /Filter -->
                <div class="table-responsive">
                    <table class="table  datanew1">
                        <thead>
                            <tr>
                                {{-- <th>
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th> --}}
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Customer Mobile</th>
                                <th>Order No.</th>
                                <th>Status</th>
                                <th>Total Amount</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $data)
                                
                            <tr>
                            
                                <td>{{Carbon\Carbon::parse($data->order_date)->format('d M, Y')}}</td>
                                <td>{{$data->customer_name}}</td>
                                <td>{{$data->customer_mobile}}</td>
                                <td>{{$data->order_number}}</td>
                                <td><span class="badges bg-lightgreen">{{ucfirst($data->order_status)}}</span></td>
                                <td class="text-red">{{$data->payable_amount}}</td>
                              
                                <td class="text-center">
                                    @php
                                         $str = '';
                                            $pickup_date='';
                                            if(isset($data->lastFollowup->pickup_date))
                                            {
                                                $pickup_date=$data->lastFollowup->pickup_date;
                                            }
                                    @endphp 
                                    <a onclick="openNoteModal({{$data->id}},'{{$data->order_number}}', {{$pickup_date}})"><i class="fa fa-edit"></i></a>
                                            <a  onclick="viewNoteModal({{$data->id}})"><i class="fa fa-sticky-note"></i></a>
                                </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>


<!-- The Modal -->
<div class="modal fade" id="noteModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Short Notes</h4>
          <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
              <form action="{{route('admin.store.orderFollowUp.save')}}" method="post">
                  @csrf
                <div class="form-group">
                  <label>Order Number:</label>
                  <input type="text" class="form-control" name="order_no" id="order_no" readonly>
                </div>
                <div class="form-group">
                  <label>Pick Up Date:</label>
                  <input type="date" class="form-control" name="pickup_date" id="pickup_date">
                </div>
                <div class="form-group">
                    <label>Notes:</label>
                    <textarea class="form-control" name="notes" rows="5" id="notes" required></textarea>
                  </div>
                  <input type="hidden" class="form-control" name="order_id" id="order_id" required>
                  <input type="hidden" class="form-control" name="user_id" id="user_id" required>
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger close-model" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>
  
  <!-- The Modal -->
  <div class="modal fade" id="viewNoteModal">
    <div class="modal-dialog modal-dialog-centered model-md">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Short Notes</h4>
          <a type="button" class="close close-model" data-dismiss="modal">&times;</a>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
              <div id="notesList"></div>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <a type="button" class="btn btn-danger close-model" data-dismiss="modal">Close</a>
        </div>
  
      </div>
    </div>
  </div>
  

@endsection
@section('scripts')
<script>
     /*open follow up note modal*/
     function openNoteModal(order_id,order_no,pickup_date){
            $('#order_id').val(order_id);
            $('#order_no').val(order_no);
            $('#pickup_date').val(pickup_date);
            $('#noteModal').modal('show');
        }
        $(document).on('click', '.close-model', function(e){
                $('.modal').modal('hide')
        })

        /* get follow note */
        function viewNoteModal(order_id)
        {

                let data = {
                          'order_id': order_id,
                          "_token": "{{ csrf_token() }}",
                        }

                $.ajax({
                    type:'POST',
                    url: "{{ route('admin.store.orderFollowUp.view') }}",
                    //dataType: 'json',
                    data:data,
                    success: (result) => {
                        
                            $('#notesList').html(result);
                            $('#viewNoteModal').modal('show');
                            
                        },
                    error: function(result){
                            alert("Something wrong, try later!");
                        }
                    });

        }
    </script>
    
@endsection

