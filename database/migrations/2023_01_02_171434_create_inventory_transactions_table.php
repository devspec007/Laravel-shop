<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('linkable_type');
            $table->integer('linkable_id');
            $table->double('total_amount');
            $table->double('paid_amount');
            $table->double('due_amount');
            $table->integer('created_by');
            $table->text('note')->nullable();
            $table->text('additional_data')->nullable();
            $table->string('payment_type')->nullable();
            $table->date('transaction_date')->nullable();

            
            
            
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
        Schema::dropIfExists('inventory_transactions');
    }
}
