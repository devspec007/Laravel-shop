<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSkuOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sku_options', function (Blueprint $table) {
            $table->id();
            $table->integer('sku_id');
            $table->integer('attribute_id')->default(0);
            $table->string('attribute_value')->default(null);
            $table->string('attribute_type')->default(null);
           
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
        Schema::dropIfExists('product_sku_options');
    }
}
