<?php

namespace App\Domain\Model\Auth;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{

	use EntrustUserTrait;
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'firstname', 'lastname',
		'street', 'housenumber',
		'postcode', 'city',
		'birthday', 'phone',
		'email', 'gender',
		'password', 'confirmation_code'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token', 'confirmation_code'
	];
	protected $dates = [
		'created_at', 'updated_at', 'birthday'
	];

	// Auth:: = AuthManager > SessionGuard > EloquentUserProvider > User

	public function getBirthdayAttribute($birthday)
	{
		Carbon::setToStringFormat('Y-m-d');
		return new Carbon($birthday);
	}

}
