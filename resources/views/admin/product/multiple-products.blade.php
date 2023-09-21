<?php $page="addproduct";?>
@extends('layout.mainlayout')
@section('content')		
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Product Add @endslot
			@slot('title_1') Create new product @endslot
		@endcomponent
        <!-- /add -->
        <form action="{{route('admin.multiple-product.store')}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <button class="btn btn-sm btn-primary" type="button" id="add-more-product-row">Add More Row</button>
            <div id="add-more-product-section">
                @include('admin.product.multiple-product-form')
                {{-- <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" name="name[]">
                                    <div class="text-danger form-error" id="name_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="select filter-category" name="category" >
                                        <option value="">Choose Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger form-error" id="category_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Sub Category</label>
                                    <select class="select sub-category-list" name="subcategory">
                                        <option value="">Choose Sub Category</option>
                                    </select>
                                    <div class="text-danger form-error" id="subcategory_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Brand</label>
                                    <select class="select" name="brand">
                                        <option value="">Choose Brand</option>
                                        @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger form-error" id="brand_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>	Product Type</label>
                                    <select class="select" name="product_type">
                                        <option value="simple">Simple</option>
                                        <option value="variant">Variant</option>
                                    </select>
                                </div>
                            </div>
    
                            
                           
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input type="text" name="sku">
                                    <div class="text-danger form-error" id="sku_error"></div>
                                </div>
                            </div>
                           
                          
                            
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>	Variant Attributes</label>
                                    <select class="select" name="variant_attributes[]" multiple>
    
                                        @foreach ($variant_attributes as $variant_attribute)
                                            
                                        <option value="{{$variant_attribute->id}}">{{$variant_attribute->lable}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger form-error" id="variant_attributes_error"></div>
    
                                    
                                </div>
                            </div>
                           
                           
                           
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="price">
                                    <div class="text-danger form-error" id="price_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>	Status</label>
                                    <select class="select" name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description"></textarea>
                                    <div class="text-danger form-error" id="description_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>	Product Image</label>
                                    <div class="image-upload product-image">
                                        <input type="file" name="images[]" multiple class="dropify">
                                        
                                    </div>
                                </div>
                                <div class="text-danger form-error" id="images_error"></div>
    
                            </div>
                           
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="col-lg-12">
                <button type="submit" class="btn btn-submit me-2">Submit</button>
                <a href="{{route('admin.product.index')}}" class="btn btn-cancel">Cancel</a>
            </div>
        <!-- /add -->
        </form>
    </div>
</div>		
@endsection
	  