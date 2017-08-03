<?php

namespace App\Domain\Model\Sponsor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use function url;

class RunParticipation extends Model
{

	public function calculateDonationSum($laps = null)
	{
		$sponsors = $this->sponsors;
		if ($laps == null) {
			$laps = $this->laps;
		}
		$sum = 0;
		foreach ($sponsors as $sponsor) {
			$sum += $sponsor->calculateDonationSum($laps);
		}
		return $sum;
	}

	protected $fillable = ['laps', 'tshirt_size', 'project_id'];
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

	public function getShareLinkAttribute()
	{
		return url('run') . "/" . $this->hash;
	}

	public static function validator(array $data)
	{
		return Validator::make($data, [
					'laps' => 'integer|min:0',
					'project_id' => 'exists:projects,id'
		]);
	}

}
