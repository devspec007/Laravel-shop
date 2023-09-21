<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_bills', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');

            $table->integer('purchase_id');
            $table->integer('inward_id');
            $table->date('supply_date')->nullable();
            $table->date('shipping_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('bill_no')->nullable();
            $table->string('total_amount')->nullable();
            $table->text('note')->nullable();
            $table->integer('store_id')->nullable();
            $table->float('pending_amount')->default(0);
            $table->float('paid_amount')->default(0);
            $table->string('payment_type')->nullable();
            $table->string('payment_status')->default('pending');
            
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
        Schema::dropIfExists('shipping_bills');
    }
}
