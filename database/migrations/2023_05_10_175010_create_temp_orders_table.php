<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id')->nullable();
            $table->string('fullname')->nullable();
            $table->string('mobile')->nullable();
            $table->string('order_no')->nullable();
            $table->float('order_value')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('order_status')->comments('	0:pending,1:approved');

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
        Schema::dropIfExists('temp_orders');
    }
}
