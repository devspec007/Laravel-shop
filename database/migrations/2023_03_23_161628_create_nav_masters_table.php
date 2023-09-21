<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_masters', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->text('name');
            $table->text('path')->nullable();
            $table->string('icons',100)->nullable();
            $table->text('permissions')->nullable();
            $table->integer('orders')->nullable();
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
        Schema::dropIfExists('nav_masters');
    }
}
