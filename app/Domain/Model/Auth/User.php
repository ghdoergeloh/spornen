<?php

namespace App\Domain\Model\Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

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
        'email', 'password', 'confirmation_code'
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
}
