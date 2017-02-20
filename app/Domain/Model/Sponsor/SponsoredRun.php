<?php

namespace App\Domain\Model\Sponsor;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use function phone;

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

	public function getEvaluation()
	{
		$evaluation = array();
		foreach ($this->runParticipations as $runpart) {
			$user = $runpart->user;
			foreach ($runpart->sponsors as $sponsor) {
				$row['Läufernr'] = $user->id;
				$row['Projekt'] = ''.$runpart->project_id;
				$row['L.Optigem PersNr.'] = 0;
				$row['L.Name'] = $user->lastname . ', ' . $user->firstname;
				$row['L.Straße Nr.'] = $user->street . ' ' . $user->housenumber;
				$row['L.PLZ'] = $user->postcode;
				$row['L.Stadt'] = $user->city;
				$row['L.E-Mail'] = $user->email;
				try {
					$row['L.Telefon'] = phone($user->phone, 'DE', PhoneNumberFormat::INTERNATIONAL);
				} catch (NumberParseException $ex) {
					$row['L.Telefon'] = $user->phone;
				}
				$row['Sponsorennr.'] = $sponsor->id;
				$row['S.Name'] = $sponsor->lastname . ', ' . $sponsor->firstname;
				$row['S.Straße Nr.'] = $sponsor->street . ' ' . $sponsor->housenumber;
				$row['S.PLZ'] = $sponsor->postcode;
				$row['S.Stadt'] = $sponsor->city;
				$row['S.E-Mail'] = $sponsor->email;
				try {
					$row['S.Telefon'] = phone($sponsor->phone, 'DE', PhoneNumberFormat::INTERNATIONAL);
				} catch (NumberParseException $ex) {
					$row['S.Telefon'] = $sponsor->phone;
				}
				$row['S.Optigem PersNr.'] = 0;
				$row['Name des Läufers'] = $row['L.Name'];
				$row['Spende pro Runde'] = number_format($sponsor->donation_per_lap, 2, ',', '');
				$row['Maximal- oder Festbetrag'] = number_format($sponsor->donation_static_max, 2, ',', '');
				$row['gelaufene Runden'] = $runpart->laps;
				$row['Endbetrag'] = number_format($sponsor->calculateDonationSum($runpart->laps), 2, ',', '');
				$row['Erhalten am'] = '';
				$row['Betrag'] = '';
				$evaluation[] = $row;
			}
		}
		return $evaluation;
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

}
