<?php

namespace App\Domain\Model\Sponsor;

use Illuminate\Database\Eloquent\Model;

class RunParticipation extends Model
{

	public function calculateSum($laps = null)
	{
		$sponsors = $this->sponsors;
		if ($laps == null) {
			$laps = $this->laps;
		}
		$sum = 0;
		foreach ($sponsors as $sponsor) {
			$donation = $sponsor->donation_per_lap * $laps;
			if ($sponsor->donation_static_max == 0) {
				$sum += $donation;
			} elseif ($sponsor->donation_per_lap == 0) {
				$sum += $sponsor->donation_static_max;
			} else {
				$sum += $donation > $sponsor->donation_static_max ? $sponsor->donation_static_max : $donation;
			}
		}
		return $sum;
	}

	protected $fillable = [];
	protected $dates = [
		'created_at', 'updated_at'
	];

	public function user()
	{
		return $this->belongsTo('App\Domain\Model\Auth\User');
	}

	public function sponsoredRun()
	{
		return $this->belongsTo('App\Domain\Model\Sponsor\SponsoredRun');
	}

	public function sponsors()
	{
		return $this->hasMany('App\Domain\Model\Sponsor\Sponsor');
	}

	public function project()
	{
		return $this->belongsTo('App\Domain\Model\Sponsor\Project');
	}

}
