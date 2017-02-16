<?php

namespace App\Domain\Model\Sponsor;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'firstname', 'lastname',
		'street', 'housenumber',
		'postcode', 'city', 'phone',
		'email', 'donation_per_lap', 'donation_static_max'
	];
	protected $dates = [
		'created_at', 'updated_at', 'begin'
	];

	public function user()
	{
		return $this->belongsTo('App\Domain\Model\Auth\User');
	}

	public function runParticipation()
	{
		return $this->belongsTo('App\Domain\Model\Sponsor\RunParticipation');
	}

	public function calculateDonationSum($laps)
	{
		$donation = $this->donation_per_lap * $laps;
		if ($this->donation_static_max == 0) {
			return $donation;
		} elseif ($this->donation_per_lap == 0) {
			return $this->donation_static_max;
		} else {
			return $donation > $this->donation_static_max ? $this->donation_static_max : $donation;
		}
	}

	public function setDonationPerLapAttribute($donation_per_lap)
	{
		$this->attributes['donation_per_lap'] = $donation_per_lap == NULL ? 0 : $donation_per_lap;
	}

	public function setDonationStaticMaxAttribute($donation_static_max)
	{
		$this->attributes['donation_static_max'] = $donation_static_max == NULL ? 0 : $donation_static_max;
	}

}
