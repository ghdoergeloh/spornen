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
			$table->integer('ext_personnel_no')->nullable();
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email')->unique();
			$table->string('phone')->nullable();
			$table->date('birthday');
			$table->string('street');
			$table->string('housenumber', 31);
			$table->string('postcode', 5);
			$table->string('city');
			$table->enum('gender', array('m', 'f'));
			$table->string('password');
			$table->timestamp('email_verified_at')->nullable();
			$table->boolean('confirmed')->default(false);
			$table->string('confirmation_code')->nullable();
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
