<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_inwards', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_id');
            $table->date('inward_date')->nullable();
            $table->string('inward_no')->nullable();
            $table->integer('received_by')->nullable();
            $table->string('gross_amount')->nullable();
            $table->string('tax_amount')->nullable();
            $table->string('total_amount')->nullable();
            $table->date('po_date')->nullable();
            $table->text('note')->nullable();
            $table->integer('store_id')->nullable();
            $table->float('pending_amount')->default(0);
            
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
        Schema::dropIfExists('purchase_inwards');
    }
}
