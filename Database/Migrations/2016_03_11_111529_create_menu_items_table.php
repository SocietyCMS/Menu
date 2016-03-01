<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_menuitems', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('menu_id')->unsigned();
            $table->foreign('menu_id')->references('id')->on('menu__menus')->onDelete('cascade');

            $table->string('name');

            $table->integer('parent_id')->nullable();
            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->integer('depth')->nullable();

            $table->string('title')->nullable();

            $table->string('target');

            $table->integer('subject_id')->index();
            $table->string('subject_type')->index();

            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menu_menuitems');
    }
}
