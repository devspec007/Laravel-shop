<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherPriceToProductSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('product_skus', 'regular_price')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->float('regular_price')->nullable();
            });
        }
        if(!Schema::hasColumn('product_skus', 'discount_start_date')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dateTime('discount_start_date')->nullable();
            });
        }

        if(!Schema::hasColumn('product_skus', 'discount_type')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->integer('discount_type')->nullable();
            });
        }

        if(!Schema::hasColumn('product_skus', 'discount_end_date')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dateTime('discount_end_date')->nullable();
            });
        }


        if(!Schema::hasColumn('product_skus', 'wholesale_price')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->float('wholesale_price')->nullable();
            });
        }
        if(!Schema::hasColumn('product_skus', 'wholesale_discount')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->float('wholesale_discount')->nullable();
            });
        }
        if(!Schema::hasColumn('product_skus', 'wholesale_regular_price')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->float('wholesale_regular_price')->nullable();
            });
        }

        if(!Schema::hasColumn('product_skus', 'wholesale_discount_start_date')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dateTime('wholesale_discount_start_date')->nullable();
            });
        }

        if(!Schema::hasColumn('product_skus', 'wholesale_discount_end_date')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dateTime('wholesale_discount_end_date')->nullable();
            });
        }

        if(!Schema::hasColumn('product_skus', 'wholesale_discount_type')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->integer('wholesale_discount_type')->nullable();
            });
        }

        if(!Schema::hasColumn('product_skus', 'enable_for_customer')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->integer('enable_for_customer')->default(1);
            });
        }
        if(!Schema::hasColumn('product_skus', 'enable_for_wholesale')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->integer('enable_for_wholesale')->default(1);
            });
        }
        if(!Schema::hasColumn('product_skus', 'mrp')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->float('mrp')->nullable();
            });
        }
        if(!Schema::hasColumn('product_skus', 'purchase_price')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->float('purchase_price')->nullable();
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
        if(Schema::hasColumn('product_skus', 'regular_price')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dropColumn('regular_price');
            });
        }
        if(Schema::hasColumn('product_skus', 'discount_start_date')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dropColumn('discount_start_date');
            });
        }

        if(Schema::hasColumn('product_skus', 'discount_type')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dropColumn('discount_type');
            });
        }

        if(Schema::hasColumn('product_skus', 'discount_end_date')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dropColumn('discount_end_date');
            });
        }


        if(Schema::hasColumn('product_skus', 'wholesale_price')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dropColumn('wholesale_price');
            });
        }
        if(Schema::hasColumn('product_skus', 'wholesale_discount')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dropColumn('wholesale_discount');
            });
        }
        if(Schema::hasColumn('product_skus', 'wholesale_regular_price')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dropColumn('wholesale_regular_price');
            });
        }

        if(Schema::hasColumn('product_skus', 'wholesale_discount_start_date')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dropColumn('wholesale_discount_start_date');
            });
        }

        if(Schema::hasColumn('product_skus', 'wholesale_discount_end_date')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dropColumn('wholesale_discount_end_date');
            });
        }

        if(Schema::hasColumn('product_skus', 'wholesale_discount_type')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dropColumn('wholesale_discount_type');
            });
        }

        if(Schema::hasColumn('product_skus', 'enable_for_customer')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dropColumn('enable_for_customer');
            });
        }
        if(Schema::hasColumn('product_skus', 'enable_for_wholesale')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dropColumn('enable_for_wholesale');
            });
        }
        if(Schema::hasColumn('product_skus', 'mrp')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dropColumn('mrp');
            });
        }
        if(Schema::hasColumn('product_skus', 'purchase_price')) {

            Schema::table('product_skus', function (Blueprint $table) {
                $table->dropColumn('purchase_price');
            });
        }

        
    }
}
