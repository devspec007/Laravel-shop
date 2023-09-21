<?php $page="sales-details";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Sale Details @endslot
			@slot('title_1') View sale details @endslot
		@endcomponent
        <div class="card">
            <div class="card-body">
                <div class="card-sales-split">
                    <h2>Sale Detail : {{$order->order_number}}</h2>
                     <ul>
                        <li>
                            <a  href="{{route('admin.sales.invoice',[$order->id])}}" target="blank" class="dropdown-item"><img src="{{ URL::asset('/assets/img/icons/download.svg')}}" class="me-2" alt="img">Download pdf</a>
                            {{-- <a href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/edit.svg')}}" alt="img"></a> --}}
                        </li>
                       {{-- <li>
                            <a href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/pdf.svg')}}" alt="img"></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/excel.svg')}}" alt="img"></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><img src="{{ URL::asset('/assets/img/icons/printer.svg')}}" alt="img"></a>
                        </li>--}}
                    </ul> 
                </div>
                <div class="invoice-box table-height" style="max-width: 1600px;width:100%;overflow: auto;margin:15px auto;padding: 0;font-size: 14px;line-height: 24px;color: #555;">
                    <table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
                        <tbody><tr class="top">
                            <td colspan="6" style="padding: 5px;vertical-align: top;">
                                <table style="width: 100%;line-height: inherit;text-align: left;">
                                    <tbody><tr>
                                        <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                            <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">Customer Info</font></font><br>
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                            @if (empty($order->customer_id))
                                                walk-in-customer
                                            @elseif(!empty($order->customer_id))
                                                Existing User
                                            @endif
                                            </font></font><br>
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$order->customer_name}}</font></font><br>
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$order->customer_mobile}}</font></font><br>
                                        </td>
                                        <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                            <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">Company Info</font></font><br>
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$order->store ? $order->store->name : ''}} </font></font><br>
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$order->store ? $order->store->email : ''}}</font></font><br>
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">{{$order->store ? $order->store->contact : ''}}</font></font><br>
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$order->store && $order->store->profile && $order->store->profile ? $order->store->profile->address : ''}}</font></font><br>
                                        </td>
                                        <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                            <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">Invoice Info</font></font><br>
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Order Date </font></font><br>
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Order No. </font></font><br>
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">  Payment Status</font></font><br>
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Status</font></font><br>
                                        </td>
                                        <td style="padding:5px;vertical-align:top;text-align:right;padding-bottom:20px">
                                            <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">&nbsp;</font></font><br>
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">{{Carbon\Carbon::parse($order->order_date)->format('d M, Y')}} </font></font><br>
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">{{$order->order_number}} </font></font><br>
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#2E7D32;font-weight: 400;"> {{ucfirst($order->payment_status)}}</font></font><br>
                                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#2E7D32;font-weight: 400;">  {{ucfirst($order->order_status)}}</font></font><br>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                        <tr class="heading " style="background: #F3F2F7;">
                            <td style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                Product Name
                            </td>
                            <td style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                QTY
                            </td>
                            <td style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                Price
                            </td>
                           
                            <td style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                Subtotal
                            </td>
                        </tr>
                        @foreach ($order->items as $data)
                            
                        <tr class="details" style="border-bottom:1px solid #E9ECEF ;">
                            <td style="padding: 10px;vertical-align: top; display: flex;align-items: center;">
                                {{-- <img src="{{ URL::asset('/assets/img/product/product1.jpg')}}" alt="img" class="me-2" style="width:40px;height:40px;"> --}}
                                {{$data->description}}
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                {{$data->quantity}}
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                {{$data->amount}}
                            </td>
                            
                            <td style="padding: 10px;vertical-align: top; ">
                                {{$data->amount*$data->quantity}}
                            </td>
                        </tr>
                        @endforeach
                       
                    </tbody></table>

                </div>
                {{-- <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Order Tax</label>
                            <input type="text">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Discount</label>
                            <input type="text">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Shipping</label>
                            <input type="text">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="select">
                                <option>Choose Status</option>
                                <option>Completed</option>
                                <option>Inprogress</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-lg-6 ">
                            <div class="total-order w-100 max-widthauto m-auto mb-4">
                                <ul>
                                    <li>
                                        <h4>Sub Total</h4>
                                        <h5>{{$order->subtotal}}</h5>
                                    </li>
                                    <li>
                                        <h4>Discount	</h4>
                                        <h5>{{$order->discount_amount}}</h5>
                                    </li>
                                    <li>
                                        <h4>GST Amount	</h4>
                                        <h5>{{$order->gst_amount}}</h5>
                                    </li>	
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="total-order w-100 max-widthauto m-auto mb-4">
                                <ul>
                                    <li>
                                        <h4>Due Amount</h4>
                                        <h5>{{$order->due_amount}}</h5>
                                    </li>
                                    <li class="total">
                                        <h4>Grand Total</h4>
                                        <h5>{{$order->payable_amount}}</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-12">
                        <a href="javascript:void(0);" class="btn btn-submit me-2">Update</a>
                        <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                    </div> --}}
                </div>
            </div>
        </div>
        @include('admin.sales.add_pyament')

    </div>
</div>
@endsection