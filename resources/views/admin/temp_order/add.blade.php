<?php $page="addtemporder";?>
@extends('layout.mainlayout')
@section('content')	
<div class="page-wrapper">
    <div class="content">
        @component('components.pageheader')                
			@slot('title') Temp Order Management @endslot
			@slot('title_1') Add/Update Temp Order @endslot
		@endcomponent
        <!-- /add -->
      
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('admin.temp-orders.store')}}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label">Full Name</label>
                                <input class="form-control" name="name" type="text" value="{{old('name')}}" required>
                                    @if ($errors->has('name'))
                                        <span class="error">
                                        <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label">Mobile Number</label>
                                <input class="form-control" name="mobile" type="text" value="{{old('mobile')}}" required>
                                @if ($errors->has('mobile'))
                                    <span class="error">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                       
                        <!-- <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label">Product</label>
                                <input list="products" class="form-control" name="product" id="searchProduct" autocomplete="off">
                                @if ($errors->has('product'))
                                    <span class="error">
                                    <strong>{{ $errors->first('product') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label">Quantity</label>
                                <input class="form-control" name="qty" type="text" value="{{old('qty')}}">
                                @if ($errors->has('qty'))
                                    <span class="error">
                                    <strong>{{ $errors->first('qty') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label">Price</label>
                                <input class="form-control" name="price" type="text" value="{{old('price')}}">
                                @if ($errors->has('price'))
                                    <span class="error">
                                    <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label">Total Amount</label>
                                <input class="form-control" name="amount" type="text" value="{{old('amount')}}">
                                @if ($errors->has('amount'))
                                    <span class="error">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->
    
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label class="col-form-label">Short notes </label>
                                <textarea name="notes" class="form-control" rows="5">{{old('notes')}}</textarea>
                                @if ($errors->has('notes'))
                                    <span class="error">
                                    <strong>{{ $errors->first('notes') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                        </div>
    
                        <table class="table" id="saleTable">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th style="min-width: 350px;">Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tdody>
                                <tr id="itemRow0" class="itemRow">
                                    <td>1.</td>
                                    <td> 
                                            <input type="text" name="items[0][item_name]" value="" class="form-control itemSearch" list="items"  id="items" autocomplete="off" required>
                                            <input type="hidden" name="items[0][item_id]" class="form-control itemId" id="itemId0">
                                            <input type="hidden" class="form-control itemName" id="itemName0">
                                            <span class="itemMsg text-danger" id="itemMsg0"></span>
                                    </td>
                                    <td><input type="text" name="items[0][item_price]" class="form-control itemPrice" id="itemPrice0" onkeypress="return isNumberKey(event)" required></td>
                                    
                                    <td><input type="number" name="items[0][item_qty]" class="form-control numbersOnly itemQty" id="itemQty0" data-id="0" value="1" required></td>
                                    <td><input type="text" name="items[0][item_total]" class="form-control itemTotal" id="itemTotal0" readonly required><input type="hidden" name="items[0][item_max_qty]" class="form-control itemMaxQty" id="itemMaxQty0" readonly required></td>
                                    <td><button type="button" class="btn btn-outline-info btn-ft btn-sm" data-id="1" id="add-row" onclick="add_rows();"><i class="fa fa-plus color-primary"></i></button>
                                    <input type="hidden" id="row_count" value="1">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="1" class="text-center"><b>Total</b></td>
                                    <td colspan="1"><input type="text" name="total" class="form-control" id="total" readonly></td>
                                    <td></td>
                                </tr>
    
                            </tdody>
                        </table>
                        
                        <div class="form-group row text-center">
                            <div class="col-lg-12"> 
                                <button type="submit" class="btn btn-primary mr-2">Save</button>
                                <button class="btn btn-light" type="reset">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
     
        <!-- /add -->
    </div>
</div>
@endsection
@section('scripts')
    <script>
        var currentRequest = null; 
load_js();
function load_js(){
    $( ".itemSearch" ).autocomplete({
      source: function( request, response ) {
        currentRequest =$.ajax({
        url: "{{ route('admin.search-produc') }}",
        type: 'post',
        dataType: "json",
        data: {
          search: request.term,
          "_token": "{{ csrf_token() }}",
        },
        beforeSend : function()    {           
            if(currentRequest != null) {
                currentRequest.abort();
            }
        },
        success: function( data ) {
          response( data );
        },
          error: function (err) {
                //alert("There were problems with input");				
          }
      });
    },
    select: function (event, ui) {
      //$('.itemSearch').val(ui.item.label); // display the selected text
      var item=ui.item;
      if(item){
        //let qty = item.qty;
        let qty = 1;
         let rate=(parseFloat(item.price)*parseInt(qty)).toFixed(2);
          $(".itemSearch", $(this).parents('tr')).val(item.label);
          $(".itemName", $(this).parents('tr')).val(item.label);
          $(".itemId", $(this).parents('tr')).val(item.value);
          $(".itemPrice", $(this).parents('tr')).val(item.price);
          $(".itemPrice", $(this).parents('tr')).attr('readonly', true);
          $(".itemQty", $(this).parents('tr')).val(qty);
          $(".itemMaxQty", $(this).parents('tr')).val(item.qty);
          $(".itemTotal", $(this).parents('tr')).val(rate);
          $(".itemMsg", $(this).parents('tr')).html('Registerd Product');
          invoice_total();
      }
      
      return false;
    }
  });
$(document).ready(function() {
    jQuery('.numbersOnly').keyup(function () { 
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
    $('.itemSearch').on('change keyup', function() {
        var name=$(this).val();
        if(name=='')
        {
            $(".itemId", $(this).parents('tr')).val('');
            $(".itemName", $(this).parents('tr')).val('');
            $(".itemPrice", $(this).parents('tr')).val('');
            $(".itemPrice", $(this).parents('tr')).attr('readonly', false);
            $(".itemQty", $(this).parents('tr')).val(1);
            $(".itemMaxQty", $(this).parents('tr')).val(1);
            $(".itemTotal", $(this).parents('tr')).val('');
            $(".itemMsg", $(this).parents('tr')).html('');
            //$('#total').val('0.00');
            invoice_total();
        }
        else{
            var product_name=$(".itemName", $(this).parents('tr')).val();
            if(name != product_name)
            {
                $(".itemId", $(this).parents('tr')).val('');
                $(".itemName", $(this).parents('tr')).val('');
                $(".itemPrice", $(this).parents('tr')).val('');
                $(".itemPrice", $(this).parents('tr')).attr('readonly', false);
                $(".itemQty", $(this).parents('tr')).val(1);
                $(".itemMaxQty", $(this).parents('tr')).val(1);
                $(".itemTotal", $(this).parents('tr')).val('');
                $(".itemMsg", $(this).parents('tr')).html('');
                //$('#total').val('0.00');
                invoice_total();
            }
        }
    });
    $('.itemPrice').on('change keyup', function() {
        $('.itemQty').trigger('change');
    });
    $('.itemQty').on('change keyup', function() {
    let id=$(this).data("id");
    let qty=$(this).val();
    if(qty=="" || qty==0 || qty>9999)
    {
        qty=1;
        $('#itemQty'+id).val(qty);
    }
    let price=$('#itemPrice'+id).val();
    if(qty && price)
    {
        let total = (parseFloat(price)*parseInt(qty)).toFixed(2);
        $('#itemTotal'+id).val(total);
        invoice_total();
    }
    
    });
});
}
function invoice_total(){
    let inputs = $(".itemTotal");
    let sum = 0;
    for(var i = 0; i < inputs.length; i++){
        let amount = $(inputs[i]).val();
        if(amount){
        sum = (parseFloat(sum) + parseFloat(amount)).toFixed(2);
        }
    }
   
    if(sum){
        $('#total').val(sum);
    }
}

        function add_rows(){
            let index =$('#row_count').val();
            let rowCount = $('#saleTable tr.itemRow').length;
            if(rowCount>=15)
            {
                alert('More then 15 items not allowed');
                return false;
            }
            let sr=parseInt(index)+1;
            let old_sr=parseInt(index)-1;
            let html='<tr id="itemRow'+index+'" class="itemRow"><td>'+sr+'.</td><td><input type="text" name="items['+index+'][item_name]" value="" class="form-control itemSearch" list="items" id="item'+index+'" autocomplete="off" required> <input type="hidden" class="form-control itemName" id="itemName'+index+'"> <input type="hidden" name="items['+index+'][item_id]" class="form-control itemId" id="itemId'+index+'"><span class="itemMsg text-danger" id="itemMsg'+index+'"></span></td></td><td><input type="text" name="items['+index+'][item_price]" class="form-control itemPrice" id="itemPrice'+index+'" onkeypress="return isNumberKey(event)" required></td><td><input type="number" name="items['+index+'][item_qty]" class="form-control numbersOnly itemQty" id="itemQty'+index+'" data-id="'+index+'" value="1" required></td><td><input type="text" name="items['+index+'][item_total]" class="form-control itemTotal" id="itemTotal'+index+'" readonly required><input type="hidden" name="items['+index+'][item_max_qty]" class="form-control itemMaxQty" id="itemMaxQty'+index+'" readonly required></td><td><button type="button" class="btn btn-outline-danger btn-ft btn-sm" id="item-btn-'+index+'" onclick="remove_row('+index+');"><i class="fa fa-minus color-primary"></i></button></td></tr>';
            $('#row_count').val(sr);
            $('.itemRow').last().after(html);
            update_rows();
            load_js();
            }
            function remove_row(index){
            $('#itemRow'+index).remove();
            update_rows();
            invoice_total();
            }
            function update_rows()
            {
            $("#saleTable tr.itemRow td:first-child").each(function(index){
                $(this).text(index+1);
            });
            }
            function isNumberKey(evt)
            {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31 
                && (charCode < 48 || charCode > 57))
                return false;
            return true;
            }
        </script>
@endsection