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

Route::get('runpart/{runpart}/calculate', 'RunParticipationController@calculate')->name('runpart.calculate');
Route::resource('runpart', 'RunParticipationController', ['except' => [
		'create', 'destroy'
]]);

Route::resource('runpart.sponsor', 'SponsorController');
Route::resource('sponrun', 'SponsoredRunController');
Route::resource('user', 'UserController');
