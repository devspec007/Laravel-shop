<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxDetailsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('products', 'purchase_tax')) {

            Schema::table('products', function (Blueprint $table) {
                $table->float('purchase_tax')->nullable();
            });
        }
        if(!Schema::hasColumn('products', 'sale_tax')) {

            Schema::table('products', function (Blueprint $table) {
                $table->float('sale_tax')->nullable();
            });
        }
        if(!Schema::hasColumn('products', 'is_purchase_tax')) {

            Schema::table('products', function (Blueprint $table) {
                $table->integer('is_purchase_tax')->default(0);
            });
        }
        if(!Schema::hasColumn('products', 'is_sale_tax')) {

            Schema::table('products', function (Blueprint $table) {
                $table->integer('is_sale_tax')->default(0);
            });
        }
        if(!Schema::hasColumn('products', 'is_cess')) {

            Schema::table('products', function (Blueprint $table) {
                $table->integer('is_cess')->default(0);
            });
        }
        if(!Schema::hasColumn('products', 'cess')) {

            Schema::table('products', function (Blueprint $table) {
                $table->float('cess')->default(0);
            });
        }
        if(!Schema::hasColumn('products', 'hsn_code')) {

            Schema::table('products', function (Blueprint $table) {
                $table->string('hsn_code')->nullable();
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
        if(Schema::hasColumn('products', 'purchase_tax')) {

            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('purchase_tax');
            });
        }
        if(Schema::hasColumn('products', 'sale_tax')) {

            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('sale_tax');
            });
        }
        if(Schema::hasColumn('products', 'is_purchase_tax')) {

            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('is_purchase_tax');
            });
        }
        if(Schema::hasColumn('products', 'is_sale_tax')) {

            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('is_sale_tax');
            });
        }
        if(Schema::hasColumn('products', 'is_cess')) {

            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('is_cess');
            });
        }
        if(Schema::hasColumn('products', 'cess')) {

            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('cess');
            });
        }
        if(Schema::hasColumn('products', 'hsn_code')) {

            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('hsn_code');
            });
        }
    }
}
