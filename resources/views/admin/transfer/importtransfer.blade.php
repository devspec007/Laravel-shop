<?php $page="importtransfer";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
         @component('components.pageheader')                
			@slot('title') Import Transfer @endslot
			@slot('title_1') Add/Update Transfer @endslot
		@endcomponent
        <form action="{{route('admin.import-transfer.data')}}" method="post" class="submit-form1" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Date </label>
                                <div class="input-groupicon">
                                    <input type="date" placeholder="DD-MM-YYYY" class="form-control" name="transfer_date" required>
                                    <div class="text-danger form-error" id="transfer_date_error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>From</label>
                                <select class="select" name="from_store" id="from_store" required>
                                    <option value="">Choose</option>
                                    @if($main_store)
                                    <option value="{{$main_store->id}}">{{$main_store->name}}</option>
                                    @endif
                                    @foreach ($stores as $store)
                                    <option value="{{$store->id}}">{{$store->name}} >> {{$store->email}} >> {{$store->contact}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="from_store_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>To</label>
                                <select class="select" name="to_store" required>
                                    <option value="">Choose</option>
                                    @if($main_store)
                                    <option value="{{$main_store->id}}">{{$main_store->name}}</option>
                                    @endif
                                    @foreach ($stores as $store)
                                    <option value="{{$store->id}}">{{$store->name}} >> {{$store->email}} >> {{$store->contact}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="to_store_error"></div>

                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <a href="{{asset('sample/transfer-sample.xlsx')}}" target="blank" class="btn btn-submit w-100">Download Sample File</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>	Upload CSV File</label>
                                <div class="image-upload">
                                    <input type="file" name="file" required>
                                    <div class="image-uploads">
                                        <img src="{{ URL::asset('/assets/img/icons/upload.svg')}}" alt="img">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                                <div class="text-danger form-error" id="file_error"></div>
                            </div>
                        </div>
                    
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="note"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('admin.transfer.index')}}"  class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

