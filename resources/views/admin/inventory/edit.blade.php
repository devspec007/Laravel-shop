<?php $page="addpurchase";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Inventory Show @endslot
			@slot('title_1') View Inventory @endslot
		@endcomponent

        <style>
            .search-section {
                background: white;
    filter: drop-shadow(2px 4px 6px #ddd);
            }
            .search-section li {
                padding: 10px;
            }
            .search-section li:hover {
              
                background: #ff9f436e;
            }
            li.search-product-item.active {
                background: #FF9F43;
            }
        </style>
        <form action="{{route('admin.inventory.update',[$inventory->id])}}" class="submit-form" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <div class="row">
                                    <div class="col-lg-1w col-sm-12 col-12">
                                        <input class="form-control"  value="{{$inventory->product->name ?? ''}}" disabled>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <div class="row">
                                    <div class="col-lg-1w col-sm-12 col-12">
                                        <input class="form-control"  value="{{$inventory->product->category->name ?? ''}}" disabled>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Subcategory Name</label>
                                <div class="row">
                                    <div class="col-lg-1w col-sm-12 col-12">
                                        <input class="form-control"  value="{{$inventory->product->sucategory->name ?? ''}}" disabled>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Brand Name</label>
                                <div class="row">
                                    <div class="col-lg-1w col-sm-12 col-12">
                                        <input class="form-control"  value="{{$inventory->product->brand->name ?? ''}}" disabled>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Purchase Price</label>
                                <div class="row">
                                    <div class="col-lg-1w col-sm-12 col-12">
                                        <input class="form-control"  value="{{$inventory->unit_price ?? ''}}" disabled>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sales Price</label>
                                <input type="text" name="sale_price" value="{{$inventory->sale_price}}" required>

                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="" value="{{$inventory->quantity}}" disabled>

                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Left Quantity</label>
                                <input type="text" name="sale_price" value="{{$inventory->left_quantity}}" disabled>

                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('admin.inventory.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                      
                    </div>
             
                 
                </div>
            </div>
        </form>
    </div>
</div>		
@endsection
	  