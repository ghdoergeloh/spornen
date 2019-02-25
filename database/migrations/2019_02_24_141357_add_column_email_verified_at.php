<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnEmailVerifiedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	if (!Schema::hasColumn('users', 'email_verified_at'))
    	{
	    	Schema::table('users', function (Blueprint $table) {
	    		$table->timestamp('email_verified_at')->nullable();
	    	});
    	}

    	if (Schema::hasColumn('users', 'confirmed'))
    	{
    		$users = \App\Domain\Model\Auth\User::all();
    		
    		foreach ($users as $user) {
    			if ($user->confirmed && $user->email_verified_at == null) {
    				$user->email_verified_at = $user->created_at;
    				$user->save();
    			}
    		}
    		
    		Schema::table('users', function (Blueprint $table) {
    			$table->dropColumn('confirmed');
    			$table->dropColumn('confirmation_code'); 
    		});
   		}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
