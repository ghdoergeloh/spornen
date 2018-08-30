<?php

namespace App\Domain\Model\Auth;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Notifications\ResetPassword;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{

	use EntrustUserTrait;
	use Notifiable;
	use HasApiTokens;

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

	public function sendMail() {
	    $this->notify(new ResetPassword());
	}
	
	
	/**
	 * {@inheritDoc}
	 * @see \Illuminate\Contracts\Auth\CanResetPassword::sendPasswordResetNotification()
	 */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new ResetPassword($token));
		Session::flash('messages-success', new MessageBag(["Dir wurde eine Mail zugeschickt"]));
	}
}
