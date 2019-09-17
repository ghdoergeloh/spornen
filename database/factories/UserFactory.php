<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Domain\Model\Auth\User::class, function (Faker $faker) {
	$gender = $faker->randomElement(['m', 'f']);
	
	return [
		'firstname' => $faker->firstName($gender),
		'lastname' => $faker->lastName,
		'street' => $faker->streetName,
		'housenumber' => $faker->buildingNumber,
		'postcode' => $faker->postcode,
		'city' => $faker->city,
		'birthday' => $faker->dateTime,
		'gender' => $gender,
		'phone' => $faker->phoneNumber,
		'email' => $faker->safeEmail,
		'password' => Hash::make('secret')
    ];
});
