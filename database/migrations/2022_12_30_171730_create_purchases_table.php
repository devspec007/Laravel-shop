<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('refrence_number')->nullable();
            $table->float('total_amount')->nullable();
            $table->float('total_amount_paid')->nullable();
            $table->float('due_amount')->nullable();
            $table->text('note')->nullable();
            $table->integer('total_quantity')->nullable();
            $table->string('status')->default('in progress');
            $table->string('payment_status')->nullable();
            $table->date('supplier_date')->nullable();

            
            
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
        Schema::dropIfExists('purchases');
    }
}
