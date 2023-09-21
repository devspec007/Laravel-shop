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
        <form action="{{route('admin.product.store')}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="name">
                                <div class="text-danger form-error" id="name_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Print Name</label>
                                <input type="text" name="display_name">
                                <div class="text-danger form-error" id="display_name_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>HSN No.</label>
                                <input type="text" name="hsn_code">
                                <div class="text-danger form-error" id="hsn_code_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Expiry Months </label>
                                <input type="numeric" name="expiry_months" class="form-control">
                                <div class="text-danger form-error" id="expiry_months_error"></div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select UOM</label>
                                <select class="select" name="unit_type_id">
                                    <option value="">Choose UOM</option>
                                    @foreach ($units as $unit)
                                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="unit_id_error"></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="select filter-category" name="category">
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
                                <select class="select sub-category-list" name="subcategory" >
                                    <option value="">Choose Sub Category</option>
                                </select>
                                <div class="text-danger form-error" id="subcategory_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Brand</label>
                                <select class="select filter-brand" name="brand">
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
                                <label>Sub Brand</label>
                                <select class="select filter-sub-brand" name="sub_brand">
                                    <option value="">Choose Sub Brand</option>
                               
                                </select>
                                <div class="text-danger form-error" id="sub_brand_error"></div>
                            </div>
                        </div>

                        
                        
                        
                        
                        
                        
                        
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>	Status</label>
                                <select class="select" name="status">
                                    @foreach (statusList() as $key => $status)
                                    <option value="{{$key}}">{{$status}}</option>
                                    @endforeach
                                  
                                </select>
                            </div>
                        </div>
                         <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>	Purchase Tax</label>
                                <select class="select" name="purchase_tax" id="purchase_tax">
                                    <option value="">Select Tax</option>
                                    @foreach(purchaseTax() as $tax)
                                    <option value="{{$tax['value']}}">{{$tax['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="purchase_tax_error"></div>

                            </div>
                        </div>

                         <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>	Sale Tax</label>
                                <select class="select" name="sale_tax">
                                    <option value="">Select Tax</option>
                                    @foreach(saleTax() as $tax)
                                    <option value="{{$tax['value']}}">{{$tax['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="sale_tax_error"></div>

                            </div>
                        </div>
                       
                       <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>	Product Type</label>
                                <select class="select" name="product_type" id="product_type">
                                    <option value="simple">Simple</option>
                                    <option value="variant">Variant</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>	Net Weight</label>
                                <input class="form-control" name="net_weight" id="net_weight">
                                <div class="text-danger form-error" id="net_weight_error"></div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>	Taxes   </label>

                                <label><input type="checkbox" class="is_purchase_tax" name="is_purchase_tax">	Purchase Tax Including</label>
                                <label><input type="checkbox" name="is_sale_tax">	Sale Tax Including</label>


                            </div>
                        </div>
                        
                        {{-- <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>	Variant Attributes</label>
                                <select class="select" name="variant_attributes[]" multiple>

                                    @foreach ($variant_attributes as $variant_attribute)
                                        
                                    <option value="{{$variant_attribute->id}}">{{$variant_attribute->lable}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="variant_attributes_error"></div>

                                
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                        
                            <div class="form-group">
                                <label>Short Description</label>
                                <textarea class="form-control" name="short_description"></textarea>
                                <div class="text-danger form-error" id="short_description_error"></div>
                            </div>
                           
                        </div>

                        <div class="col-lg-6">
                        
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="product_description"></textarea>
                                <div class="text-danger form-error" id="product_description_error"></div>
                            </div>
                            {{-- <div class="form-group">
                                <label><input type="checkbox" class="is_purchase_tax" name="purchase_tax_include">	Purchase Tax Including</label>
                                <label><input type="checkbox" name="sale_tax_include">	Sale Tax Including</label>

                            </div> --}}
                        </div>
                         
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>	Product Image</label>
                                <div class="image-upload">
                                    <input type="file" name="images[]" multiple class="dropify">
                                    
                                </div>
                            </div>
                            <div class="text-danger form-error" id="images_error"></div>

                        </div>
                       
                     
                       
                      
                    </div>
                </div>
            </div>
            <div class="card" id="simple-product-section">
                <div class="card-header">
                    <h4>Price Details</h4>
                </div>
                <div class="card-body">
                 
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Item Code/Barcode</label>
                                    <input type="text" name="sku">
                                    <div class="text-danger form-error" id="sku_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Minimum Qty</label>
                                    <input type="text" name="minimum_quantity">
                                    <div class="text-danger form-error" id="minimum_quantity_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12 update_inventory-section">
                                <div class="form-group">
                                    <label>Opening Quantity</label>
                                    <input type="text" name="quantity">
                                    <div class="text-danger form-error" id="quantity_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Purchase Price</label>
                                    <input type="text" value="0" name="purchase_price" id="purchase_price" class="product_price">
                                    <div class="text-danger form-error" id="purchase_price_error"></div>
                                    <input type="hidden" name="tax_amount" id="tax_amount" value="0">
                                </div>
                            </div>

                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Landing Cost</label>
                                    <input type="text" value="0" name="landing_cost" id="landing_cost" readonly class="product_price">
                                    <div class="text-danger form-error" id="landing_cost_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>MRP</label>
                                    <input type="text" name="mrp" id="mrp" class="product_price">
                                    <div class="text-danger form-error" id="mrp_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Selling Discount</label>
                                    <input type="text" name="discount" id="discount" class="product_price">
                                    <div class="text-danger form-error" id="discount_error"></div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Selling Price</label>
                                    <input type="text" value="0" name="price" id="selling_price" class="product_price">
                                    <div class="text-danger form-error" id="price_error"></div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Selling Margin</label>
                                    <input type="text" value="0" name="selling_margin" id="selling_margin" class="product_price">
                                    <div class="text-danger form-error" id="selling_margin_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Retailer Discount</label>
                                    <input type="text" name="retailer_discount" id="retailer_discount" class="product_price">
                                    <div class="text-danger form-error" id="retailer_discount_error"></div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Retailer Price</label>
                                    <input type="text" value="0" name="retailer_price" id="retailer_price" class="product_price">
                                    <div class="text-danger form-error" id="retailer_price_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Retailer Margin</label>
                                    <input type="text" value="0" name="retailer_margin" id="retailer_margin" class="product_price">
                                    <div class="text-danger form-error" id="retailer_margin_error"></div>
                                </div>
                            </div>
                            
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Wholesale Discount</label>
                                    <input type="text" name="wholesale_discount" id="wholesale_discount" class="product_price">
                                    <div class="text-danger form-error" id="wholesale_discount_error"></div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Wholesale Price</label>
                                    <input type="text" value="0" name="wholesale_price" id="wholesale_price" class="product_price">
                                    <div class="text-danger form-error" id="wholesale_price_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Wholesale Margin</label>
                                    <input type="text" value="0" name="wholesale_margin" id="wholesale_margin" class="product_price">
                                    <div class="text-danger form-error" id="wholesale_margin_error"></div>
                                </div>
                            </div>

                           
                            <div class="col-lg-12" style="display:none;">
                                <div class="form-group">
                                    <label>Product Variant Image</label>
                                    <div class="image-upload">
                                        <input type="file" name="sku_images[]" multiple class="dropify">
                                        
                                    </div>
                                </div>
                                <div class="text-danger form-error" id="sku_images_error"></div>
    
                            </div>
                            
                            {{-- <h4>Vairant Attributes</h4> --}}
                            
                           <div style="display:none;" class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Attribute</th>
                                        <th>Attributes Value</th>
                                        <th>Action</th>
    
                                    </tr>
                                    <tbody id="attribute_list">
                                        @foreach($variant_attributes as $attribute)
                                        @php
                                        $options = [];
                                            if($attribute)  {
                                            
                                                $options = explode(',', $attribute->options);
                                            }
                                        @endphp   
                                        <tr>
                                            <td>
                                                <input type="hidden"  name="attribute[]" value="{{$attribute->id}}">
                                                <input type="text" class="form-control" disabled value="{{$attribute->lable}}">
                                            </td>
                                            <td>
                                                {{-- <input type="text" class="inputTag form-control" > --}}
                                                {{-- <select name="option[]" class="select options" id="">
                                                    <option value="">Select Option</option>
                                                    @foreach ($options as $option)
                                                    <option value="{{$option}}">{{$option}}</option>
                                                        
                                                    @endforeach
                                                </select> --}}
                                            </td>
                                            <td>
                                                {{-- <a type="button" class="btn btn-sm btn-primary remove-attribute">Remove</a> --}}
                                            </td>
                                        
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                           </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" id="variant-product-section" style="display: none">
                
                <div class="card-header">
                    <h6><strong>Variants</strong> product comes in multiple versions, like different sizes or colors.</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                        <thead>
                            <tr>
                                <th>Option Name</th>
                                <th>Type</th>
                                <th>Option Value</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                            <tbody  id="variant_options">
                            <tr id="first_vairant">
                                <td class="w-20">
                                    {{-- <select name="variant_attributes[]" class="form-control option_name_list" width="50">
                                    <option value="">Select</option>

                                    @foreach ($variant_attributes as $variant_attribute)
                                        
                                    <option value="{{$variant_attribute->id}}" data-values="{{$variant_attribute->options}}">{{$variant_attribute->lable}}</option>
                                    @endforeach
                                    </select> --}}
                                    <input type="text" name="variant_attributes[]" class="form-control">
                                   
                                </td>
                                <td>
                                    <select name="option_type[]" class="form-control"  id="">
                                        <option value="text">Text</option>
                                        <option value="image">Image</option>

                                    </select>
                                </td>
                                 <td >
                                    <input type="text" class="inputTag form-control" name="option_value[]">
                                </td>

                                    {{-- <select class="form-control option_value_list select" multiple name="option_value">
                                        <option value="">Select Values</select>
                                    </select> --}}
                                </td>
                                <td class="w-20">
                                    <button class="btn btn-sm btn-danger remove-variant"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-sm btn-secondary" id="add-more-variant-option">Add More</button>
                    </div>
                    <input type="hidden" class="total_variants" id="total_variants" value="1">
                     <div class="table-responsive"  style="display:none;">
                        <table class="table table-bordered">
                            <thead>
                                {{-- <tr>
                                    <th colspan="7"></th>
                                    <th colspan="3">Customer Price</th>
                                    <th colspan="3">Wholesale Price</th>

                                </tr> --}}
                                <tr>
                                    <th>Variant</th>
                                    <th>Item Code/Barcode</th>
                                    <th>Minimum Qty</th>
                                    <th>Opening Qty</th>
                                    <th>Purchase Price</th>
                                    <th>Landing Cost</th>
                                    <th>MRP</th>
                                    <th>Customer Discount Type</th>
                                    <th>Customer Discount</th>
                                    <th>Customer Price</th>
                                    <th>Wholesale Discount Type</th>
                                    <th>Wholesale Discount</th>
                                    <th>Wholesale Price</th>


                                </tr>
                            </thead>
                            <tbody  id="variant_options_rows">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Ecommerce Details</h4>
                </div>
                <div class="card-body">
                    <div class="row" style="clear:both;">
                        {{-- <div class="col-md-3">
                           <label class="col-form-label"><input type="checkbox" name="cod_available"> :cod_available</label>
                       </div>
                        <div class="col-md-3">
                           <label class="col-form-label"><input type="checkbox" name="online_payment_available"> :online_payment_available</label>
                       </div>
                        --}}
                        <div class="col-md-3">
                            <label class="col-form-label"><input type="checkbox" name="is_featured"> :is_featured</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label"><input type="checkbox" name="is_new"> :is_new</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label"><input type="checkbox" name="is_popular"> :is_popular</label>
                        </div>
                       <div class="col-md-3">
                           <label class="col-form-label"><input type="checkbox" name="is_hot_product"> :is_hot_product</label>
                       </div>
                       <div class="col-md-3">
                           <label class="col-form-label"><input type="checkbox" name="is_best_seller_offers"> :is_best_seller_offers</label>
                       </div>
                       <div class="col-md-3">
                           <label class="col-form-label"><input type="checkbox" name="is_repair_tool_offers"> :is_repair_tool_offers</label>
                       </div>
                       <div class="col-md-3">
                           <label class="col-form-label"><input type="checkbox" name="is_accessories_offers"> :is_accessories_offers</label>
                       </div>
                   </div>
                   <div class="row" style="clear:both;">
                        <div class="col-md-3">
                            <label class="col-form-label"><input type="checkbox" name="is_spare_part_offers"> :is_spare_part_offers</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label"><input type="checkbox" name="is_top_offers"> :is_top_offers</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>E-commerce Category</label>
                                <select class="select" name="ecom_category[]" multiple  >
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="ecom_category_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="slug">
                                <div class="text-danger form-error" id="slug_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title">
                                <div class="text-danger form-error" id="meta_title_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Meta Keyword</label>
                                <textarea type="text" name="meta_keywords"></textarea>
                                <div class="text-danger form-error" id="meta_keywords_error"></div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea class="form-control" name="meta_description"></textarea>
                                <div class="text-danger form-error" id="meta_description_error"></div>
                            </div>
                        </div>
                         
                        
                     
                       
                      
                    </div>
                </div>
            </div>
        <!-- /add -->
        
        <div class="col-lg-12">
            <button type="submit" class="btn btn-submit me-2">Submit</button>
            <a href="{{route('admin.product.index')}}" class="btn btn-cancel">Cancel</a>
        </div>
        </form>
    </div>
</div>		
@endsection
@section('scripts')

<script>
       CKEDITOR.replace( 'short_description' );
    CKEDITOR.replace( 'product_description' );
var purchase_price = 0;

    $(document).on('change', '.is_purchase_tax', function(e){
        initializeAmount()
        })


    $(document).on('change', '#purchase_tax', function(e){
        
        initializeAmount()


    });
    function initializeAmount(){
        var purchase_tax = $('#purchase_tax').val();
        var purchase_price = $('#purchase_price').val();
        var total_amount = $('#purchase_price').val();
        $('#tax_amount').val(0)
        if($('.is_purchase_tax').is(":checked") && purchase_tax != 0 && purchase_tax != '') {
            var tax_amount = (parseFloat(purchase_price)*parseFloat(purchase_tax))/100;
            total_amount = parseFloat(purchase_price)+parseFloat(tax_amount);
            purchase_price = parseFloat(purchase_price) - parseFloat(tax_amount);
            $('#tax_amount').val(tax_amount)

        }

        $('#purchase_price').val(purchase_price);
        $('#selling_price').val(total_amount);
        $('#retailer_price').val(total_amount);
        $('#wholesale_price').val(total_amount);
        $('#landing_cost').val(total_amount);
        $('#mrp').val(total_amount);
        $('#discount').val(0)
        $('#retailer_discount').val(0)
        $('#wholesale_discount').val(0)
        $('#selling_margin').val(0)
        $('#retailer_margin').val(0)
        $('#wholesale_margin').val(0)
    }
    $(document).on('change', '.product_price', function(e){
        var purchase_tax = $('#purchase_tax').val();
        var selling_price = $('#selling_price').val();
        var landing_cost = $('#landing_cost').val();
        var purchase_price = $('#purchase_price').val();
        var selling_margin = $('#selling_margin').val()
        var discount = $('#discount').val()


        var retailer_discount = $('#retailer_discount').val();
        var retailer_price = $('#retailer_price').val();
        var retailer_margin = $('#retailer_margin').val();

        var wholesale_discount = $('#wholesale_discount').val();
        var wholesale_price = $('#wholesale_price').val();
        var wholesale_margin = $('#wholesale_margin').val();

        var mrp = $('#mrp').val();
        if($(this).attr('id') == 'purchase_price') {
            initializeAmount()
            // if($('.is_purchase_tax').is(":checked")) {
            //     var purchase_tax = $('#purchase_tax').val();
            //     var purchase_price = $('#purchase_price').val();
            //     var tax_value = (parseFloat(purchase_price)*parseFloat(purchase_tax))/100;
            //     var total_price = purchase_price-tax_value
            //     $('#purchase_price').val(purchase_price-tax_value)
            // }
            // else {
               
            //     var purchase_price = $('#purchase_price').val();
            //     var tax_value = 0;
               
            //     if(purchase_tax == 0 && purchase_tax != null && purchase_tax != '') {

            //      tax_value = (parseFloat(purchase_price)*parseFloat(purchase_tax))/100;
            //     }
            //     var total_price = parseFloat(purchase_price)+parseFloat(tax_value);
            //     $('#selling_price').val(total_price);
            //     $('#landing_cost').val(total_price);
            //     $('#mrp').val(total_price);
            //     $('#retailer_price').val(total_price);
            //     $('#wholesale_price').val(total_price);
            //     $('#discount').val(0);
            //     $('#selling_margin').val(0);

              
            // }
        }
        else if($(this).attr('id') == 'mrp') {
            if(parseFloat(mrp) <= parseFloat(selling_price)) {
                
                selling_price = mrp;
                $('#selling_price').val(mrp)
                $('#discount').val(0);
                $('#selling_margin').val(parseFloat(selling_price)- parseFloat(purchase_price));
                
            }
            else {
            
                discount = parseFloat(mrp)- parseFloat(selling_price);
                
                $('#discount').val(discount);
                $('#selling_margin').val(parseFloat(selling_price)- parseFloat(purchase_price));
            }
            if(parseFloat(mrp) <= parseFloat(selling_price)) {
                
                retailer_price = mrp;
                $('#retailer_price').val(mrp)
                retailer_discount = parseFloat(mrp) - parseFloat(retailer_price);
                $('#retailer_discount').val(retailer_discount)
                $('#retailer_margin').val(parseFloat(retailer_price)- parseFloat(purchase_price));
            
            }
            else {
            
                retailer_discount = parseFloat(mrp)- parseFloat(retailer_price);
                
                $('#retailer_discount').val(retailer_discount);
                $('#retailer_margin').val(parseFloat(retailer_price)- parseFloat(purchase_price));
            }

            if(parseFloat(mrp) <= parseFloat(wholesale_price)) {
                
                wholesale_price = mrp;
                $('#wholesale_price').val(mrp)
                wholesale_discount = parseFloat(mrp) - parseFloat(wholesale_price);
                $('#wholesale_discount').val(wholesale_discount)
                $('#wholesale_margin').val(parseFloat(wholesale_price)- parseFloat(purchase_price));
                
            }
            else {
            
            wholesale_discount = parseFloat(mrp)- parseFloat(wholesale_price);
            
            $('#wholesale_discount').val(wholesale_discount);
            $('#wholesale_margin').val(parseFloat(wholesale_price)- parseFloat(purchase_price));
        }
          

         
           

        }
        else if($(this).attr('id') == 'selling_price') {
           
            if(parseFloat(landing_cost) > parseFloat(selling_price)) {
                $(this).val(landing_cost)
                    showMessage('Selling is smaller than landing cost')
            }

           else if(parseFloat(mrp) <= parseFloat(selling_price)) {
                selling_price = mrp
                $('#discount').val(0);
                $(this).val(mrp)
                $('#selling_margin').val(parseFloat(selling_price)- parseFloat(purchase_price));
                

            }
            else if(parseFloat(mrp) > parseFloat(selling_price)) {
                var discount = parseFloat(mrp)- parseFloat(selling_price);
                $('#discount').val(discount);
                $('#selling_margin').val(parseFloat(selling_price)- parseFloat(purchase_price));

            }

        }
        else if($(this).attr('id') == 'selling_margin') {
           
            if(parseFloat(selling_margin) > parseFloat(purchase_price)) {
                $('#selling_margin').val(parseFloat(selling_price)- parseFloat(purchase_price));

                showMessage('mrp is less than margin')
                
            }
            else {

                selling_price = parseFloat(purchase_price) + parseFloat(selling_margin)
              
    
                if(parseFloat(mrp) > parseFloat(selling_price)) {
                   var selling_price = parseFloat(mrp)- parseFloat(selling_price);
                   $('#discount').val(discount);
                   $('#selling_price').val(selling_price)
    
                   if(parseFloat(landing_cost) > parseFloat(selling_price)) {
                        $(this).val(landing_cost)
                       showMessage('Selling is smaller than landing cost')
                    }
    
                    else if(parseFloat(mrp) <= parseFloat(selling_price)) {
                        $('#selling_price').val(mrp)
                        //    $('#selling_margin').val(parseFloat(selling_price)- parseFloat(purchase_price));
    
                    }
    
               }
            }
        }
        else if($(this).attr('id') == 'discount') {
            if($(this).val() == '') {
                $(this).val(0)
                discount = 0;
            }

            selling_price = parseFloat(mrp) - parseFloat(discount)

             
            if(parseFloat(landing_cost) > parseFloat(selling_price)) {
                discount = 0;
                selling_price = parseFloat(mrp) - parseFloat(discount)

                showMessage('Selling is smaller than landing cost')
            }
          
            var selling_margin = parseFloat(selling_price)- parseFloat(purchase_price);
            $('#discount').val(discount);
            $('#selling_price').val(selling_price)
            $('#selling_margin').val(selling_margin)
       }
        else if($(this).attr('id') == 'retailer_price') {
           
           if(parseFloat(landing_cost) > parseFloat(retailer_price)) {
               $(this).val(landing_cost)
                   showMessage('retailer is smaller than landing cost')
           }

          else if(parseFloat(mrp) <= parseFloat(retailer_price)) {
               retailer_price = mrp
               $('#retailer_discount').val(0);
               $(this).val(mrp)
               $('#retailer_margin').val(parseFloat(retailer_price)- parseFloat(purchase_price));
               

           }
           else if(parseFloat(mrp) > parseFloat(retailer_price)) {
               var discount = parseFloat(mrp)- parseFloat(retailer_price);
               $('#retailer_discount').val(discount);
               $('#retailer_margin').val(parseFloat(retailer_price)- parseFloat(purchase_price));

           }

       }
       else if($(this).attr('id') == 'retailer_margin') {
          
           if(parseFloat(retailer_margin) > parseFloat(purchase_price)) {
               $('#retailer_margin').val(parseFloat(retailer_price)- parseFloat(purchase_price));

               showMessage('mrp is less than margin')
               
           }
           else {

               retailer_price = parseFloat(purchase_price) + parseFloat(retailer_margin)
             
   
               if(parseFloat(mrp) > parseFloat(retailer_price)) {
                  var retailer_price = parseFloat(mrp)- parseFloat(retailer_price);
                  $('#retailer_discount').val(discount);
                  $('#retailer_price').val(retailer_price)
   
                //   if(parseFloat(landing_cost) > parseFloat(retailer_price)) {
                //        $(this).val(landing_cost)
                //       showMessage('retailer is smaller than landing cost')
                //    }
   
                //    else 
                   if(parseFloat(mrp) <= parseFloat(retailer_price)) {
                       $('#retailer_price').val(mrp)
                       //    $('#selling_margin').val(parseFloat(selling_price)- parseFloat(purchase_price));
   
                   }
   
              }
           }
       }
       else if($(this).attr('id') == 'retailer_discount') {
            if($(this).val() == '') {
                $(this).val(0)
                retailer_discount = 0;
            }

            retailer_price = parseFloat(mrp) - parseFloat(retailer_discount)

             
            if(parseFloat(landing_cost) > parseFloat(retailer_price)) {
                retailer_discount = 0;
                retailer_price = parseFloat(mrp) - parseFloat(retailer_discount)

                showMessage('retailer is smaller than landing cost')
            }
          
            var retailer_margin = parseFloat(retailer_price)- parseFloat(purchase_price);
            $('#retailer_discount').val(retailer_discount);
            $('#retailer_price').val(retailer_price)
            $('#retailer_margin').val(retailer_margin)
       }
       else if($(this).attr('id') == 'wholesale_price') {
           
           if(parseFloat(landing_cost) > parseFloat(wholesale_price)) {
               $(this).val(landing_cost)
                   showMessage('wholesale is smaller than landing cost')
           }

          else if(parseFloat(mrp) <= parseFloat(wholesale_price)) {
               wholesale_price = mrp
               
               $('#wholesale_discount').val(0);
               $(this).val(mrp)
               $('#wholesale_margin').val(parseFloat(wholesale_price)- parseFloat(purchase_price));
               

           }
           else if(parseFloat(mrp) > parseFloat(wholesale_price)) {
               var discount = parseFloat(mrp)- parseFloat(wholesale_price);
               $('#wholesale_discount').val(discount);
               $('#wholesale_margin').val(parseFloat(wholesale_price)- parseFloat(purchase_price));

           }

       }
       else if($(this).attr('id') == 'wholesale_margin') {
          
           if(parseFloat(wholesale_margin) > parseFloat(purchase_price)) {
               $('#wholesale_margin').val(parseFloat(wholesale_price)- parseFloat(purchase_price));

               showMessage('mrp is less than margin')
               
           }
           else {

               wholesale_price = parseFloat(purchase_price) + parseFloat(wholesale_margin)
             
   
               if(parseFloat(mrp) > parseFloat(wholesale_price)) {
                  var wholesale_price = parseFloat(mrp)- parseFloat(wholesale_price);
                  $('#wholesale_discount').val(discount);
                  $('#wholesale_price').val(wholesale_price)
   
                   if(parseFloat(mrp) <= parseFloat(wholesale_price)) {
                       $('#wholesale_price').val(mrp)
   
                   }
   
              }
           }
       }
       else if($(this).attr('id') == 'wholesale_discount') {
            if($(this).val() == '') {
                $(this).val(0)
                wholesale_discount = 0;
            }

            wholesale_price = parseFloat(mrp) - parseFloat(wholesale_discount)

             
            if(parseFloat(landing_cost) > parseFloat(wholesale_price)) {
                wholesale_discount = 0;
                wholesale_price = parseFloat(mrp) - parseFloat(wholesale_discount)

                showMessage('wholesale is smaller than landing cost')
            }
          
            var wholesale_margin = parseFloat(wholesale_price)- parseFloat(purchase_price);
            $('#wholesale_discount').val(wholesale_discount);
            $('#wholesale_price').val(wholesale_price)
            $('#wholesale_margin').val(wholesale_margin)
       }
    });
    function showMessage(msg) {
        alert(msg)
    }

    $(document).on('change', '#product_type', function(e){
        if($(this).val() == 'simple') {
            $('#simple-product-section').show();
            $('#variant-product-section').hide();

        }
        else {
            $('#simple-product-section').hide();
            $('#variant-product-section').show();
        }
    })

    $(document).on('change', '.option_name_list', function(e){
        var myTag = $('option:selected', this).attr("data-values");
        var result =myTag.split(',');
        var list = '<option value="">Select Values</select>';
        $.each(result, function (index, value){
            list += `<option value="${value.trim()}">${value.trim()}</option>`;
            console.log(value.trim())
        })
        $(this).parents().eq(1).find('.option_value_list').html(list).attr('name', 'option_value_'+$(this).val()+"[]").attr('data-key', $(this).val())
    });

    $(document).on('click', '#add-more-variant-option', function(e){
        var option_list = JSON.parse('<?php print_r(json_encode($variant_attributes))?>')
        var list = "";
          $.each(option_list, function (index, value){
            list += `<option value="${value.id}" data-values="${value.options}">${value.lable}</option>`;
        })

        

        $('#variant_options').append(`<tr id="first_vairant">
                            <td class="w-20">
                                    <input type="text" name="variant_attributes[]" class="form-control">
                                   
                                </td>
                                <td>
                                    <select name="option_type[]" class="form-control"  id="">
                                        <option value="text">Text</option>
                                        <option value="image">Image</option>

                                    </select>
                                </td>
                                 <td >
                                    <input type="text" class="inputTag form-control" name="option_value[]">
                                </td>
                                  <td class="w-20">
                                    <button class="btn btn-sm btn-danger remove-variant"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>`)

        
        $(".inputTag").tagsinput('items');
       

    })

   

    
    $(document).on('click', '.remove-variant', function(e){
        $(this).parents().eq(1).remove()
        $('#total_variants').val($('.option_name_list').length)

    })

    $(document).on('change', '.option_value_list1', function(e){
            console.log($(this).val())
            $.ajax({
                type : 'get',
                url : '{{route("admin.variant-template")}}',
                data : $('.submit-form').serialize(),
                dataType : 'json',
                success : function(response) {
                    console.log(response, 'response')
                    $('#variant_options_rows').html(response.data)
                },
                error : function(error) {
                    console.log(error, 'error')
                }
            })
    })

    $(".inputTag").tagsinput('items');
</script>
@endsection
