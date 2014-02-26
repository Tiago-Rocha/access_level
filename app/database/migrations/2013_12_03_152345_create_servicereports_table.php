<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicereportsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('servicereports', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->date('date');
            $table->integer('contract_id')->unsigned();
            $table->integer('utilizador_id')->unsigned();
            $table->boolean('internal');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->float('duration');
            $table->string('subject');
            $table->text('comment');
            $table->enum('choices', array('foo', 'bar'));
            $table->text('state', array('submitted', 'validated', 'invoiced'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('servicereports');
    }

}
