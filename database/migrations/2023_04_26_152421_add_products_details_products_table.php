<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductsDetailsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('products', 'is_hot_product')) {
            Schema::table('products', function (Blueprint $table) {
                $table->boolean('is_hot_product')->default(0);
            });
        }
        if(!Schema::hasColumn('products', 'is_best_seller_offers')) {
            Schema::table('products', function (Blueprint $table) {
                $table->boolean('is_best_seller_offers')->default(0);
            });
        }
        if(!Schema::hasColumn('products', 'is_repair_tool_offers')) {
            Schema::table('products', function (Blueprint $table) {
                $table->boolean('is_repair_tool_offers')->default(0);
            });
        }
        if(!Schema::hasColumn('products', 'is_accessories_offers')) {
            Schema::table('products', function (Blueprint $table) {
                $table->boolean('is_accessories_offers')->default(0);
            });
        }
        if(!Schema::hasColumn('products', 'is_spare_part_offers')) {
            Schema::table('products', function (Blueprint $table) {
                $table->boolean('is_spare_part_offers')->default(0);
            });
        }  
        if(!Schema::hasColumn('products', 'is_top_offers')) {
            Schema::table('products', function (Blueprint $table) {
                $table->boolean('is_top_offers')->default(0);
            });
        }  
        
        if(!Schema::hasColumn('products', 'cod_available')) {
            Schema::table('products', function (Blueprint $table) {
                $table->integer('cod_available')->default(1);
            });
        }  
        if(!Schema::hasColumn('products', 'online_payment_available')) {
            Schema::table('products', function (Blueprint $table) {
                $table->integer('online_payment_available')->default(1);
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
        if(!Schema::hasColumn('products', 'is_hot_product')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('is_hot_product');
            });
        }
        if(!Schema::hasColumn('products', 'is_best_seller_offers')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('is_best_seller_offers');
            });
        }
        if(!Schema::hasColumn('products', 'is_repair_tool_offers')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('is_repair_tool_offers');
            });
        }
        if(!Schema::hasColumn('products', 'is_accessories_offers')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('is_accessories_offers');
            });
        }
        if(!Schema::hasColumn('products', 'is_spare_part_offers')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('is_spare_part_offers');
            });
        }  
        if(!Schema::hasColumn('products', 'is_top_offers')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('is_top_offers');
            });
        }  
        
        if(!Schema::hasColumn('products', 'cod_available')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('cod_available');
            });
        }  
        if(Schema::hasColumn('products', 'online_payment_available')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('online_payment_available');
            });
        }  
    }
}
