<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToSponsoredRunsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sponsored_runs', function (Blueprint $table) {
			$table->datetime('end')->nullable();
			$table->string('street')->nullable();
			$table->string('housenumber', 31)->nullable();
			$table->string('postcode', 5)->nullable();
			$table->string('city')->nullable();
			$table->string('description')->nullable();
		});
		$runs = \App\Domain\Model\Sponsor\SponsoredRun::all();
		foreach ($runs as $run) {
			$run->end = $run->begin;
			$run->save();
		}
		Schema::table('sponsored_runs', function (Blueprint $table) {
			$table->datetime('end')->default(NULL)->nullable(false)->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sponsored_runs', function (Blueprint $table) {
			$table->dropColumn(['end', 'street', 'housenumber', 'postcode', 'city', 'description']);
		});
	}

}
