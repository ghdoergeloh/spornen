<?php
namespace App\Domain\Model\Sponsor\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Domain\Model\Sponsor\SponsoredRun;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use App\Domain\Model\Sponsor\RunParticipation;
use App\Domain\Model\Sponsor\Sponsor;

class Evaluation implements FromCollection
{

	private $sponrun;

	public function __construct(SponsoredRun $sponrun)
	{
		$this->sponrun = $sponrun;
	}

	public function collection()
	{
		$evaluation = array();
		$evaluation[] = $this->generateHeadline();

		foreach ($this->sponrun->runParticipations as $runpart) {
			foreach ($runpart->sponsors as $sponsor) {
				$row = $this->generateRow($runpart, $sponsor);
				$evaluation[] = $row;
			}
		}
		return collect($evaluation);
	}

	private function generateHeadline()
	{
		$row = array();
		$row[] = 'Läufernr';
		$row[] = 'Projekt';
		if ($this->sponrun->with_tshirt) {
			$row[] = 'T-Shirt-Größe';
		}
		if (config('app.newsletter_optional')) {
			$row[] = 'Newsletter';
		}
		$row[] = 'L.Optigem PersNr.';
		$row[] = 'L.Name';
		$row[] = 'L.Straße Nr.';
		$row[] = 'L.PLZ';
		$row[] = 'L.Stadt';
		$row[] = 'L.E-Mail';
		$row[] = 'L.Telefon';
		$row[] = 'Sponsorennr.';
		$row[] = 'S.Name';
		$row[] = 'S.Straße Nr.';
		$row[] = 'S.PLZ';
		$row[] = 'S.Stadt';
		$row[] = 'S.E-Mail';
		$row[] = 'S.Telefon';
		$row[] = 'S.Optigem PersNr.';
		$row[] = 'Name des Läufers';
		$row[] = 'Spende pro Runde';
		$row[] = 'Maximal- oder Festbetrag';
		$row[] = 'gelaufene Runden';
		$row[] = 'Endbetrag';
		$row[] = 'Erhalten am';
		$row[] = 'Betrag';
		return $row;
		;
	}

	/**
	 *
	 * @param RunParticipation $runpart
	 * @param Sponsor $sponsor
	 * @return array
	 */
	private function generateRow($runpart, $sponsor)
	{
		$user = $runpart->user;
		$row = array();
		$row['Läufernr'] = $user->id;
		$row['Projekt'] = '' . $runpart->project_id;
		if ($this->sponrun->with_tshirt) {
			$row['T-Shirt-Größe'] = '' . $runpart->tshirt_size;
		}
		if (config('app.newsletter_optional')) {
			$row['Newsletter'] = $user->wants_newsletter ? 'Ja' : 'Nein';
		}
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
		return $row;
	}
}