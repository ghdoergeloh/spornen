<?php

namespace App\Domain\Model\Sponsor;

use Illuminate\Database\Eloquent\Model;

class RunParticipation extends Model
{

	protected $fillable = [
		'sponsored_run_id', 'user_id'
	];
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
	
}
