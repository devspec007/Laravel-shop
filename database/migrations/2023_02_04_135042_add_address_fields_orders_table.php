<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressFieldsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('orders', 'shipping_address')) {

            Schema::table('orders', function (Blueprint $table) {
                $table->text('shipping_address')->nullable();
            });
        }

        if (!Schema::hasColumn('orders', 'billing_address')) {

            Schema::table('orders', function (Blueprint $table) {
                $table->text('billing_address')->nullable();
            });
        }

        if (!Schema::hasColumn('orders', 'razorpay_repsonse')) {

            Schema::table('orders', function (Blueprint $table) {
                $table->text('razorpay_repsonse')->nullable();
            });
        }

        if (!Schema::hasColumn('orders', 'razorpay_id')) {

            Schema::table('orders', function (Blueprint $table) {
                $table->string('razorpay_id')->nullable();
            });
        }
        if (!Schema::hasColumn('orders', 'courier_type')) {

            Schema::table('orders', function (Blueprint $table) {
                $table->string('courier_type')->nullable();
            });
        }
        if (!Schema::hasColumn('orders', 'shipment_id')) {

            Schema::table('orders', function (Blueprint $table) {
                $table->string('shipment_id')->nullable();
            });
        }
        if (!Schema::hasColumn('orders', 'payment_method')) {

            Schema::table('orders', function (Blueprint $table) {
                $table->string('payment_method')->nullable();
            });
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('orders', 'shipping_address')) {

            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('shipping_address');
            });
        }

        if (Schema::hasColumn('orders', 'billing_address')) {

            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('billing_address');
            });
        }

        if (Schema::hasColumn('orders', 'razorpay_repsonse')) {

            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('razorpay_repsonse');
            });
        }

        if (Schema::hasColumn('orders', 'razorpay_id')) {

            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('razorpay_id');
            });
        }
        if (Schema::hasColumn('orders', 'courier_type')) {

            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('courier_type');
            });
        }
        if (Schema::hasColumn('orders', 'shipment_id')) {

            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('shipment_id');
            });
        }
        if (Schema::hasColumn('orders', 'payment_method')) {

            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('payment_method');
            });
        }
    }
}
