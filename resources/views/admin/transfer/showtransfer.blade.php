<?php $page="addtransfer";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') View Transfer @endslot
			@slot('title_1')  @endslot
		@endcomponent
        <form action="{{route('admin.transfer.store')}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Date </label>
                                <div class="input-groupicon">
                                    <input type="date" placeholder="DD-MM-YYYY" class="form-control" name="transfer_date" value="{{$transfer->transfer_date}}" disabled>
                                    <div class="text-danger form-error" id="transfer_date_error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>From Location</label>
                                <input class="form-control" disabled name="from_store" id="from_store" value="{{$transfer->fromStore->name}} >> {{$transfer->fromStore->email}} >> {{$transfer->fromStore->contact}}">
                                <div class="text-danger form-error" id="from_store_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>To Location</label>
                                <input class="form-control" disabled name="to_store" id="to_store" value="{{$transfer->toStore->name}} >> {{$transfer->toStore->email}} >> {{$transfer->toStore->contact}}">

                                <div class="text-danger form-error" id="to_store_error"></div>

                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="table-responsive ">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>SKU</th>
                                        <th>Tranfer Stock	</th>
                                        <th>Unit Price	</th>
                                        <th>Total Price	</th>

                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($transfer->transferItems as $item)
                                            <tr>
                                                <td>{{$item->product->productFullName()}} </td>
                                                <td>{{$item->sku->sku}}
                                                    @foreach ($item->sku->productAttributes as $key => $productAttributes)
                                                    {{$productAttributes->attribute->lable .":".$productAttributes->attribute_value}} @if(count($item->sku->productAttributes) -1 > $key) / @endif
                                                @endforeach
                                            </td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$item->unit_price}}</td>
                                                <td>{{$item->total_price}}</td>
                                               
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row">
                        
                       
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Note</label>
                                <textarea class="form-control" name="note" disabled>{{$transfer->note}}</textarea>
                                <div class="text-danger form-error" id="note_error"></div>

                            </div>
                        </div>
                        {{-- <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('admin.transfer.index')}}"  class="btn btn-cancel">Cancel</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection