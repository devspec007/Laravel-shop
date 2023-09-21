<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDisplayNameProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('products', 'display_name')) {

            Schema::table('products', function (Blueprint $table) {
                $table->text('display_name')->nullable();
            });
        }

        if(!Schema::hasColumn('products', 'sub_brand_id')) {

            Schema::table('products', function (Blueprint $table) {
                $table->integer('sub_brand_id')->nullable();
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
        if(Schema::hasColumn('products', 'display_name')) {

            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('display_name');
            });
        }
        if(Schema::hasColumn('products', 'sub_brand_id')) {

            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('sub_brand_id');
            });
        }
        
    }
}
