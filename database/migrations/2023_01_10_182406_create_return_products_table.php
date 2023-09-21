<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_products', function (Blueprint $table) {
            $table->id();
            $table->string('linkable_type')->nullable();
            $table->integer('linkable_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->dateTime('return_date')->nullable();
            $table->string('type')->nullable();
            $table->text('note')->nullable();
            $table->string('payment_type')->nullable();

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
        Schema::dropIfExists('return_products');
    }
}
