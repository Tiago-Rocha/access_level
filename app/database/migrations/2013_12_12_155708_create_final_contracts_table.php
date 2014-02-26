<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFinalContractsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contracts', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->date('date');
            $table->integer('client_id')->unsigned();
            $table->float('hourstotal');
            $table->float('hoursleft');
            $table->integer('hourprice');
            $table->integer('travelprice');
            $table->enum('type', array('regie', 'it assist', 'project'));
            $table->enum('state', array('created', 'active', 'exhausted'));
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('contracts');
    }

}
