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
        $amount = 0;
        $quantity = 0;
    @endphp
    <div class="content">
        <table style="width:100%">
            <tr>
                <td colspan="5" style="font-size:14px;">
                    From, <br>
                    {{$inward->supplier->name ?? ''}} <br>
                    @if($inward->supplier->profile)
                    {{$inward->supplier->profile->address}}.- <br>
                    {{$inward->supplier->profile->state->name ?? '    '}}({{$inward->supplier->profile->city->name ?? ''}}), India
                    @endif
                </td>
                <td colspan="6" style="font-size:14px;">
                    No. : {{$inward['inward_no']}} <br>
                    Date : {{dateFormat($inward['created_at'])}} <br>
                    <br>Vehicle/L.R. No :  <br>
       
                        Date of Supply :{{dateFormat($inward['supplier_date'] ?? '')}} <br>
                        @if($inward->supplier->profile)
                        Place of Supply : {{$inward->store->profile->state->name ?? '    '}}({{$inward->store->profile->city->name ?? ''}}) <br>
                        @endif
                        Payment Term :

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
                @foreach ($inward->inwardItems as $key => $item)
                @php
                    $amount += $item->purchaseItem->unit_price*$item->received_quantity;
                    $quantity +=$item->received_quantity;

                @endphp
                <tr>
                <td>{{$key+1}}</td>
                @if($item->sku)
                <td>{{$item->sku->sku}}</td>
                <td>{{$item->sku->product->name}}</td>
                <td>{{$item->sku->product->hsn}}</td>
                @else
                <td></td>
                <td></td>
                <td></td>

                @endif
                <td>{{$item->received_quantity }}</td>
                <td>{{$item->purchaseItem->mrp }}</td>
                <td>{{$item->purchaseItem->unit_price}}</td>
                <td>{{$item->purchaseItem->unit_tax}}</td>

                <td>{{$item->purchaseItem->purchase_tax }}% </td>
                <td>{{$item->purchaseItem->unit_price+$item->purchaseItem->unit_tax}}</td>
                    
                <td>{{$item->amount+($item->received_quantity*$item->purchaseItem->unit_tax)}}</td>
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
                    <th>{{$quantity}}</th>
                </tr>
                <tr>
                    <th colspan="9"></th>
                    <th>Amount</th>
                    <th>{{$amount}}</th>
                </tr>
                <tr>
                    <th colspan="9"></th>
                    <th>Total Tax</th>
                    <th>{{$inward->tax_amount}}</th>
                </tr>
                <tr>
                    <th colspan="9"></th>
                    <th>Net Amount</th>
                    <th>{{$inward->total_amount}}</th>
                </tr>
                <tr>
                    <th colspan="11" align="right">{{numberToWord($inward->total_amount)}}</th>
                </tr>
                <tr>
                    <th align="left"  colspan="9">Note : {{$inward->note}}</th>
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