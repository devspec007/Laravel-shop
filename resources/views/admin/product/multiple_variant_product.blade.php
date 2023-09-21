<?php $page="productlist";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Product List @endslot
			@slot('title_1') Manage your products @endslot
		@endcomponent
        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                    </div>
                    <div class="wordset">
                        <ul>
                            @if($type == 'add')
                            <li>
                                <button class="btn btn-sm btn-primary add-more-variants">Add New</button>
                            </li>
                            @endif
                          
                        </ul>
                    </div>
                </div>
                <!-- /Filter -->
               
                <!-- /Filter -->
                @if($type == 'add')
                <form action="{{route('admin.add-product-variants',[$product->id])}}" method="post" class="submit-form">
                    @else
                <form action="{{route('admin.update-product-variants',[$product->id])}}" method="post" class="submit-form">

                    @endif
                    @csrf
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
                                    @if($type != 'edit')

                                    <th>Opening Qty</th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody id="multiple-variant-list">
                                @if($type == 'edit')
                                    @if(count($product->varaints) > 0)
                                        @foreach ($product->varaints as $sku)
                                        @include('admin.product.existing_variant_product_template')

                                        @endforeach
                                    @endif
                                @else
                                @include('admin.product.multiple_variant_product_template')

                                @endif
                                
    
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <!-- /product list -->
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).on('click', '.add-more-variants', function(e){
            e.preventDefault();
            $.ajax({
                type : 'get',
                url : '{{route("admin.product-multiple-variant-template",[$product->id])}}',
                dataType : 'json',
                success : function(response) {
                    $('#multiple-variant-list').append(response.data)
                    $("select").select2()

                }
            })
        })

        $(document).on('click', '.remove-varaints', function(e){
            e.preventDefault();
            $(this).parents().eq(1).next().remove()
            $(this).parents().eq(1).remove()
        })
    </script>
@endsection