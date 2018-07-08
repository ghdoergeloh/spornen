<?php

namespace App\Domain\Model\Sponsor;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class SponsoredRun extends Model
{

	protected $fillable = [
		'name', 'begin', 'end', 'with_tshirt',
		'street', 'housenumber',
		'postcode', 'city', 'description'
	];
	protected $dates = [
		'created_at', 'updated_at', 'begin', 'end'
	];

	public function isElapsed()
	{
		return $this->closed;
		//$this->attributes['begin'] < Carbon::now();
	}

	public function projectlists()
	{
		return $this->belongsToMany('App\Domain\Model\Sponsor\Projectlist');
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

	public function getProjectSelection()
	{
		$this->load('projectlists.projects');
		$projectsSelection = array();
		$projectsSelection[NULL] = 'Bitte auswählen';
		foreach ($this->projectlists as $projectlist) {
			//$projectsSelection = $projectlist->getProjectSelection();
			$projectsSelection = $projectlist->getProjectSelection() + $projectsSelection;
		}
		asort($projectsSelection);
		return $projectsSelection;
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

	public function oldestParticipants()
	{
		$earliestBirthday = Carbon::maxValue();
		$participants = [];
		foreach ($this->participants as $participant) {
			$birthday = $participant->birthday;
			if ($birthday < $earliestBirthday) {
				$earliestBirthday = $birthday;
				$participants = [$participant];
			} elseif ($birthday == $earliestBirthday) {
				$participants[] = $participant;
			}
		}
		return $participants;
	}

	public function youngestParticipants()
	{
		$latestBirthday = Carbon::minValue();
		$participants = [];
		foreach ($this->participants as $participant) {
			$birthday = $participant->birthday;
			if ($birthday > $latestBirthday) {
				$latestBirthday = $birthday;
				$participants = [$participant];
			} elseif ($birthday == $latestBirthday) {
				$participants[] = $participant;
			}
		}
		return $participants;
	}

	public function getBeginAttribute($begin)
	{
		Carbon::setToStringFormat('Y-m-d\TH:i');
		return new Carbon($begin);
	}

	public function getEndAttribute($end)
	{
		Carbon::setToStringFormat('Y-m-d\TH:i');
		return new Carbon($end);
	}

	public static function validator(array $data)
	{
		return Validator::make($data, [
					'name' => 'required|max:255',
					'begin' => 'required|date',
					'end' => 'required|date',
					'with_tshirt' => 'required|boolean',
					'street' => 'nullable|max:255',
					'housenumber' => 'nullable|string|max:31',
					'postcode' => 'nullable|numeric|between:0,99999',
					'city' => 'nullable|max:255',
					'description' => 'nullable|max:255'
		]);
	}

}
