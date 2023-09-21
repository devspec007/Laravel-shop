
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="name[]" required>
                                <div class="text-danger form-error" id="name_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="select filter-category" name="category[]" required>
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
                                <select class="select sub-category-list" name="subcategory[]" required>
                                    <option value="">Choose Sub Category</option>
                                </select>
                                <div class="text-danger form-error" id="subcategory_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Brand</label>
                                <select class="select" name="brand[]" required>
                                    <option value="">Choose Brand</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger form-error" id="brand_error"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12" style="display: none;">
                            <div class="form-group">
                                <label>	Product Type</label>
                                <select class="select" name="product_type[]" required>
                                    {{-- <option value="simple">Simple</option> --}}
                                    <option value="variant">Variant</option>
                                </select>
                            </div>
                        </div>

                        
                       
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>SKU</label>
                                <input type="text" name="sku[]" required>
                                <div class="text-danger form-error" id="sku_error"></div>
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
                       
                       
                       
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="numeric" name="price[]" class="form-control">
                                <div class="text-danger form-error" id="price_error"></div>
                            </div>
                        </div>
                        
                       
                       
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Expiry Months </label>
                                <input type="numeric" name="expiry_months[]" class="form-control">
                                <div class="text-danger form-error" id="expiry_months_error"></div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>	Status</label>
                                <select class="select" name="status[]">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description[]"></textarea>
                                <div class="text-danger form-error" id="description_error"></div>
                            </div>
                        </div>
                       
                       
                    </div>
                </div>
            </div>
            
            <script>
                $("select").select2()

            </script>