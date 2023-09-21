<?php $page="addpurchase";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Purchase Show @endslot
			@slot('title_1') View Purchase @endslot
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
        <form action="{{route('admin.product-inventory.store',[$product->id])}}" class="submit-form" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <div class="row">
                                    <div class="col-lg-1w col-sm-12 col-12">
                                        <input class="form-control"  value="{{$product->name ?? ''}}" disabled>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <div class="row">
                                    <div class="col-lg-1w col-sm-12 col-12">
                                        <input class="form-control"  value="{{$product->category->name ?? ''}}" disabled>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Subcategory Name</label>
                                <div class="row">
                                    <div class="col-lg-1w col-sm-12 col-12">
                                        <input class="form-control"  value="{{$product->sucategory->name ?? ''}}" disabled>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Brand Name</label>
                                <div class="row">
                                    <div class="col-lg-1w col-sm-12 col-12">
                                        <input class="form-control"  value="{{$product->brand->name ?? ''}}" disabled>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-sm btn-primary" type="button" id="add-more-product">Add More</button>
                        </div>
                        
                        <div class="col-lg-12 col-sm-12 col-12 table-responsive">

                            <table class="table" >
                                <thead>
                                    <tr>
                                        <th>Store</th>
                                        <th>SKU</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Sale Price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="product-list">
                                    @include('admin.inventory.list')
                                </tbody>
                            </table>
                           
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
@section('scripts')
<script>
    var html = `@include('admin.inventory.list')`;
   
</script>
@endsection
	  