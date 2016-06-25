<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('run_participation_id')->unsigned();
			$table->foreign('run_participation_id')->references('id')->on('run_participations');
			$table->integer('ext_personnel_no')->nullable();
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->string('street');
			$table->integer('housenumber');
			$table->string('postcode', 5);
			$table->string('city');
			$table->decimal('donation_per_lap', 10, 2);
			$table->decimal('donation_static_max', 10, 2);
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
		Schema::drop('sponsors');
    }
}
