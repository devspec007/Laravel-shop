<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('unit')->nullable();
            $table->string('sku')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('minimum_quantity')->default(0);
            $table->text('description')->nullable();
            $table->string('slug')->nullable();
            $table->float('tax')->default(0);
            $table->float('discount')->default(0);
            $table->float('price')->default(0);
            $table->string('image')->nullable();
            $table->string('status')->default('active');
            $table->integer('sequance')->default(1);
            $table->integer('created_by')->nullable();
            $table->float('regular_price')->default(0);
            $table->string('product_type')->nullable();
            $table->integer('is_featured')->default(0);
            $table->integer('is_popular')->default(0);
            $table->integer('is_new')->default(0);
            $table->integer('is_hot_product')->default(0);
            $table->integer('is_best_offers')->default(0);
            $table->integer('is_repair_tool_offers')->default(0);
            $table->integer('is_accessories_offers')->default(0);
            $table->integer('is_spare_part_offers')->default(0);
            $table->integer('is_top_offers')->default(0);
            $table->integer('expiry_months')->nullable();
            $table->integer('unit_type_id')->nullable();
            $table->string('net_weight')->nullable();

            
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
        Schema::dropIfExists('products');
    }
}
