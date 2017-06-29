<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetRunParticipationProjectIdNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('run_participations', function (Blueprint $table) {
			$table->integer('project_id')->unsigned()->nullable()->default(NULL)->change();
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
			$table->integer('project_id')->unsigned()->nullable(false)->default(NULL)->change();
        });
    }
}
