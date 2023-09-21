<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
  
    <style>
    @page { margin: 180px 50px; }
    #header { position: fixed; left: 0px; right: 0px; height: 105px; top:-150px; background-color: orange; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; background-color: lightblue; }
    #footer .page:after { content: counter(page, upper-roman); }
    h1 {
        height: 14px;
        
    font-size: 23px;

    }
    .content {
        position: absolute;
    top: -20px;
    width: 100%;
    }
    .row {
        display: flex;
        width: 100%;
    }
    .col-6 {
        width: 50%;
    }
    table, td, th {
  border: 1px solid;
  padding : 10px;
}

table {
  width: 100%;
  border-collapse: collapse;
}   
thead th{
font-size: 10px;
}
tfoot th{
font-size: 10px;
}
tbody td{
font-size: 10px;
}
</style>
  
</head>
<body>
    <div id="header">
        <h1>Saledepot</h1>
        <p>0, Rupmahal Tank, B.T. ROAD, Imphal, Imphal WestImphal-795001 <br>
             Email : manish.saledepot@gmail.com | Contact No. : 8447216569 <br>
              State : Manipur(14)</p>
    </div>
    @php
        $total_tax = 0;
        $amount = 0;
    @endphp
    <div class="content">
        <table style="width:100%">
            <tr>
                <td colspan="5" style="font-size:14px;">
                    To, <br>
                    {{$purchase->supplier->name ?? ''}} <br>
                    @if($purchase->supplier->profile)
                    {{$purchase->supplier->profile->address}}.- <br>
                    {{$purchase->supplier->profile->state->name ?? '    '}}({{$purchase->supplier->profile->city->name ?? ''}}), India
                    @endif
                </td>
                <td colspan="6" style="font-size:14px;">
                    Purchase Order No. : {{$purchase['refrence_number']}} <br>
                    Purchase Order Date : {{dateFormat($purchase['purchase_date'])}} <br>
       
                        Date of Supply :{{dateFormat($purchase['supplier_date'])}} <br>
                        @if($purchase->supplier->profile)
                        Place of Supply : {{$purchase->store->profile->state->name ?? '    '}}({{$purchase->store->profile->city->name ?? ''}}) <br>
                        @endif
                </td>
            </tr>
            <thead style="margin-top:10px;">
                <tr>
                    <th>#</th>
                    <th>Itemcode</th>
                    <th>Description</th>
                    <th>HSN</th>
                    <th>Qty</th>
                    <th>MRP</th>
                    <th>Rate</th>
                    <th>Tax</th>
                    <th>Tax Rate </th>
                    <th>Landing Cost</th>
                    <th>Total</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($purchase->purchaseItems as $key => $item)
                @php
                    $total_tax +=$item->unit_tax*$item->quantity;
                    $amount += $item->unit_price*$item->quantity;
                @endphp
                <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->sku->sku}}</td>
                <td>{{$item->product->name}}</td>
                <td>{{$item->product->hsn}}</td>
                <td>{{$item->quantity }}</td>
                <td>{{$item->mrp }}</td>
                <td>{{$item->unit_price}}</td>
                <td>{{$item->unit_tax}}</td>

                <td>{{$item->purchase_tax }}% </td>
                <td>{{$item->unit_price+$item->unit_tax}}</td>
                    
                <td>{{$item->total_price}}</td>
            </tr>
                @endforeach
            </tbody>
            <tfoot>
                {{-- <tr>
                    <th></th>
                    <th></th>
                    <th>Total : </th>
                    <th></th>
                    <th>{{$purchase->total_quantity}}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>{{$purchase->total_amount}}</th>

                </tr> --}}
                <tr>
                    <th colspan="9"></th>
                    <th>Total Quantity</th>
                    <th>{{$purchase->total_quantity}}</th>
                </tr>
                <tr>
                    <th colspan="9"></th>
                    <th>Amount</th>
                    <th>{{$amount}}</th>
                </tr>
                <tr>
                    <th colspan="9"></th>
                    <th>Total Tax</th>
                    <th>{{$total_tax}}</th>
                </tr>
                <tr>
                    <th colspan="9"></th>
                    <th>Net Amount</th>
                    <th>{{$purchase->total_amount}}</th>
                </tr>
                <tr>
                    <th colspan="11" align="right">{{numberToWord($purchase->total_amount)}}</th>
                </tr>
                <tr>
                    <th  colspan="9">Note : {{$purchase->note}}</th>
                    <th colspan="2">Signature</th>
                </tr>
            </tfoot>
           
           
        </table>
        {{-- <table>
                        
            <thead style="margin-top:10px;">
                <th colspan="7" align="center">
                    TAX SUMMARY
                </th>
                <tr>
                    <th rowspan="2">Sr. No.</th>
                    <th rowspan="2">HSN / SAC </th>
                    <th  rowspan="2">TAXABLE VALUE</th>
                    <th colspan="2">INTEGRATED TAX </th>
                    <th colspan="2">N.A.</th>

                </tr>
                <tr>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th>Rate</th>
                    <th>AMount</th>
                </tr>
            </thead>
        </table> --}}
       
    </div>
    
</body>
</html>