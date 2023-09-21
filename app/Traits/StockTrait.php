<?php

namespace App\Traits;

use App\Models\Purchase;
use App\Models\PurchaseInward;
use App\Models\User;
use App\Models\UserProfile;
use Auth;
use Illuminate\Http\Request;

trait StockTrait
{
    public function getSupplierData(Request $request)
    {
        if($request->type == 'purchase') {
            $purchases = Purchase::where(['supplier_id' => $request->supplier_id])->whereHas('pendingPurchaseItems')->get();
            return response(['data' => $purchases]);
        }
        elseif($request->type == 'inward') {
            $purchases = PurchaseInward::where(['supplier_id' => $request->supplier_id])->whereHas('pendingPurchaseItems')->get();
            return response(['data' => $purchases]);
        }
    }

    public function getPurchaseData(Request $request)
    {
        $purchase = Purchase::where(['id' => $request->purchase_id])->first();
        if($request->response == 'html') {
            $data = view('admin.purchase.inward.purchase_item', compact('purchase'))->render();
            return response(['data' => $data]);
        }
        return response(['data' => $purchase]);
    }

    public function getInwardData(Request $request)
    {
        $purchase = PurchaseInward::where(['id' => $request->inward_id])->first();
        if($request->response == 'html') {
            $data = view('admin.purchase.inward.inward_item', compact('purchase'))->render();
            return response(['data' => $data]);
        }
        return response(['data' => $purchase]);
    }
}