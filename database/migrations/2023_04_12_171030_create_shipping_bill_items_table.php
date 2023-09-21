<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingBillItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_bill_items', function (Blueprint $table) {
            $table->id();
            $table->integer('shipping_bill_id')->nullable();
            $table->integer('inward_item_id')->nullable();
            $table->integer('purchase_item_id')->nullable();
            $table->integer('sku_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('amount')->default(0);
            $table->float('pending_amount')->default(0);
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
        Schema::dropIfExists('shipping_bill_items');
    }
}
