<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->double('amount')->nullable();
            $table->text('description')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('sku_code')->nullable();
            $table->string('type')->nullable();
            $table->integer('created_by')->nullable();
            $table->text('item_options')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('inventory_id')->nullable();
            $table->integer('sku_id')->nullable();
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
        Schema::dropIfExists('order_items');
    }
}
