<?php $page="createsalesreturns";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Create Sales Return @endslot
			@slot('title_1') Add/Update Sales Return @endslot
		@endcomponent
        <div class="card">
            <div class="card-body">
                <form action="">

                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Reference No.</label>
                                <input type="text" name="order_number" value="{{$request->order_number}}">
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <div class="input-groupicon">
                                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @if (!empty($order))
                    <form action="{{route('admin.return.sale.product',[Crypt::encryptString($order->id)])}}" class="submit-form">

                        <input type="hidden" name="order_id" value="{{Crypt::encryptString($order->id)}}">
                        <div class="row">
                            <div class="table-responsive ">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Left QTY	</th>
                                            <th>Price</th>
                                            <th>Return Quantity	</th>
                                            <th>Type	</th>
                                            <th>Reason	</th>
    
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $data)
                                            @if ($data->left_quantity > 0)
                                                
                                            <tr>
                                                <td class="productimgname">
                                                   
                                                    <a href="javascript:void(0);"> {{$data->description}}</a>
                                                </td>
                                                <td>{{$data->left_quantity}}</td>
                                                <td>{{$data->amount}}</td>
                                                <td>
                                                    <input type="hidden" value="{{$data->id}}" name="items[]">
                                                    <input type="number" class="form-control" max="{{$data->left_quantity}}" name="return_quanity_{{$data->id}}">
                                                    <span class="form-error" id="return_quanity_{{$data->id}}_error"></span>
    
                                                </td>
                                                <td>
                                                    <select  class="form-control"  name="type_{{$data->id}}">
                                                        <option value="return">Return </option>
                                                        <option value="replace">Replace </option>
                                                    </select>
                                                    <span class="form-error" id="type_{{$data->id}}_error"></span>
    
                                                </td>
                                                <td>
                                                    <select  class="form-control"  name="reason_{{$data->id}}">
                                                        <option value="damage">Damage </option>
                                                        <option value="not interested">Not Interested </option>
                                                    </select>
                                                    <span class="form-error" id="reason_{{$data->id}}_error"></span>
                                                </td>
                                               
                                                <td>
                                                    <a class="delete-set remove-purchase-item"><img src="{{ URL::asset('/assets/img/icons/delete.svg')}}" alt="svg"></a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- <div class="row ">
                            <div class="col-lg-12 float-md-right">
                                <div class="total-order">
                                    <ul>
                                        <li>
                                            <h4>Order Tax</h4>
                                            <h5>$ 0.00 (0.00%)</h5>
                                        </li>
                                        <li>
                                            <h4>Discount	</h4>
                                            <h5>$ 0.00</h5>
                                        </li>	
                                        <li>
                                            <h4>Shipping</h4>
                                            <h5>$ 0.00</h5>
                                        </li>
                                        <li class="total">
                                            <h4>Grand Total</h4>
                                            <h5>$ 0.00</h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Return Date</label>
                                    <input type="date" name="return_date" class="form-control">
                                    <span class="form-error" id="return_date_error"></span>
                                </div>
                            </div>
                            {{-- <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Discount</label>
                                    <input type="text" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Shipping</label>
                                    <input type="text" >
                                </div>
                            </div> --}}
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Payment Type</label>
                                    <select class="select" name="payment_type">
                                        <option value="">Choose Payment Type</option>
                                        <option value="cash">Cash</option>
                                        <option value="online">Online</option>
                                    </select>
                                    <span class="form-error" id="payment_type_error"></span>
    
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea class="form-control" name="note"></textarea>
                                    <span class="form-error" id="note_error"></span>
    
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-submit me-2">Submit</button>
                                <a href="{{url('salesreturnlist')}}"  class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection