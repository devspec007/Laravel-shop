<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            
            $table->integer('purchase_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('sku_id')->nullable();
            $table->integer('quantity')->default(0);
            $table->float('unit_price')->default(0);
            $table->float('total_price')->default(0);
            $table->float('sale_price')->default(0);
            $table->integer('received_quantity')->default(0);
            $table->integer('pending_quantity')->default(0);

            $table->float('purchase_tax')->nullable();
            $table->float('margin')->nullable();
            $table->float('mrp')->nullable();
            $table->float('unit_tax')->nullable();

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_items');
    }
}
