<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeConstraintsCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('run_participations', function (Blueprint $table) {
            $table->dropForeign('run_participations_sponsored_run_id_foreign');
			$table->foreign('sponsored_run_id')->references('id')->on('sponsored_runs')->onDelete('cascade');
        });
        Schema::table('sponsors', function (Blueprint $table) {
            $table->dropForeign('sponsors_run_participation_id_foreign');
			$table->foreign('run_participation_id')->references('id')->on('run_participations')->onDelete('cascade');
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
            $table->dropForeign('run_participations_sponsored_run_id_foreign');
			$table->foreign('sponsored_run_id')->references('id')->on('sponsored_runs');
        });
        Schema::table('sponsors', function (Blueprint $table) {
            $table->dropForeign('sponsors_run_participation_id_foreign');
			$table->foreign('run_participation_id')->references('id')->on('run_participations');
        });
    }
}
