<?php

namespace App\Domain\Model\Sponsor;

use Illuminate\Database\Eloquent\Model;

class SponsoredRun extends Model
{

	protected $dates = [
		'created_at', 'updated_at', 'begin'
	];

}
