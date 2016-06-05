<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email')->unique();
			$table->string('phone');
			$table->date('birthday');
			$table->string('street');
			$table->integer('housenumber');
			$table->string('postcode', 5);
			$table->string('city');
			$table->enum('gender', array('m', 'f'));
			$table->string('password');
			$table->boolean('confirmed')->default(false);
			$table->string('confirmation_code')->nullable;
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
