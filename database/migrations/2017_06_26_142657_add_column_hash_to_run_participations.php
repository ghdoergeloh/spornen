<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnHashToRunParticipations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('run_participations', function (Blueprint $table) {
			$table->string('hash')->nullable(true);
        });
		
		$runparts = \App\Domain\Model\Sponsor\RunParticipation::all();
		foreach ($runparts as $runpart) {
			$runpart->hash = md5(microtime());
			$runpart->save();
		}
		
		Schema::table('run_participations', function (Blueprint $table) {
			$table->string('hash')->nullable(false)->unique()->change();
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
			$table->dropColumn('hash');
        });
    }
}
