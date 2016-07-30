<?php

/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the controller to call when that URI is requested.
 * |
 */
Route::get('/', function () {
	return redirect('home');
});

Route::auth();
Route::get('register/verify/{confirmation_code}', 'Auth\AuthController@confirm');

Route::get('home', 'HomeController@showHomeView');

Route::get('account/edit', 'AccountController@edit')->name('account.edit');
Route::patch('account/update', 'AccountController@update')->name('account.update');

Route::get('runpart/{runpart}/calculate', 'RunParticipationController@calculate')->name('runpart.calculate');
Route::resource('runpart', 'RunParticipationController', ['except' => [
		'create', 'destroy'
]]);

Route::resource('runpart.sponsor', 'SponsorController');
