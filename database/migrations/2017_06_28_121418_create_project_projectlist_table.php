<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectProjectlistTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_projectlist', function (Blueprint $table) {
			$table->integer('project_id')->unsigned()->nullable();
			$table->foreign('project_id')->references('id')
					->on('projects')->onDelete('cascade');

			$table->integer('projectlist_id')->unsigned()->nullable();
			$table->foreign('projectlist_id')->references('id')
					->on('projectlists')->onDelete('cascade');

			$table->timestamps();
            $table->primary(['project_id', 'projectlist_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('project_projectlist');
	}

}
