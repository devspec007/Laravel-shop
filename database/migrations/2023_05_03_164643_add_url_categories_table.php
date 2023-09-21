<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrlCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('categories', 'url')) {

            Schema::table('categories', function (Blueprint $table) {
                $table->text('url')->nullable();
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
        if(Schema::hasColumn('categories', 'url')) {

            Schema::table('categories', function (Blueprint $table) {
                $table->dropColumn('url');
            });
        }
    }
}
