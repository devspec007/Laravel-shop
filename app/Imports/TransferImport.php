<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ProductSku;
use App\Models\Transfer;
use App\Models\TransferItem;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
class TransferImport implements ToCollection
{
     /**
     * The user repository instance.
     */
    protected $transfer_date;
    protected $to_store;
    protected $from_store;
    protected $note;
    protected $total_paid_amount;
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct($transfer_date, $to_store, $from_store, $note)
    {
        $this->transfer_date = $transfer_date;
        $this->to_store = $to_store;
        $this->from_store = $from_store;
        $this->note = $note;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        DB::beginTransaction();
        $from_store =  User::where('id' , $this->from_store)->whereIn('type', ['store', 'admin'])->first();
        $to_store =  User::where(['id' => $this->to_store])->whereIn('type', ['store', 'admin'])->first();
    
        if($from_store && $to_store) {
            $purchase = Transfer::where(['transfer_date' => $this->transfer_date, 'to_store' => $this->to_store, 'from_store' => $this->from_store])->first();
            if(!$purchase) {

                $data = ['transfer_date' => $this->transfer_date, 'to_store' => $this->to_store, 'note' => $this->note, 'from_store' => $this->from_store];
                $purchase = Transfer::create($data);
            }
       

            $total_purchase_item = $purchase->total_amount;
            $total_item = $purchase->total_quantity;
            foreach ($rows as $key => $row) {
                if ($key > 0) {
                   
                    $category = Category::where('name', $row[2])->whereNull('p_id')->first();
                    if($category) {
                        $sub_category = Category::where('name', $row[3])->where('p_id' , $category->id)->first();
                        if($sub_category) {
                            $brand = Brand::where('name', $row[4])->first();
                            if($brand) {
                                $product = Product::where(['name' => $row[0], 
                                'category_id' => $category->id, 
                                'brand_id' => $brand->id,
                                'subcategory_id' =>$sub_category->id])->first();
                                // print_r(json_encode($product));die;
                                
                                if($product) {
                                    
                                   
                                    $sku = ProductSku::where(['product_id' => $product->id, 'sku' => $row[1]])->first();
                                 
                                    if($sku) {
                                        $inventory = ProductInventory::where(['product_id' => $product->id, 'sku_id' => $sku->id, 'store_id' => $this->from_store, 'unit_price' => $row[6]])->first();
                                        if(!$inventory) {

                                        }
                                        else if($inventory->left_quantity < $row[5]) {
                                            
                                        }
                                        else {
                                           
                                            $total = (float) $row[6]* (float)$row[5];
                                            $purchase_item_data = ['inventory_id' => $inventory->id , 'transfer_id' => $purchase->id, 'product_id' => $inventory->product_id, 'sku_id' => $inventory->sku_id, 'quantity' =>  $row[5], 'unit_price' =>  $row[6], 'total_price' => $total];
                                            $total_purchase = $row[5];
                                            $purchase_item = TransferItem::create($purchase_item_data);

                                            $check_inventory = ProductInventory::where(
                                                [
                                                
                                                 'store_id' => $this->to_store,
                                                  'product_id' => $inventory->product_id,
                                                   'sku_id' => $inventory->sku_id,
                                                     'unit_price' =>  $row[6]]
                                            )->first();
                                            if(!$check_inventory) {
                            
                                                $inventory_data = ['product_purchase_id' => $purchase_item->id,'sku_id' => $inventory->sku_id, 'store_id' => $this->to_store, 'product_id' => $inventory->product_id,  'quantity' =>  $row[5], 'left_quantity' => $row[5], 'unit_price' =>  $row[6], 'total_price' => $total];
                                                ProductInventory::create($inventory_data);
                                            }
                                            else {
                                                $check_inventory->quantity =  $row[5]+$check_inventory->quantity;
                                                $check_inventory->left_quantity =  $row[5]+$check_inventory->left_quantity;
                                                $check_inventory->total_price = $check_inventory->quantity*$check_inventory->unit_price;
                                                $check_inventory->save();
                            
                                            }
                                            $inventory->left_quantity = $inventory->left_quantity-$row[5];
                                            $inventory->save();
                                            // print_r(json_encode($inventory));die;
    
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $purchase->total_amount_paid = $total_purchase_item;
            $due_amount = $total_purchase_item-$purchase->total_amount_paid;
            $purchase->total_amount = $total_purchase_item;
            $purchase->total_quantity = $total_item;
            $purchase->due_amount = $due_amount;
            if($due_amount == 0 ) {
                $purchase->payment_status = 'paid';
            }
            elseif($due_amount == $total_purchase_item ) {
                $purchase->payment_status = 'unpaid';
            }
            elseif($due_amount < $total_purchase_item ) {
                $purchase->payment_status = 'partial';
            }
            $purchase->save();
            
        }
        // print_r('final');die;
        DB::commit();
    }
}
