<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTshirtToRunParticipationAndSonsoredRun extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sponsored_runs', function (Blueprint $table) {
			$table->boolean('with_tshirt')->default(false);
		});
		Schema::table('run_participations', function (Blueprint $table) {
			$table->enum('tshirt_size', ['XS', 'S', 'M', 'L', 'XL', 'XXL'])->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('run_participations', function (Blueprint $table) {
			$table->dropColumn('tshirt_size');
		});
		Schema::table('sponsored_runs', function (Blueprint $table) {
			$table->dropColumn('with_tshirt');
		});
	}

}
