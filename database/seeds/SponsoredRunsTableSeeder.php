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
	    $begin = new DateTime('17.09.2016 10:00');
	    $end = new DateTime('17.09.2016 11:00');
	    SponsoredRun::create([
	        'begin' => $begin,
	        'end' => $end,
	        'name' => 'To All Nations - Freundestag 2016',
	        'with_tshirt' => true
	    ]);
	}

}
