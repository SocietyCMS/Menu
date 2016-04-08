<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Kalnoy\Nestedset\NestedSet;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu__menus', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('url')->nullable();

            $table->string('attribute_target')->nullable();
            $table->string('attribute_id')->nullable();
            $table->string('attribute_class')->nullable();

            $table->boolean('active')->default(false);
            $table->boolean('useSubject')->default(false);

            $table->integer('subject_id')->nullable()->index();
            $table->string('subject_type')->nullable()->index();

            NestedSet::columns($table);
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
        Schema::drop('menu__menus');
    }
}
