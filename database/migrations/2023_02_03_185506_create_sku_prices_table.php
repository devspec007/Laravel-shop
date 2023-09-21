<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkuPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sku_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id');
            $table->integer('product_id');
            $table->float('tax')->default(0);
            $table->float('discount')->default(0);
            $table->float('price')->default(0);
            $table->integer('sku_id')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('minimum_quantity')->default(0);
            $table->float('regular_price')->default(0);
            $table->dateTime('discount_start_date')->nullable();
            $table->integer('discount_type')->nullable();
            $table->dateTime('discount_end_date')->nullable();
            $table->float('wholesale_price')->nullable();
            $table->float('wholesale_discount')->nullable();
            $table->float('wholesale_regular_price')->nullable();
            $table->dateTime('wholesale_discount_start_date')->nullable();
            $table->dateTime('wholesale_discount_end_date')->nullable();
            $table->integer('wholesale_discount_type')->nullable();
            $table->integer('enable_for_customer')->default(1);
            $table->integer('enable_for_wholesale')->default(1);
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
        Schema::dropIfExists('sku_prices');
    }
}
