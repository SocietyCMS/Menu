<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid')->unique();

            $table->string('title')->nullable();
            $table->integer('order')->nullable();

            $table->boolean('show')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menu_menu');
    }
}
