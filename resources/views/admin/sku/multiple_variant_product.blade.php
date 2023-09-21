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
                            @if($product->product_type != 'simple')
                            <li>
                                <a href="{{route('admin.product-multiple-variant',[$product->id])}}" class="btn btn-sm btn-primary">Add New</a>
                            </li>
                            <li>
                                <a href="{{route('admin.product-multiple-variant',[$product->id, 'edit'])}}" class="btn btn-sm btn-primary">Bulk Update</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- /Filter -->
               
                <!-- /Filter -->
                <form action="{{route('admin.add-product-variants',[$product->id])}}" method="post" class="submit-form">
                    @csrf
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    @if($product->product_type != 'simple')
                                    <th>Variant</th>
                                    @endif
                                    <th>Item Code/Barcode</th>
                                    <th>Minimum Qty</th>
                                    {{-- <th>Opening Qty</th> --}}
                                    <th>Purchase Price</th>
                                    <th>Landing Cost</th>
                                    <th>MRP</th>
                                    <th>Customer Price</th>
                                    <th>Wholesale Price</th>
                                    <th>Retailer Price</th>

                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody id="multiple-variant-list">
                                @foreach ($skus as $sku)
                                @include('admin.sku.multiple_variant_product_template')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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