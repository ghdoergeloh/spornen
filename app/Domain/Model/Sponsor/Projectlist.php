<?php

namespace App\Domain\Model\Sponsor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Projectlist extends Model
{
	
	protected $fillable = ['name'];

	public function projects()
	{
		return $this->belongsToMany('App\Domain\Model\Sponsor\Project')
						->withTimestamps();
	}

	public static function validator(array $data)
	{
		return Validator::make($data, [
					'name' => 'required|max:255',
		]);
	}

}
