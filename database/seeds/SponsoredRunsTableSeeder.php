<?php

use App\Domain\Model\Sponsor\SponsoredRun;
use Illuminate\Database\Seeder;

class SponsoredRunsTableSeeder extends Seeder
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime('17.09.2016');
		SponsoredRun::create(['begin' => $date , 'name' => 'To All Nations - Freundestag 2016']);
	}

}
