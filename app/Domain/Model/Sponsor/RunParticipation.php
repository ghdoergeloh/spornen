<?php

namespace App\Domain\Model\Sponsor;

use Illuminate\Database\Eloquent\Model;

class RunParticipation extends Model
{

	protected $fillable = [
		'sponsored_run_id', 'user_id'
	];
	protected $dates = [
		'created_at', 'updated_at'
	];

}
