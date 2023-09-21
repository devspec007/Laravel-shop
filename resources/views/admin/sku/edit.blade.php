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
        <form action="{{route('admin.sku.update',[$product_id, $sku->id])}}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                        
                            </div>
                        </div>
                       
        <div class="col-lg-12 col-sm-12 col-12">
            <div class="form-group">
                <label>Variant Detail</label>
                <input class="form-control" disabled value="
                @foreach ($sku->productAttributes as $key => $option)
                            {{$option->attribute->lable ?? ''}} : {{$option->attribute_value}} @if(count($sku->productAttributes)-1 > $key) / @endif
                        @endforeach
                ">
                <div class="text-danger form-error" id="sku_error"></div>
            </div>
        </div>
                       
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>SKU</label>
                                <input type="text" name="sku" value="{{$sku->sku}}">
                                <div class="text-danger form-error" id="sku_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Minimum Qty</label>
                                <input type="text" name="minimum_quantity" value="{{$sku->minimum_quantity}}">
                                <div class="text-danger form-error" id="minimum_quantity_error"></div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="quantity" value="{{$sku->quantity}}">
                                <div class="text-danger form-error" id="quantity_error"></div>
                            </div>
                        </div> --}}
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Purchase Price</label>
                                <input type="text" name="purchase_price" value="{{$sku->purchase_price}}">
                                <div class="text-danger form-error" id="purchase_price_error"></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>MRP</label>
                                <input type="text" name="mrp" value="{{$sku->mrp}}">
                                <div class="text-danger form-error" id="mrp_error"></div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Tax (%)</label>
                                <input type="text" name="tax" value="{{$sku->tax}}"> 
                                <div class="text-danger form-error" id="tax_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount Type (%)</label>
                                <input type="text" name="discount" value="{{$sku->discount}}">
                                <div class="text-danger form-error" id="discount_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="price" value="{{$sku->regular_price}}">
                                <div class="text-danger form-error" id="price_error"></div>
                            </div>
                        </div> --}}
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>	Status</label>
                                <select class="select" name="status">
                                    <option value="active" {{$sku->status == 'active' ? 'selected' : ''}}>Active</option>
                                    <option value="inactive"  {{$sku->status == 'inactive' ? 'selected' : ''}}>Inactive</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr>
                            <h5>Customer Price</h5>
                            <hr>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount Type</label>
                                <select class="select customer-discount" id="discount_type" name="discount_type">
                                    <option value="">Select Discount Type</option>
                                    @foreach (discountType() as $key => $value)
                                        
                                    <option value="{{$key}}" {{$sku->discount_type == $key ? 'selected' : ''}}>{{$value}}</option>
                                    @endforeach

                                </select>
                                <div class="text-danger form-error" id="discount_type_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount</label>
                                <input class="form-control customer-discount" id="discount" type="text" name="discount" value="{{$sku->discount}}">
                                <div class="text-danger form-error" id="discount_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="price" class="customer-discount" id="price" value="{{$sku->price}}">
                                <div class="text-danger form-error" id="price_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Regular Price</label>
                                <input type="text" name="regular_price" id="regular_price" value="{{$sku->regular_price}}" disabled>
                                <div class="text-danger form-error" id="regular_price_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>	Enable For Customer</label>
                                <select class="select" name="customer_status">
                                    <option value="1" {{$sku->enable_for_customer == 1 ? 'selected' : ''}}>Yes</option>
                                    <option value="2" {{$sku->enable_for_customer == 2 ? 'selected' : ''}}>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount Start date</label>
                                <input type="date" class="form-control" name="discount_start_date" value="{{$sku->discount_start_date}}">
                                <div class="text-danger form-error" id="discount_start_date_error"></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount End date</label>
                                <input type="date" class="form-control" name="discount_end_date" value="{{$sku->discount_end_date}}">
                                <div class="text-danger form-error" id="discount_end_date_error"></div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr>
                            <h5>Wholesale Price</h5>
                            <hr>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount Type</label>
                                <select class="select wholesale-discount" id="wholesale_discount_type" name="wholesale_discount_type">
                                    <option value="">Select Discount Type</option>
                                    @foreach (discountType() as $key => $value)
                                    <option value="{{$key}}" {{$sku->wholesale_discount_type == $key ? 'selected' : ''}}>{{$value}}</option>
                                    @endforeach

                                </select>
                                <div class="text-danger form-error" id="wholesale_discount_type_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount</label>
                                <input class="form-control wholesale-discount" id="wholesale_discount" type="text" name="wholesale_discount" value="{{$sku->wholesale_discount}}">
                                <div class="text-danger form-error" id="wholesale_discount_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="wholesale_price" class="wholesale-discount" id="wholesale_price" value="{{$sku->wholesale_price}}">
                                <div class="text-danger form-error" id="wholesale_price_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Regular Price</label>
                                <input type="text" name="wholesale_regular_price" id="wholesale_regular_price" value="{{$sku->wholesale_regular_price}}" disabled>
                                <div class="text-danger form-error" id="wholesale_regular_price_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>	Enable For Wholesale</label>
                                <select class="select" name="wholesale_status">
                                    <option value="1" {{$sku->enable_for_wholesale == 1 ? 'selected' : ''}}>Yes</option>
                                    <option value="2" {{$sku->enable_for_wholesale == 1 ? 'selected' : ''}}>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount Start date</label>
                                <input type="date" class="form-control" name="wholesale_discount_start_date" value="{{$sku->wholesale_discount_start_date}}">
                                <div class="text-danger form-error" id="wholesale_discount_start_date_error"></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount End date</label>
                                <input type="date" class="form-control" name="wholesale_discount_end_date" value="{{$sku->wholesale_discount_end_date}}">
                                <div class="text-danger form-error" id="wholesale_discount_end_date_error"></div>
                            </div>
                        </div>
                      
                       
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>	Product Image</label>
                                <div class="image-upload">
                                    <input type="file" name="images[]" multiple class="dropify">
                                    
                                </div>
                            </div>
                            <div class="text-danger form-error" id="images_error"></div>

                        </div>
                        <h4>Vairant Attributes </h4>
                      
                       <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Attribute</th>
                                    <th>Attributes Value</th>
                                  

                                </tr>
                                <tbody id="attribute_list">
                                    @php
                                        $product_attributes = ($sku->productAttributes)->toArray();
                                        $ids = array_column($product_attributes, 'attribute_id')
                                    @endphp
                                    @foreach($attributes as $attribute)
                                    @php
                                    $options = [];
                                        if($attribute)  {
                                           
                                            $options = explode(',', $attribute->options);
                                        }

                                        $index = array_search($attribute->id, $ids);
                                        $selected_data = isset($product_attributes[$index]) ? $product_attributes[$index]['attribute_value'] : '';
                                    
                                    @endphp   
                                    <tr>
                                        <td>
                                           
                                           
                                            <input type="hidden"  name="attribute[]" value="{{$attribute->id}}">
                                            <input type="text" class="form-control" disabled value="{{$attribute->lable}}">
                                        </td>
                                        <td>
                                            <select name="option[]" class="select options" id="">
                                                <option value="">Select Option</option>
                                                @foreach ($options as $option)
                                                <option value="{{trim($option)}}" {{trim($selected_data)== trim($option) ? 'selected' : ''}}>{{$option}}</option>
                                                    
                                                @endforeach
                                            </select>
                                        </td>
                                       
                                    </tr>
                                    @endforeach


                                    
                                </tbody>
                            </table>
                       </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('admin.sku.index',[$product_id])}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /add -->
        </form>
    </div>
</div>		
@endsection

@section('scripts')
    <script>
        var attribute_data = <?php print_r(json_encode($attributes)); ?>;
    </script>
@endsection
	  