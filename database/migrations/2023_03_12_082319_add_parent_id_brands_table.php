<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('brands', 'parent_id')) {

            Schema::table('brands', function (Blueprint $table) {
                $table->integer('parent_id')->nullable();
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
        if(Schema::hasColumn('brands', 'parent_id')) {

            Schema::table('brands', function (Blueprint $table) {
                $table->dropColumn('parent_id');
            });
        }
    }
}
