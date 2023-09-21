<?php $page="editproduct";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Product Edit @endslot
			@slot('title_1') Update your product @endslot
		@endcomponent
        <!-- /add -->
        <form action="{{route('admin.product.update',[$product->id])}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="name" value="{{$product->name}}">
                                <div class="text-danger form-error" id="name_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Print Name</label>
                                <input type="text" name="display_name" value="{{$product->display_name}}">
                                <div class="text-danger form-error" id="display_name_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>HSN No.</label>
                                <input type="text" name="hsn_code" value="{{$product->hsn_code}}">
                                <div class="text-danger form-error" id="hsn_code_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Expiry Months </label>
                                <input type="numeric" name="expiry_months" class="form-control" value="{{$product->expiry_months}}">
                                <div class="text-danger form-error" id="expiry_months_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select UOM</label>
                                <select class="select" name="unit_type_id">
                                    <option value="">Choose UOM</option>
                                    @foreach ($units as $unit)
                                    <option value="{{$unit->id}}" {{$product->unit_type_id == $unit->id ? 'selected' : ''}}>{{$unit->name}}</option>
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
                                    <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
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
                                    
                                    @foreach ($product->category->childCategory as $category)
                                    <option value="{{$category->id}}" {{$product->subcategory_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                    @endforeach
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
                                    <option value="{{$brand->id}}" {{$product->brand_id == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
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
                                    @foreach ($product->brand->childs as $brand)
                                    <option value="{{$brand->id}}" {{$product->sub_brand_id == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                                        
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="sub_brand_error"></div>
                            </div>
                        </div>


                        
                              
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>	Status</label>
                                <select class="select" name="status">
                                    @foreach (statusList() as $key => $status)
                                        
                                    <option value="{{$key}}" {{$product->status == $key ? 'selected' : ''}}>{{$status}}</option>
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
                                    <option value="{{$tax['value']}}" {{$product->purchase_tax == $tax['value'] ? 'selected' : ''}}>{{$tax['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                         <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>	Sale Tax</label>
                                <select class="select" name="sale_tax">
                                    <option value="">Select Tax</option>
                                    @foreach(saleTax() as $tax)
                                    <option value="{{$tax['value']}}" {{$product->sale_tax == $tax['value'] ? 'selected' : ''}}>{{$tax['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       
                      
                       
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>	Net Weight</label>
                                <input class="form-control" name="net_weight" id="net_weight" value="{{$product->net_weight}}">
                                <div class="text-danger form-error" id="net_weight_error"></div>

                            </div>
                        </div>

                        

                        <div class="col-md-3">
                            <div class="form-group">
                                <label><input type="checkbox"  class="is_purchase_tax"  name="is_purchase_tax" {{$product->is_purchase_tax == 1 ? 'checked' : ''}} >	Purchase Tax Including</label>

                                {{-- <label><input type="checkbox " name="is_purchase_tax" {{$product->is_purchase_tax == 1 ? 'checked' : ''}}>	Purchase Tax Including</label> --}}
                                <label><input type="checkbox" name="is_sale_tax" {{$product->is_sale_tax == 1 ? 'checked' : ''}}>	Sale Tax Including</label>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                        
                            <div class="form-group">
                                <label>Short Description</label>
                                <textarea class="form-control editor" name="short_description">{{$product->short_description}}</textarea>
                                <div class="text-danger form-error" id="short_description_error"></div>
                            </div>
                           
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control ck-editor" name="product_description">{{$product->description}}</textarea>
                                <div class="text-danger form-error" id="product_description_error"></div>
                            </div>
                        </div>

                       
                 
                       
                       
                    </div>
                </div>
            </div>
            @if($product->product_type == 'simple')
            <div class="card" id="simple-product-section">
                <div class="card-header">
                    <h4>Price Details</h4>
                </div>
                <div class="card-body">
                  
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input type="text" name="sku" value="{{$product->varaint->sku ?? ''}}">
                                    <div class="text-danger form-error" id="sku_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Minimum Qty</label>
                                    <input type="text" name="minimum_quantity"  value="{{$product->varaint->minimum_quantity ?? ''}}">
                                    <div class="text-danger form-error" id="minimum_quantity_error"></div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-2 col-sm-6 col-12 update_inventory-section">
                                <div class="form-group">
                                    <label>Opening Quantity</label>
                                    <input type="text" name="quantity" value="{{$product->varaint->quantity ?? ''}}">
                                    <div class="text-danger form-error" id="quantity_error"></div>
                                </div>
                            </div> --}}
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Purchase Price</label>
                                    <input type="text" name="purchase_price" value="{{$product->varaint->purchase_price ?? ''}}"  id="purchase_price" class="product_price">
                                    <div class="text-danger form-error" id="purchase_price_error"></div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Landing Cost</label>
                                    <input type="text" name="landing_cost" value="{{$product->varaint->landing_cost ?? ''}}"  id="landing_cost" class="product_price">
                                    <div class="text-danger form-error" id="landing_cost_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>MRP</label>
                                    <input type="text" name="mrp" value="{{$product->varaint->mrp ?? ''}}"  id="mrp" class="product_price">
                                    <div class="text-danger form-error" id="mrp_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Selling Discount</label>
                                    <input type="text" name="discount" value="{{$product->varaint->discount ?? ''}}"  id="discount" class="product_price">
                                    <div class="text-danger form-error" id="discount_error"></div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Selling Price</label>
                                    <input type="text" name="price" value="{{$product->varaint->price ?? ''}}"  id="selling_price" class="product_price">
                                    <div class="text-danger form-error" id="price_error"></div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Selling Margin</label>
                                    <input type="text" name="selling_margin" value="{{$product->varaint->selling_margin ?? ''}}"  id="selling_margin" class="product_price">
                                    <div class="text-danger form-error" id="selling_margin_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Retailer Discount</label>
                                    <input type="text" name="retailer_discount" value="{{$product->varaint->retailer_discount ?? ''}}" id="retailer_discount" class="product_price">
                                    <div class="text-danger form-error" id="retailer_discount_error"></div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Retailer Price</label>
                                    <input type="text" name="retailer_price" value="{{$product->varaint->retailer_price ?? ''}}" id="retailer_price" class="product_price">
                                    <div class="text-danger form-error" id="retailer_price_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Retailer Margin</label>
                                    <input type="text" name="retailer_margin" value="{{$product->varaint->retailer_margin ?? ''}}" id="retailer_margin" class="product_price">
                                    <div class="text-danger form-error" id="retailer_margin_error"></div>
                                </div>
                            </div>
                            
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Wholesale Discount</label>
                                    <input type="text" name="wholesale_discount" value="{{$product->varaint->wholesale_discount ?? ''}}" id="wholesale_discount" class="product_price">
                                    <div class="text-danger form-error" id="wholesale_discount_error"></div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Wholesale Price</label>
                                    <input type="text" name="wholesale_price" value="{{$product->varaint->wholesale_price ?? ''}}"  id="wholesale_price" class="product_price">
                                    <div class="text-danger form-error" id="wholesale_price_error"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Wholesale Margin</label>
                                    <input type="text" name="wholesale_margin" value="{{$product->varaint->wholesale_margin ?? ''}}"  id="wholesale_margin" class="product_price">
                                    <div class="text-danger form-error" id="wholesale_margin_error"></div>
                                </div>
                            </div>
                </div>
            </div>
            @else
            {{-- <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Purchase price</th>
                                        <th>Landing Cost</th>
                                        <th>MRP</th>
                                        <th>Selling Discount</th>
                                        <th>Selling Price</th>
                                        <th>Selling Margin</th>
                                        <th>Retailer Discount</th>
                                        <th>Retailer Price</th>
                                        <th>Retailer Margin</th>
                                        <th>Wholesale Discount</th>
                                        <th>Wholesale Price</th>
                                        <th>Wholesale Margin</th>
                                        <th>Minimum Qty</th>
                                        
    
                                    </tr>
                                </thead>
                                <tbody id="multiple-variant-list">
                                    @if(count($product->varaints) > 0)
                                    @foreach ($product->varaints as $sku)
                                    @include('admin.product.existing_variant_product_template')

                                    @endforeach
                                @endif
                                    
        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Ecommerce Details</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>E-commerce Category</label>
                                <select class="select" name="ecom_category[]" multiple  >
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{in_array($category->id, $product_categories) ? 'selected' : ''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="ecom_category_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="slug" value="{{$product->slug}}">
                                <div class="text-danger form-error" id="slug_error"></div>
                            </div>
                        </div>
                        <div class="row" style="clear:both;">
                            {{-- <div class="col-md-3">
                               <label class="col-form-label"><input type="checkbox" name="cod_available" {{$product->cod_available == 1 ? 'checked' : ''}}> :cod_available</label>
                           </div>
                            <div class="col-md-3">
                               <label class="col-form-label"><input type="checkbox" name="online_payment_available" {{$product->online_payment_available == 1 ? 'checked' : ''}}> :online_payment_available</label>
                           </div> --}}
                           
                           <div class="col-md-3">
                            <label class="col-form-label"><input type="checkbox" name="is_popular" {{$product->is_popular == 1 ? 'checked' : ''}}> :is_popular</label>
                        </div>
                           <div class="col-md-3">
                            <label class="col-form-label"><input type="checkbox" name="is_featured" {{$product->is_featured == 1 ? 'checked' : ''}}> :is_featured</label>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label"><input type="checkbox" name="is_new" {{$product->is_new == 1 ? 'checked' : ''}}> :is_new</label>
                        </div>
                           
                           <div class="col-md-3">
                               <label class="col-form-label"><input type="checkbox" name="is_hot_product" {{$product->is_hot_product == 1 ? 'checked' : ''}}> :is_hot_product</label>
                           </div>
                           <div class="col-md-3">
                               <label class="col-form-label"><input type="checkbox" name="is_best_seller_offers" {{$product->is_best_seller_offers == 1 ? 'checked' : ''}}> :is_best_seller_offers</label>
                           </div>
                           <div class="col-md-3">
                               <label class="col-form-label"><input type="checkbox" name="is_repair_tool_offers"  {{$product->is_repair_tool_offers == 1 ? 'checked' : ''}}> :is_repair_tool_offers</label>
                           </div>
                           <div class="col-md-3">
                               <label class="col-form-label"><input type="checkbox" name="is_accessories_offers" {{$product->is_accessories_offers == 1 ? 'checked' : ''}}> :is_accessories_offers</label>
                           </div>
                       </div>
                       <div class="row" style="clear:both;">
                            <div class="col-md-3">
                                <label class="col-form-label"><input type="checkbox" name="is_spare_part_offers" {{$product->is_spare_part_offers == 1 ? 'checked' : ''}}> :is_spare_part_offers</label>
                            </div>
                            <div class="col-md-3">
                                <label class="col-form-label"><input type="checkbox" name="is_top_offers" {{$product->is_top_offers == 1 ? 'checked' : ''}}> :is_top_offers</label>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" value="{{$meta_details['meta_title'] ?? ''}}">
                                <div class="text-danger form-error" id="meta_title_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Meta Keyword</label>
                                <textarea type="text" name="meta_keywords">{{$meta_details['meta_keywords'] ?? ''}}</textarea>
                                <div class="text-danger form-error" id="meta_keywords_error"></div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea class="form-control" name="meta_description">{{$meta_details['meta_description'] ?? ''}}</textarea>
                                <div class="text-danger form-error" id="meta_description_error"></div>
                            </div>
                        </div>
                         
                        
                     
                       
                      
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <button type="submit" class="btn btn-submit me-2">Submit</button>
                <a href="{{route('admin.product.index')}}" class="btn btn-cancel">Cancel</a>
            </div>
        <!-- /add -->
        </form>
        <!-- /add -->
    </div>
</div>
@endsection
@section('scripts')
    <script>
            CKEDITOR.replace( 'short_description' );
    CKEDITOR.replace( 'product_description' );

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
        if($('.is_purchase_tax').is(":checked") && purchase_tax != 0 && purchase_tax != '') {
            var tax_amount = (parseFloat(purchase_price)*parseFloat(purchase_tax))/100;
            total_amount = parseFloat(purchase_price)+parseFloat(tax_amount);
            purchase_price = parseFloat(purchase_price) - parseFloat(tax_amount);
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



    </script>
@endsection