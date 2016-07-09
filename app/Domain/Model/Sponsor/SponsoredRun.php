<?php

namespace App\Domain\Model\Sponsor;

use Illuminate\Database\Eloquent\Model;

class SponsoredRun extends Model
{

	protected $dates = [
		'created_at', 'updated_at', 'begin'
	];

	public function participants()
	{
		return $this->hasManyThrough('App\Domain\Model\Auth\User', 'App\Domain\Model\Sponsor\RunParticipation', 'user_id', 'id');
	}

}
