<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
	return redirect('home');
});

Auth::routes();
Route::get('register/verify/{confirmation_code}', 'Auth\RegisterController@confirm');

Route::get('home', 'HomeController@showHomeView');

Route::get('account/edit', 'AccountController@edit')->name('account.edit');
Route::patch('account/update', 'AccountController@update')->name('account.update');

Route::get('runpart/{runpart}/calculate', 'UsersRunParticipationController@calculate')->name('runpart.calculate');
Route::resource('runpart', 'UsersRunParticipationController', ['except' => ['create', 'destroy']]);
Route::resource('runpart.sponsor', 'UsersSponsorController');

Route::resource('sponrun', 'SponsoredRunController');
Route::get('sponrun/{sponrun}/evaluation', 'SponsoredRunController@evaluation')->name('sponrun.evaluation');
Route::resource('sponrun.runpart', 'RunParticipationController', ['except' => ['create', 'store', 'destroy']]);
Route::resource('sponrun.runpart.sponsor', 'SponsorController');


Route::resource('run.sponsor', 'SponsorSelfController', ['only' => ['index', 'create', 'store']]);
Route::get('run/{run}', function ($run) {
	return redirect()->route('run.sponsor.index', $run->hash);
});
