<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInwardItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_inward_items', function (Blueprint $table) {
            $table->id();
            $table->integer('inward_id')->nullable();
            $table->integer('purchase_item_id')->nullable();
            $table->integer('sku_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('received_quantity')->nullable();
            $table->float('pur_disc_1')->nullable();
            $table->float('pur_disc_2')->nullable();
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
        Schema::dropIfExists('purchase_inward_items');
    }
}
