<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectlistSponsoredRunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectlist_sponsored_run', function (Blueprint $table) {
			$table->integer('projectlist_id')->unsigned()->nullable();
			$table->foreign('projectlist_id')->references('id')
					->on('projectlists')->onDelete('cascade');
			
			$table->integer('sponsored_run_id')->unsigned()->nullable();
			$table->foreign('sponsored_run_id')->references('id')
					->on('sponsored_runs')->onDelete('cascade');
			
            $table->timestamps();
            $table->primary(['projectlist_id', 'sponsored_run_id'], 'projectlist_sponsored_run_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projectlist_sponsored_run');
    }
}
