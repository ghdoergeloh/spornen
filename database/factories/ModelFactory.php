<?php

use Illuminate\Support\Str;

/*
 * |--------------------------------------------------------------------------
 * | Model Factories
 * |--------------------------------------------------------------------------
 * |
 * | Here you may define all of your model factories. Model factories give
 * | you a convenient way to create models for testing and seeding your
 * | database. Just tell the factory how a default model should look.
 * |
 */
$factory->define(App\Domain\Model\Auth\User::class,
	function (Faker\Generator $faker) {
		$gender = $faker->randomElement(['m', 'f']);
		return [
			'firstname' => $faker->firstName($gender),
			'lastname' => $faker->lastName,
			'email' => $faker->unique()->safeEmail,
			'phone' => $faker->phoneNumber,
			'birthday' => $faker->dateTimeThisCentury,
			'street' => $faker->streetName,
			'housenumber' => $faker->buildingNumber,
			'postcode' => $faker->postcode,
			'city' => $faker->city,
			'gender' => $gender,
			'confirmed' => 1,
			'password' => bcrypt(str_random(10)),
			'remember_token' => Str::random(60)
		];
	});

$factory->define(App\Domain\Model\Sponsor\SponsoredRun::class,
	function (Faker\Generator $faker) {
		$begin = $faker->dateTimeInInterval('now','+5 years');
		return [
			'name' => $faker->words(rand(1,6), true),
			'begin' => $begin,
			'end' => $faker->dateTimeInInterval($begin, '+1 day'),
			'with_tshirt' => $faker->boolean,
			'street' => $faker->streetName,
			'housenumber' => $faker->buildingNumber,
			'postcode' => $faker->postcode,
			'city' => $faker->city,
			'description' => $faker->text(255),
		];
	});