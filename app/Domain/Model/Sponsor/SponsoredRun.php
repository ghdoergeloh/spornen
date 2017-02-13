<?php

namespace App\Domain\Model\Sponsor;

use Carbon\Carbon;
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
		return $this->attributes['begin'] < Carbon::now();
	}

	public function participants()
	{
		return $this->belongsToMany('App\Domain\Model\Auth\User', 'run_participations');
		// the same as: return $this->belongsToMany('App\Domain\Model\Auth\User', 'run_participations', 'sponsored_run_id', 'user_id');
	}

	public function runParticipations()
	{
		return $this->hasMany('App\Domain\Model\Sponsor\RunParticipation');
	}

	public function getBeginF()
	{
		return $this->begin->format('d.m.Y - H:i');
	}

	public function getEndF()
	{
		return $this->end->format('d.m.Y - H:i');
	}

	public function totalLaps()
	{
		$totalLaps = 0;
		foreach ($this->runParticipations as $participant) {
			$totalLaps += $participant->laps;
		}
		return $totalLaps;
	}

	public function totalDonationSum()
	{
		$totalDonationSum = 0;
		foreach ($this->runParticipations as $participant) {
			$totalDonationSum += $participant->calculateDonationSum();
		}
		return $totalDonationSum;
	}

	public function participantionsMostLaps()
	{
		$mostLaps = 0;
		$runparts = [];
		foreach ($this->runParticipations as $runpart) {
			$laps = $runpart->laps;
			if ($laps > $mostLaps) {
				$mostLaps = $laps;
				$runparts = [$runpart];
			} elseif ($laps == $mostLaps) {
				$runparts[] = $runpart;
			}
		}
		return $runparts;
	}

	public function participantionsMostSponsors()
	{
		$mostSponsors = 0;
		$runparts = [];
		foreach ($this->runParticipations as $runpart) {
			$sponsors = $runpart->sponsors->count();
			if ($sponsors > $mostSponsors) {
				$mostSponsors = $sponsors;
				$runparts = [$runpart];
			} elseif ($sponsors == $mostSponsors) {
				$runparts[] = $runpart;
			}
		}
		return $runparts;
	}

	public function participantionsHighestDonation()
	{
		$highesDonation = 0.00;
		$runparts = [];
		foreach ($this->runParticipations as $runpart) {
			$donation = $runpart->calculateDonationSum();
			if ($donation > $highesDonation) {
				$highesDonation = $donation;
				$runparts = [$runpart];
			} elseif ($donation == $highesDonation) {
				$runparts[] = $runpart;
			}
		}
		return $runparts;
	}
}
