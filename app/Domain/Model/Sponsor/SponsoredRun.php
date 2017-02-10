<?php

namespace App\Domain\Model\Sponsor;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class SponsoredRun extends Model
{

	protected $fillable = [
		'name', 'begin', 'end',
		'street', 'housenumber',
		'postcode', 'city', 'description'
	];
	protected $dates = [
		'created_at', 'updated_at', 'begin', 'end'
	];

	public function isElapsed()
	{
		return $this->beginn < new DateTime();
	}

	public function participants()
	{
		return $this->belongsToMany('App\Domain\Model\Auth\User', 'run_participations');
		// the same as: return $this->belongsToMany('App\Domain\Model\Auth\User', 'run_participations', 'sponsored_run_id', 'user_id');
	}

	public function getBeginF()
	{
		return $this->begin->format('d.m.Y - H:i');
	}

	public function getEndF()
	{
		return $this->end->format('d.m.Y - H:i');
	}

}
