<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->nullable();
            $table->date('order_date')->nullable();
            $table->double('subtotal')->nullable();
            $table->double('total_amount')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_status')->default('unpaid');
            $table->string('order_status')->default('pending');
            $table->text('addtional_data')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_mobile')->nullable();
            $table->integer('return_quantity')->nullable();
            $table->text('return_data')->nullable();
            $table->text('discount_type')->nullable();
            $table->float('discount_amount')->default(0);
            $table->double('payable_amount')->default(0);
            $table->float('due_amount')->default(0);
            $table->integer('quantity')->default(0);
            $table->string('order_type')->default('pos');
            $table->integer('store_id')->nullable();
            $table->float('paid_amount')->nullable();
            $table->float('gst_percentage')->nullable();
            $table->float('gst_amount')->nullable();
            $table->string('delivery_type')->nullable();
            $table->string('approved_status')->default('pending');
            $table->text('reject_reason')->nullable();
            $table->integer('is_delivered')->default(0);
            $table->string('order_transfer_status')->default('order_placed');
            $table->string('order_status_type')->nullable();
            $table->string('order_cancel_reason')->nullable();
            $table->string('reorder_status')->nullable();

         
            $table->float('commission')->default(0);
            $table->string('cancel_reason')->nullable();
            $table->string('return_tags')->nullable();
            $table->string('discount_reason')->nullable();

            $table->text('other_informations')->nullable();
            
            $table->float('discount_request')->default(0);
            $table->string('collection_type')->nullable();
            
            
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
        Schema::dropIfExists('orders');
    }
}
