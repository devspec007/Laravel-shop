<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->integer('from_store')->nullable();
            $table->integer('to_store')->nullable();
            $table->date('transfer_date')->nullable();
            $table->float('total_amount')->nullable();
            $table->float('total_amount_paid')->nullable();
            $table->float('due_amount')->nullable();
            $table->text('note')->nullable();
            $table->integer('total_quantity')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('transfer_id')->nullable();

            

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
        Schema::dropIfExists('transfers');
    }
}
