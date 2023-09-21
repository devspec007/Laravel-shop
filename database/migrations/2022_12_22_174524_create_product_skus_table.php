<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_skus', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->float('tax')->default(0);
            $table->float('discount')->nullable();
            $table->float('price')->nullable();
            $table->string('sku')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('minimum_quantity')->nullable();
            $table->float('regular_price')->nullable();
            $table->float('landing_cost')->nullable();
            $table->float('selling_margin')->nullable();
            $table->float('wholesale_margin')->nullable();
            $table->float('retailer_discount')->nullable();
            $table->float('retailer_price')->nullable();
            $table->float('retailer_margin')->nullable();
            $table->float('left_quantity')->nullable();
            $table->float('tax_amount')->default(0);

            
            
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
        Schema::dropIfExists('product_skus');
    }
}
