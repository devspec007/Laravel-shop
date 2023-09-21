<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('order_item_inventories', function (Blueprint $table) {
            $table->id();
            $table->integer('order_item_id')->nullable();
            $table->integer('inventory_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('sale_price')->nullable();
            $table->float('purchase_price')->nullable();

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
        Schema::dropIfExists('order_item_inventories');
    }
}
