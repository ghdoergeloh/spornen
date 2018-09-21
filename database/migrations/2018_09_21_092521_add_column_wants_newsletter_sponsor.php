<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnWantsNewsletterSponsor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('sponsors', function (Blueprint $table) {
    		$table->boolean('wants_newsletter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('sponsors', function (Blueprint $table) {
    		$table->dropColumn('wants_newsletter');
        });
    }
}
