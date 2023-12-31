<?php $page="importproduct";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Import Products @endslot
			@slot('title_1') Bulk upload your products @endslot
		@endcomponent
        <!-- /product list -->
        <form action="{{route('admin.import-product.store')}}" method="post" class="" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="requiredfield">
                        <h4>Field must be in csv format</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <a class="btn btn-submit w-100" href="{{asset('sample/product-sample.xlsx')}}" target="blank">Download Sample File</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>	Upload CSV File</label>
                                <div class="image-upload">
                                    <input type="file" name="file">
                                    <div class="image-uploads">
                                        <img src="{{ URL::asset('/assets/img/icons/upload.svg')}}" alt="img">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="productdetails productdetailnew">
                                <ul class="product-bar">
                                    <li>
                                        <h4>Product Name</h4>
                                        <h6 class="manitorygreen">This Field is required</h6>
                                    </li>
                                    <li>
                                        <h4>SKU code</h4>
                                        <h6 class="manitorygreen">This Field is required</h6>
                                    </li>
                                    <li>
                                        <h4>Category</h4>
                                        <h6 class="manitorygreen">This Field is required</h6>
                                    </li>
                                    <li>
                                        <h4>Sub Category</h4>
                                        <h6 class="manitorygreen">This Field is required</h6>
                                    </li>
                                    <li>
                                        <h4>Brand</h4>
                                        <h6 class="manitorygreen">This Field is required</h6>
                                    </li>
                                
                                
                                    <li>
                                        <h4>Product Price</h4>
                                        <h6 class="manitorygreen">This Field is required</h6>
                                    </li>
                                    
                                
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="productdetails productdetailnew">
                                <ul class="product-bar">
                                    <li>
                                        <h4>Description</h4>
                                        <h6 class="manitoryblue">Field optional</h6>
                                    </li>
                                    <li>
                                        <h4>Minimum Qty</h4>
                                        <h6 class="manitoryblue">Field optional</h6>
                                    </li>
                                    <li>
                                        <h4>Quantity</h4>
                                        <h6 class="manitoryblue">Field optional</h6>
                                    </li>
                                    <li>
                                        <h4>Tax</h4>
                                        <h6 class="manitoryblue">Field optional</h6>
                                    </li>
                                    <li>
                                        <h4>Discount Type</h4>
                                        <h6 class="manitoryblue">Field optional</h6>
                                    </li>
                                
                                    <li>
                                        <h4>Minimum Qty</h4>
                                        <h6 class="manitoryblue">Field optional</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-0">
                                <button href="javascript:void(0);" class="btn btn-submit me-2">Submit</button>
                                {{-- <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /product list -->
    </div>
</div>
@endsection