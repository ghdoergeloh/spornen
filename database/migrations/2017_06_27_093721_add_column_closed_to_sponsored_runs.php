<?php

use App\Domain\Model\Sponsor\SponsoredRun;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnClosedToSponsoredRuns extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sponsored_runs', function (Blueprint $table) {
			$table->boolean('closed')->default(false);
		});

		$sponruns = SponsoredRun::all();
		foreach ($sponruns as $sponrun) {
			if ($sponrun->begin < Carbon::now()) {
				$sponrun->closed = true;
				$sponrun->save();
			}
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sponsored_runs', function (Blueprint $table) {
			$table->dropColumn('closed');
		});
	}

}
