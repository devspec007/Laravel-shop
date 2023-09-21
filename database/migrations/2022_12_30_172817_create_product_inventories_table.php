<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_inventories', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id')->nullable();
            $table->integer('product_purchase_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('sku_id')->nullable();
            $table->integer('quantity')->default(0);
            $table->float('unit_price')->default(0);
            $table->float('total_price')->default(0);
            $table->integer('left_quantity')->default(0);
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
        Schema::dropIfExists('product_inventories');
    }
}
