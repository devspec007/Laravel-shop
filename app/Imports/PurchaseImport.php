<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Category;
use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ProductSku;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;
use Auth;
class PurchaseImport implements ToCollection
{
    
    /**
     * The user repository instance.
     */
    protected $supplier_id;
    protected $purchase_date;
    protected $refrence_number;
    protected $note;
    protected $total_paid_amount;
    protected $payment_type;
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct($supplier_id, $purchase_date, $refrence_number, $total_paid_amount, $payment_type, $note)
    {
        $this->supplier_id = $supplier_id;
        $this->purchase_date = $purchase_date;
        $this->refrence_number = $refrence_number;
        $this->total_paid_amount = $total_paid_amount;
        $this->note = $note;
        $this->payment_type = $payment_type;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        ini_set('max_execution_time', '0');
        $supplier =  User::where(['id' => $this->supplier_id, 'type' => 'supplier'])->first();
        if($supplier) {
            $purchase = Purchase::where(['refrence_number' => $this->refrence_number, 'purchase_date' => $this->purchase_date, 'supplier_id' => $supplier->id])->first();
            if(!$purchase) {

                $data = ['purchase_date' => $this->purchase_date, 'refrence_number' => $this->refrence_number, 'note' => $this->note, 'supplier_id' => $supplier->id];
                $purchase = Purchase::create($data);
            }
            
        }
        $total_quantity = $purchase->total_quantity;
        $final_total_amount = $purchase->total_amount;
        $total_amount_paid = $purchase->total_amount_paid + $this->total_paid_amount ;
        

        foreach ($rows as $key => $row) {
          
            if ($key > 0) {
              
                $category = Category::where('name', trim($row[2]))->whereNull('p_id')->first();
                if($category) {
                    
                    $sub_category = Category::where('name', trim($row[3]))->where('p_id' , $category->id)->first();
                    if($sub_category) {
                        
                        $brand = Brand::where('name', trim($row[4]))->first();
                        if($brand) {
                            
                            $product = Product::where(['name' => trim($row[0]), 
                            'category_id' => $category->id, 
                            'brand_id' => $brand->id,
                            'subcategory_id' =>$sub_category->id])->first();
                           
                            
                            if($product) {
                                
                               
                                $sku = ProductSku::where('product_id', $product->id)->where('sku', trim($row[1]))->first();

                                if($sku) {

                                    if($supplier) {
                                        
                                        $total_amount = trim($row[5]) * trim($row[6]);
                                        $final_total_amount += $total_amount;
                                        $total_quantity  =$total_quantity + trim($row[6]);
                                       
                        
                                        $purchase_item_data = ['purchase_id' => $purchase->id, 'product_id' => $product->id, 'attribute_id' => $sku->id, 'quantity' =>  trim($row[6]), 'unit_price' =>  trim($row[5]), 'total_price' => $total_amount];
                                      
                                        $purchase_item = PurchaseItem::create($purchase_item_data);
                            
                                      
                                        $purchase_inventory = ProductInventory::where([
                                                                                            'store_id' => Auth::user()->id, 
                                                                                            'product_id' => $product->id, 
                                                                                            'sku_id' => $sku->id, 
                                                                                            'unit_price' =>  trim($row[5])
                                                                                            ])->first();
                                        if($purchase_inventory) {
                                            $purchase_ids = [];
                                            if(!empty( $purchase_inventory->purchase_ids)) {
                                                $purchase_ids = json_decode( $purchase_inventory->purchase_ids, true);
                                            }
                                            $purchase_inventory->quantity = $purchase_inventory->quantity+trim($row[6]);
                                            $purchase_inventory->left_quantity = $purchase_inventory->left_quantity+trim($row[6]);
                                            $purchase_inventory->total_price = $purchase_inventory->quantity*$purchase_inventory->unit_price;
                                            $purchase_inventory->purchase_ids = json_encode($purchase_ids);
                                            $purchase_inventory->save();

                                        } 
                                        else {
                                            $inventory = ['product_purchase_id' => $purchase_item->id, 
                                            'store_id' => Auth::user()->id, 
                                            'product_id' => $product->id, 
                                            'sku_id' => $sku->id, 
                                            'quantity' =>  trim($row[6]), 
                                            'left_quantity' => trim($row[6]), 
                                            'unit_price' =>  trim($row[5]), 
                                            'total_price' => trim($total_amount),
                                            'sale_price' => trim($sku->price),
                                            'purchase_ids' => json_encode([$purchase_item->id])
                                        ];
                                            $purchase_inventory = ProductInventory::create($inventory);
                                        }           
                                        
                                        
                                    }
                                   
                                }
                    
                            }
                            
                        }
                    }
                }
                
            }
        }

        $purchase->total_amount = $final_total_amount;
        $purchase->total_amount_paid = $total_amount_paid + $total_amount_paid;
        $due_amount = $final_total_amount - $purchase->total_amount_paid;
        $purchase->due_amount = $due_amount;
        $purchase->total_quantity = $total_quantity;
        if($due_amount == 0 ) {
            $purchase->payment_status = 'paid';
        }
        elseif($due_amount ==  $purchase->total_amount) {
            $purchase->payment_status = 'unpaid';
        }
        elseif($due_amount <  $purchase->total_amount) {
            $purchase->payment_status = 'partial';
        }
        $purchase->payment_type = $this->payment_type;
        if(!empty($this->note)) {
            $purchase->note = $this->note;
        }
        $purchase->save();
        $transaction = InventoryTransaction::create(['linkable_type' => 'purchase', 'linkable_id' => $purchase->id, 'total_amount' =>  $purchase->total_amount, 'paid_amoount' => $purchase->total_amount_paid, 'due_amount' => $purchase->due_amount, 'created_by' => Auth::id()]);

    }

}
